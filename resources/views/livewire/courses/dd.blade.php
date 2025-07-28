<div class="max-w-4xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
    @foreach ($data as $index => $chapter)
        @php
            $previousChapterCompleted = true;
            if ($index > 0) {
                $previousChapter = $data[$index - 1];
                $materialsCompleted = $previousChapter->materials->every(function ($material) use ($userId) {
                    return $material->userMaterialStatus->firstWhere('user_id', $userId)?->is_completed;
                });

                $quizCompleted = $previousChapter->quizzes->every(function ($quiz) use ($userId) {
                    return $quiz->attempts()->where('user_id', $userId)->where('score', 100)->exists();
                });

                $previousChapterCompleted = $materialsCompleted && $quizCompleted;
            }
        @endphp

        <div x-data="{ open: false }"
            class="mb-4 overflow-hidden transition-all duration-300 ease-in-out bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-xl
                {{ !$previousChapterCompleted ? 'opacity-50' : '' }}">

            <h2 @click="open = {{ $previousChapterCompleted ? '!open' : 'false' }}"
                class="flex items-center justify-between p-4 {{ $previousChapterCompleted ? 'cursor-pointer hover:bg-gray-50' : 'cursor-not-allowed' }}">
                <span class="text-lg font-semibold text-gray-800">{{ $chapter->titles }}</span>
                @if (!$previousChapterCompleted)
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                @endif
                <svg x-bind:class="open ? 'rotate-180 transform' : ''"
                    class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </h2>

            <div x-show="open && {{ $previousChapterCompleted ? 'true' : 'false' }}"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4" class="p-4 bg-gray-50">

                <div class="space-y-3">
                    @foreach ($chapter->materials as $material)
                        @php
                            $status = $material->userMaterialStatus->firstWhere('user_id', $userId);
                            $isCompleted = $status ? $status->is_completed : false;
                            $isLocked =
                                !$previousChapterCompleted ||
                                (!$isCompleted &&
                                    $loop->index > 0 &&
                                    !$chapter->materials[$loop->index - 1]->userMaterialStatus->firstWhere(
                                        'user_id',
                                        $userId,
                                    )?->is_completed);
                        @endphp

                        {{-- Material Section --}}
                        <button wire:click="selectMaterial('{{ $material->id }}')"
                            @if ($isLocked) disabled @endif
                            class="flex items-center justify-between w-full p-3 transition-all duration-200 ease-in-out bg-white rounded-lg group
                                {{ $isLocked ? 'opacity-50 cursor-not-allowed' : 'hover:bg-indigo-50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2' }}">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-indigo-500 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ Str::limit($material->material_name, 15) }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        @if ($material->id === session('current_material_id') && !$isCompleted)
                                            <span x-data="{
                                                timeLeft: {{ $material->duration }},
                                                formattedTime: '',
                                                interval: null,
                                                init() {
                                                    this.startTimer();
                                                    // Poll for completion status every 5 seconds
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
                                                class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-indigo-500 animate-spin" x-show="timeLeft > 0"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                                <span class="font-medium" x-text="formattedTime"></span>
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
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </button>
                    @endforeach

                    {{-- Quiz Section --}}
                    @foreach ($chapter->quizzes as $quiz)
                        @php
                            $allMaterialsCompleted = $chapter->materials->every(function ($material) use ($userId) {
                                return $material->userMaterialStatus->firstWhere('user_id', $userId)?->is_completed;
                            });
                        @endphp
                        <button wire:click="selectQuiz('{{ $quiz->id }}')"
                            @if (!$allMaterialsCompleted) disabled @endif
                            class="flex items-center w-full p-3 transition-all duration-200 ease-in-out bg-white rounded-lg group
                                {{ !$allMaterialsCompleted ? 'opacity-50 cursor-not-allowed' : 'hover:bg-purple-50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2' }}">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-500 group-hover:text-purple-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ Str::limit($quiz->title, 30) }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        @if (!$allMaterialsCompleted)
                                            Complete all materials to unlock
                                        @else
                                            Quiz
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </button>
                    @endforeach

                    {{-- Assignment Section --}}
                    @foreach ($chapter->assignments as $assignment)
                        @php
                            $allMaterialsCompleted = $chapter->materials->every(function ($material) use ($userId) {
                                return $material->userMaterialStatus->firstWhere('user_id', $userId)?->is_completed;
                            });
                        @endphp
                        <button wire:click="selectAssignment('{{ $assignment->id }}')"
                            @if (!$allMaterialsCompleted) disabled @endif
                            class="flex items-center w-full p-3 transition-all duration-200 ease-in-out bg-white rounded-lg group
                                {{ !$allMaterialsCompleted ? 'opacity-50 cursor-not-allowed' : 'hover:bg-amber-50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2' }}">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-amber-500 group-hover:text-amber-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ Str::limit($assignment->title, 30) }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        @if (!$allMaterialsCompleted)
                                            Complete all materials to unlock
                                        @else
                                            Assignment
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
