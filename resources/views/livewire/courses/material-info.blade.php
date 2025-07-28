<div>
    <style>
        /* CSS ini harus dipindahkan ke file CSS utama Anda (misalnya filament-custom.css)
           atau setidaknya ditambahkan di bawah @layer components di file CSS Anda.
           Menempatkannya di <style> block dalam Blade view Livewire tidak ideal untuk performance
           dan cache busting Tailwind. */
        .rich-content ul,
        .rich-content ol {
            @apply pl-6 my-2;
        }

        .rich-content li {
            @apply my-1;
        }

        .rich-content ul {
            @apply list-disc;
        }

        .rich-content ol {
            @apply list-decimal;
        }

        /* --- TAMBAHKAN INI UNTUK DARK MODE PADA rich-content --- */
        .dark .rich-content {
            @apply text-gray-300; /* Warna teks umum untuk rich-content di dark mode */
        }

        .dark .rich-content a {
            @apply text-blue-400 hover:text-blue-300; /* Link di rich-content */
        }

        .dark .rich-content h1,
        .dark .rich-content h2,
        .dark .rich-content h3,
        .dark .rich-content h4,
        .dark .rich-content h5,
        .dark .rich-content h6 {
            @apply text-gray-100; /* Heading di rich-content */
        }

        .dark .rich-content strong {
            @apply text-gray-50; /* Bold text di rich-content */
        }

        .dark .rich-content code {
            @apply bg-gray-700 text-gray-100; /* Inline code di rich-content */
        }

        .dark .rich-content pre {
            @apply bg-gray-900 text-gray-100 border border-gray-700; /* Code blocks di rich-content */
        }
        /* --- AKHIR PENAMBAHAN UNTUK DARK MODE PADA rich-content --- */
    </style>

<div id="material-info-section" class="max-w-4xl mx-auto space-y-6">
    @if ($material)
    {{-- Custom Alert for Material --}}
    {{-- Asumsi x-custom-alert sudah dark-mode aware atau akan kita buat dark-mode aware --}}
    <x-custom-alert type="info" message="Silahkan baca modul sesuai dengan limit waktu yang diberikan untuk menyelesaikan modul"
        class="mt-4" />

        {{-- Main Material Card --}}
        <div wire:key="material-{{ $material->id }}" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            <div class="aspect-video">
                @if ($material->material_type == 'youtube')
                    <iframe src="{{ $material->embed_link }}" class="w-full h-full rounded-t-2xl" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @elseif($material->material_type == 'pdf')
                    @if (!empty($material->pdf_link))
                        <div class="w-full h-[800px] bg-gray-100 dark:bg-gray-900 rounded-t-2xl flex items-center justify-center"> {{-- Tambahkan bg-gray untuk placeholder --}}
                            <iframe src="{{ Storage::url($material->pdf_link) }}#toolbar=0"
                                class="w-full h-full rounded-t-2xl" frameborder="0">
                            </iframe>
                        </div>
                    @else
                        <div class="p-4 bg-red-100 dark:bg-red-800 dark:text-red-100">PDF file missing - please contact admin</div>
                    @endif
                @endif
            </div>

            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $material->material_name }}
                        </h1>
                        <div
                            class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                            {{ Str::ucfirst($material->material_type) }}
                        </div>
                    </div>
                    @if ($material->duration_in_minutes)
                        <div x-data="{
                            minutes: 0,
                            seconds: 0,
                            intervalId: null,
                            durationInSeconds: 0,
                            isMaterialCompleted: @json($isMaterialCompleted),

                            init() {
                                if (this.isMaterialCompleted) {
                                    this.durationInSeconds = 0;
                                    this.updateDisplay();
                                } else {
                                    this.$wire.on('startTimer', (duration) => {
                                        this.startTimer(duration);
                                    });
                                    this.$wire.on('stopTimer', () => {
                                        this.stopTimer();
                                    });

                                    // Initial check if timerDuration is already set on load
                                    if (this.$wire.get('timerDuration') > 0) {
                                        this.startTimer(this.$wire.get('timerDuration'));
                                    }
                                }
                            },

                            startTimer(durationInMinutes) {
                                this.stopTimer(); // Clear any existing timer
                                this.durationInSeconds = durationInMinutes * 60;
                                this.updateDisplay();

                                this.intervalId = setInterval(() => {
                                    if (this.durationInSeconds > 0) {
                                        this.durationInSeconds--;
                                        this.updateDisplay();
                                    } else {
                                        this.stopTimer();
                                        // Optionally emit an event to Livewire when timer finishes
                                        this.$wire.dispatch('timerFinished');
                                    }
                                }, 1000);
                            },

                            stopTimer() {
                                if (this.intervalId) {
                                    clearInterval(this.intervalId);
                                    this.intervalId = null;
                                }
                            },

                            updateDisplay() {
                                this.minutes = Math.floor(this.durationInSeconds / 60);
                                this.seconds = this.durationInSeconds % 60;
                            },

                            formattedTime() {
                                const m = this.minutes < 10 ? '0' + this.minutes : this.minutes;
                                const s = this.seconds < 10 ? '0' + this.seconds : this.seconds;
                                return `${m}:${s}`;
                            }
                        }"
                        x-show="durationInSeconds > 0 || isMaterialCompleted" {{-- Show if there's a duration or if completed --}}
                        class="text-2xl font-bold text-red-500 dark:text-red-400">
                            <span x-text="isMaterialCompleted ? '00:00' : formattedTime()"></span>
                        </div>
                    @endif
                </div>

                <div class="mt-6 prose prose-purple max-w-none">
                    {{-- rich-content will be handled by the <style> block or external CSS --}}
                    <div class="text-gray-700 rich-content dark:text-gray-300"> {{-- Add dark:text-gray-300 --}}
                        {!! $material->material_text !!}
                    </div>
                </div>

                @if ($showNextButton)
                    <div class="mt-6 text-right">
                        <button wire:click="nextMaterial" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-indigo-700 dark:hover:bg-indigo-600 dark:focus:ring-offset-gray-800">
                            Next Material
                            <svg class="w-4 h-4 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        {{-- Code Playground Section (Programiz) --}}
        @if ($material && $material->is_code)
        {{-- Custom Alert for Code Playground --}}
        <x-custom-alert type="info" message="Kamu bisa berlatih menggunakan code playground berikut." class="mt-4" />
            <div class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
                {{-- iframe Programiz. Jika iframe ini tidak memiliki tema gelap bawaan, akan sulit diubah dari sini. --}}
                <iframe src="{{ $iframeSrc }}"
                    class="w-full h-80 md:h-[32rem] xl:h-[40rem] 2xl:h-[48rem]"
                    frameborder="0">
                </iframe>
            </div>
        @endif
    
    @elseif($assignment) {{-- PERUBAHAN: Cek objek $assignment, bukan $assignmentID --}}
        {{-- Assignment Card --}}
        <div wire:key="assignment-{{ $assignment->id }}" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100"> {{-- Add dark:text-gray-100 --}}
                    {{ $assignment->title }}
                </h2>
                <div class="mt-6 prose prose-purple max-w-none rich-content dark:text-gray-300"> {{-- Add dark:text-gray-300 --}}
                    {!! $assignment->description !!}
                </div>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-700"> {{-- Add dark:border-gray-700 --}}
                <div class="p-6">
                    {{-- Pastikan ini menggunakan $assignment->id, bukan $assignmentID --}}
                    {{-- Asumsi livewire:assignment.assignment-form akan di-styling terpisah --}}
                    <livewire:assignment.assignment-form :assignmentID="$assignment->id" />
                </div>
            </div>
        </div>

    {{-- ... kode lainnya di atas ... --}}

    @elseif ($quiz) {{-- Ini adalah @if pembuka yang kemungkinan belum ada penutupnya --}}
        <div wire:key="quiz-{{ $quiz->id }}" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            <div class="p-6">
                {{-- Bagian informasi attempt di MaterialInfo --}}
                @if ($hasPerfectScore)
                    <div class="flex items-center p-6 bg-green-50 rounded-xl dark:bg-green-900/50">
                        <div class="flex-shrink-0">
                            <span class="p-2 bg-green-100 rounded-full dark:bg-green-800">
                                <x-heroicon-s-check-circle class="w-6 h-6 text-green-600 dark:text-green-300" />
                            </span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-green-800 dark:text-green-200">Skor Sempurna Dicapai!</h3>
                            <p class="mt-1 text-sm text-green-600 dark:text-green-300">
                                Selamat! Anda telah menguasai kuis ini dengan skor sempurna 100%.
                            </p>
                        </div>
                    </div>
                @elseif ($canAttemptToday)
                    {{-- Lives Counter --}}
                    <div class="flex items-center mb-6 space-x-2">
                        @for ($i = 0; $i < $maxLivesPerDay; $i++)
                            @if ($i < $todayLivesRemaining)
                                <span class="text-red-500 transition-all duration-300 transform hover:scale-110 dark:text-red-400">
                                    <x-heroicon-s-heart class="w-6 h-6" />
                                </span>
                            @else
                                <span class="text-gray-300 dark:text-gray-600">
                                    <x-heroicon-o-heart class="w-6 h-6" />
                                </span>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">
                            {{ $todayLivesRemaining }} percobaan tersisa hari ini
                        </span>
                    </div>

                     <x-custom-alert type="info" message="Syarat untuk lulus kuis ini adalah mendapatkan skor minimal 100%." class="mb-4" />

                    {{-- Komponen TakeQuiz hanya dimuat jika user bisa attempt hari ini --}}
                    <livewire:take-quiz :quiz="$quiz" :can-attempt-today="$canAttemptToday" :today-lives-remaining="$todayLivesRemaining" :max-lives-per-day="$maxLivesPerDay" />
                @else
                    {{-- No More Attempts Message --}}
                    <div class="p-6 bg-yellow-50 rounded-xl dark:bg-yellow-900/50">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <x-heroicon-s-clock class="w-6 h-6 text-yellow-600 dark:text-yellow-300" />
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-yellow-800 dark:text-yellow-200">
                                    Batas Percobaan Harian Tercapai
                                </h3>
                                <p class="mt-1 text-sm text-yellow-600 dark:text-yellow-300">
                                    Harap tinjau materi dan coba lagi besok. Percobaan Anda akan direset pada tengah malam.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Previous Attempts Section --}}
                @if ($quizAttempts->isNotEmpty())
                    <div class="mt-8 space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Riwayat Percobaan</h3>
                        @foreach ($quizAttempts as $attempt)
                            <div class="p-4 bg-gray-50 rounded-xl dark:bg-gray-700">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="flex items-center justify-center w-8 h-8 text-sm font-medium
                                            {{ $attempt->score == 100 ? 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200' }} rounded-full">
                                            #{{ $loop->iteration }}
                                        </span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Skor:
                                                <span
                                                    class="{{ $attempt->score == 100 ? 'text-green-600 dark:text-green-300' : ($attempt->score >= 70 ? 'text-blue-600 dark:text-blue-300' : 'text-yellow-600 dark:text-yellow-300') }}">
                                                    {{ $attempt->score }}%
                                                </span>
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $attempt->created_at->format('M d, Y H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    @if ($attempt->score == 100)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200">
                                            Skor Sempurna
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @elseif ($material) {{-- Jika bukan quiz, tapi material --}}
        {{-- Kode untuk menampilkan material (yang sudah Anda miliki dan modifikasi sebelumnya) --}}
        {{-- Saya tidak sertakan di sini untuk brevity, tapi pastikan ada di sini --}}
        {{-- Contoh struktur: --}}
        <div wire:key="material-{{ $material->id }}" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            {{-- Konten material di sini --}}
            <div class="aspect-video">
                @if ($material->material_type == 'youtube')
                    <iframe src="{{ $material->embed_link }}" class="w-full h-full rounded-t-2xl" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @elseif($material->material_type == 'pdf')
                    @if (!empty($material->pdf_link))
                        <iframe src="{{ Storage::url($material->pdf_link) }}#toolbar=0" class="w-full h-full rounded-t-2xl" frameborder="0"></iframe>
                    @else
                        <div class="p-4 bg-red-100 dark:bg-red-800 dark:text-red-100">PDF file missing - please contact admin</div>
                    @endif
                @endif
            </div>
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $material->material_name }}</h1>
                <div class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                    {{ Str::ucfirst($material->material_type) }}
                </div>
                <div class="mt-6 prose prose-purple max-w-none">
                    <div class="text-gray-700 rich-content dark:text-gray-300">
                        {!! $material->material_text !!}
                    </div>
                </div>
            </div>
        </div>
    @elseif ($assignment) {{-- Jika bukan quiz atau material, tapi assignment --}}
        {{-- Kode untuk menampilkan assignment (yang sudah Anda miliki dan modifikasi sebelumnya) --}}
        {{-- Contoh struktur: --}}
        <div wire:key="assignment-{{ $assignment->id }}" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $assignment->title }}</h2>
                <div class="mt-6 prose prose-purple max-w-none rich-content dark:text-gray-300">
                    {!! $assignment->description !!}
                </div>
            </div>
            <div class="border-t border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <livewire:assignment.assignment-form :assignmentID="$assignment->id" />
                </div>
            </div>
        </div>
    @else {{-- Jika tidak ada material, quiz, atau assignment yang dipilih --}}
        {{-- Pesan default --}}
        <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/50">
            <div class="flex">
                <div class="flex-shrink-0">
                    <x-heroicon-s-information-circle class="w-5 h-5 text-blue-400 dark:text-blue-300" />
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700 dark:text-blue-200">{{ $message ?? 'Silahkan pilih materi, kuis, atau tugas dari daftar pelajaran.' }}</p>
                </div>
            </div>
        </div>
    @endif {{-- Ini adalah @endif penutup untuk @if ($quiz) --}}

        {{-- General Message Alert (if $message is set) --}}
        @if(!empty($message))
            <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/50"> {{-- Add dark:bg --}}
                <div class="flex">
                    <div class="flex-shrink-0">
                        <x-heroicon-s-information-circle class="w-5 h-5 text-blue-400 dark:text-blue-300" /> {{-- Add dark:text --}}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700 dark:text-blue-200">{{ $message }}</p> {{-- Add dark:text --}}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>