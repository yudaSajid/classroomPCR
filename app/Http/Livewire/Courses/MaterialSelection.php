<div class="max-w-4xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
    @foreach ($data as $chapter)
    <div x-data="{ open: false }"
        class="mb-4 overflow-hidden transition-all duration-300 ease-in-out bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-xl">

        <h2 @click="open = ! open"
            class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50">
            <span class="text-lg font-semibold text-gray-800">{{ $chapter->titles }}</span>
            <svg x-bind:class="open ? 'rotate-180 transform' : ''"
                class="w-5 h-5 text-gray-500 transition-transform duration-200"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </h2>

        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-4"
            class="p-4 bg-gray-50">

            <div class="space-y-3">
                @foreach ($chapter->materials as $material)
                @php
                $status = $material->userMaterialStatus->firstWhere('user_id', $userId);
                $isCompleted = $status ? $status->is_completed : false;
                @endphp

                {{-- Material Section --}}
                <button wire:click="selectMaterial('{{ $material->id }}')"
                    class="flex items-center justify-between w-full p-3 transition-all duration-200 ease-in-out bg-white rounded-lg group hover:bg-indigo-50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-500 group-hover:text-indigo-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ Str::limit($material->material_name, 30) }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $material->formatted_duration }}</p>
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
                <button wire:click="selectQuiz('{{ $quiz->id }}')"
                    class="flex items-center w-full p-3 transition-all duration-200 ease-in-out bg-white rounded-lg group hover:bg-purple-50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-500 group-hover:text-purple-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ Str::limit($quiz->title, 30) }}
                            </p>
                            <p class="text-xs text-gray-500">Quiz</p>
                        </div>
                    </div>
                </button>
                @endforeach

                {{-- Assignment Section --}}
                @foreach ($chapter->assignments as $assignment)
                <button wire:click="selectAssignment('{{ $assignment->id }}')"
                    class="flex items-center w-full p-3 transition-all duration-200 ease-in-out bg-white rounded-lg group hover:bg-amber-50 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-amber-500 group-hover:text-amber-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ Str::limit($assignment->title, 30) }}
                            </p>
                            <p class="text-xs text-gray-500">Assignment</p>
                        </div>
                    </div>
                </button>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>