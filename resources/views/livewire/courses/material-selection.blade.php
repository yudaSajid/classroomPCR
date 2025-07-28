<div class="max-w-full lg:max-w-4xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
    @foreach ($data as $index => $chapter)
        @php
            $previousChapterCompleted = true;
            if ($index > 0) {
                $previousChapter = $data[$index - 1];
                $materialsCompleted = $previousChapter->materials->every(function ($material) use ($userId) {
                    // Pastikan userMaterialStatus adalah koleksi sebelum memanggil firstWhere
                    $userMaterialStatusCollection = $material->userMaterialStatus ?? collect();
                    return $userMaterialStatusCollection->firstWhere('user_id', $userId)?->is_completed ?? false;
                });

                $quizCompleted = $previousChapter->quizzes->every(function ($quiz) use ($userId) {
                    // Gunakan isNotEmpty() pada koleksi attempts yang sudah dimuat atau difilter
                    $quizAttemptsCollection = $quiz->attempts ?? collect();
                    return $quizAttemptsCollection->where('user_id', $userId)->where('score', 100)->isNotEmpty();
                });

                // --- PERUBAHAN DI SINI: Assignment TIDAK menjadi syarat pembuka chapter berikutnya ---
                $previousChapterCompleted = $materialsCompleted && $quizCompleted;
                // ----------------------------------------------------------------------------------
            }
        @endphp

        {{-- Main Chapter Container --}}
        <div x-data="{ open: @json($previousChapterCompleted && $index === 0) }" {{-- Open the first chapter by default if available --}}
            class="mb-4 overflow-hidden transition-all duration-300 ease-in-out
                   bg-white border border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow-md dark:shadow-lg dark:text-gray-200 hover:shadow-md rounded-xl
                   {{ !$previousChapterCompleted ? 'opacity-60 cursor-not-allowed' : '' }}">

            {{-- Chapter Header (the collapsible bar) --}}
            <h2 @click="open = {{ $previousChapterCompleted ? '!open' : 'false' }}"
                class="flex items-center justify-between p-4 text-left
                       {{ $previousChapterCompleted ? 'cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700' : 'cursor-not-allowed' }}
                       border-b border-gray-100 dark:border-gray-700">
                <span class="text-lg font-semibold text-gray-800 dark:text-gray-200 flex-1">{{ $chapter->titles }}</span>
                <div class="flex items-center space-x-2">
                    @if (!$previousChapterCompleted)
                        {{-- 'Locked' text and icon --}}
                        <span class="text-sm font-medium text-red-500">Locked</span>
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />
                        </svg>
                    @endif
                    {{-- Caret icon --}}
                    <svg x-bind:class="open ? 'rotate-180' : ''"
                        class="w-5 h-5 text-gray-500 transition-transform duration-200 dark:text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </h2>

            {{-- Collapsible Content Area (where materials/quizzes/assignments are listed) --}}
            <div x-show="open && {{ $previousChapterCompleted ? 'true' : 'false' }}"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4"
                class="p-4 bg-gray-50 dark:bg-gray-900/50"> {{-- bg-gray-50 untuk light, dark:bg-gray-900/50 untuk dark --}}

                <div class="space-y-3"> {{-- Kelas ini hanya untuk spacing antar item --}}

                    {{-- Material Section --}}
                    @foreach ($chapter->materials as $material)
                        @php
                            $userMaterialStatusCollection = $material->userMaterialStatus ?? collect();
                            $status = $userMaterialStatusCollection->firstWhere('user_id', $userId);
                            $isCompleted = $status?->is_completed ?? false;

                            $prevMaterialStatus = ($loop->index > 0 && $chapter->materials->has($loop->index - 1))
                                ? ($chapter->materials[$loop->index - 1]->userMaterialStatus ?? collect())->firstWhere('user_id', $userId)
                                : null;
                            $previousMaterialCompleted = $prevMaterialStatus?->is_completed ?? false;

                            $isLocked = !$previousChapterCompleted || (!$isCompleted && $loop->index > 0 && !$previousMaterialCompleted);
                        @endphp

                        <button wire:click="selectMaterial('{{ $material->id }}')"
                            @if ($isLocked) disabled @endif
                            class="flex items-center w-full p-3 transition-all duration-200 ease-in-out
                                   bg-white dark:bg-gray-700 shadow-md dark:shadow-lg dark:text-gray-200 rounded-lg group
                                   {{ $isLocked ? 'opacity-50 cursor-not-allowed' : 'hover:bg-indigo-50 dark:hover:bg-indigo-900/50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800' }}
                                   {{ session('current_material_id') == $material->id ? 'bg-indigo-100 border-l-4 border-indigo-500 dark:bg-indigo-900 dark:border-indigo-600' : '' }}">
                            <div class="flex items-center space-x-3 flex-1 min-w-0 ">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 {{ $isLocked ? 'text-gray-400' : 'text-indigo-500 group-hover:text-indigo-600 dark:text-indigo-400 dark:group-hover:text-indigo-500' }}"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-200">
                                        {{ $material->material_name }}
                                    </p>
                                    <p class="text-xs {{ $isLocked ? 'text-gray-400' : 'text-gray-500 dark:text-gray-400' }}">
                                        @if ($material->id === session('current_material_id') && !$isCompleted)
                                            <span x-data="{
                                                    timeLeft: {{ $material->duration }},
                                                    formattedTime: '',
                                                    interval: null,
                                                    init() {
                                                        this.startTimer();
                                                        setInterval(() => {
                                                            @this.updateCompletionStatus();
                                                        }, 5000);
                                                    },
                                                    startTimer() {
                                                        if (this.interval) clearInterval(this.interval);
                                                        this.interval = setInterval(() => {
                                                            if (this.timeLeft <= 0) {
                                                                clearInterval(this.interval);
                                                                this.formattedTime = 'Completed!';
                                                                $wire.completeMaterial('{{ $material->id }}');
                                                                return;
                                                            }
                                                            const minutes = Math.floor(this.timeLeft / 60);
                                                            const seconds = this.timeLeft % 60;
                                                            this.formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                                                            this.timeLeft--;
                                                        }, 1000);
                                                    }
                                                }" x-init="init()"
                                                class="flex items-center space-x-1">
                                                <svg class="w-4 h-4 text-indigo-500 animate-spin" x-show="timeLeft > 0"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                                <span class="font-medium dark:text-gray-200" x-text="formattedTime"></span>
                                                <span x-show="timeLeft > 0"> remaining</span>
                                            </span>
                                        @else
                                            {{ $material->formatted_duration }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if ($isCompleted)
                                <span class="flex-shrink-0 ml-4">
                                    <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @elseif ($isLocked)
                                <span class="flex-shrink-0 ml-4">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />
                                    </svg>
                                </span>
                            @endif
                        </button>
                    @endforeach

                    {{-- Quiz Section --}}
                    @foreach ($chapter->quizzes as $quiz)
                        @php
                            $allMaterialsCompleted = $chapter->materials->every(function ($material) use ($userId) {
                                $userMaterialStatusCollection = $material->userMaterialStatus ?? collect();
                                return $userMaterialStatusCollection->firstWhere('user_id', $userId)?->is_completed ?? false;
                            });
                            $isQuizCompleted = ($quiz->attempts ?? collect())->where('user_id', $userId)->where('score', 100)->isNotEmpty();
                            $isQuizLocked = !$allMaterialsCompleted || !$previousChapterCompleted; // Tetap tergantung pada semua materi chapter ini & chapter sebelumnya
                        @endphp
                        <button wire:click="selectQuiz('{{ $quiz->id }}')"
                            @if ($isQuizLocked) disabled @endif
                            class="flex items-center w-full p-3 transition-all duration-200 ease-in-out
                                   bg-white dark:bg-gray-700 rounded-lg group
                                   {{ $isQuizLocked ? 'opacity-50 cursor-not-allowed' : 'hover:bg-purple-50 dark:hover:bg-purple-900/50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800' }}
                                   {{ session('current_quiz_id') == $quiz->id ? 'bg-purple-100 border-l-4 border-purple-500 dark:bg-purple-900 dark:border-purple-600' : '' }}">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 {{ $isQuizLocked ? 'text-gray-400' : 'text-purple-500 group-hover:text-purple-600 dark:text-purple-400 dark:group-hover:text-purple-500' }}"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-200">
                                        {{ $quiz->title }}
                                    </p>
                                    <p class="text-xs {{ $isQuizLocked ? 'text-gray-400' : 'text-gray-500 dark:text-gray-400' }}">
                                        @if ($isQuizLocked)
                                            Complete previous sections to unlock
                                        @elseif ($isQuizCompleted)
                                            Completed (Score: 100)
                                        @else
                                            Quiz
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if ($isQuizCompleted)
                                <span class="flex-shrink-0 ml-4">
                                    <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @elseif ($isQuizLocked)
                                <span class="flex-shrink-0 ml-4">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />
                                    </svg>
                                </span>
                            @endif
                        </button>
                    @endforeach

                    {{-- Assignment Section --}}
                    @foreach ($chapter->assignments as $assignment)
                        @php
                            $allMaterialsCompleted = $chapter->materials->every(function ($material) use ($userId) {
                                $userMaterialStatusCollection = $material->userMaterialStatus ?? collect();
                                return $userMaterialStatusCollection->firstWhere('user_id', $userId)?->is_completed ?? false;
                            });
                            $userAssignmentStatusCollection = $assignment->userAssignmentStatus ?? collect();
                            $isAssignmentCompleted = $userAssignmentStatusCollection->firstWhere('user_id', $userId)?->is_completed ?? false;
                            $isAssignmentLocked = !$allMaterialsCompleted || !$previousChapterCompleted; // Tetap tergantung pada semua materi chapter ini & chapter sebelumnya
                        @endphp
                        <button wire:click="selectAssignment('{{ $assignment->id }}')"
                            @if ($isAssignmentLocked) disabled @endif
                            class="flex items-center w-full p-3 transition-all duration-200 ease-in-out
                                   bg-white dark:bg-gray-700 rounded-lg group
                                   {{ $isAssignmentLocked ? 'opacity-50 cursor-not-allowed' : 'hover:bg-amber-50 dark:hover:bg-amber-900/50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800' }}
                                   {{ session('current_assignment_id') == $assignment->id ? 'bg-amber-100 border-l-4 border-amber-500 dark:bg-amber-900 dark:border-amber-600' : '' }}">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 {{ $isAssignmentLocked ? 'text-gray-400' : 'text-amber-500 group-hover:text-amber-600 dark:text-amber-400 dark:group-hover:text-amber-500' }}"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-200">
                                        {{ $assignment->title }}
                                    </p>
                                    <p class="text-xs {{ $isAssignmentLocked ? 'text-gray-400' : 'text-gray-500 dark:text-gray-400' }}">
                                        @if ($isAssignmentLocked)
                                            Complete previous sections to unlock
                                        @elseif ($isAssignmentCompleted)
                                            Completed
                                        @else
                                            Assignment
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if ($isAssignmentCompleted)
                                <span class="flex-shrink-0 ml-4">
                                    <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @elseif ($isAssignmentLocked)
                                <span class="flex-shrink-0 ml-4">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />
                                    </svg>
                                </span>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>