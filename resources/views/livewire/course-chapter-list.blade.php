<div class="space-y-4 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-200 min-h-screen p-6"> {{-- Overall page background, text, and padding --}}
    {{-- Header for Chapter Management (Outside the loop, apply once) --}}
    <div class="flex items-center justify-between w-full px-4 py-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('filament.teacher.resources.chapters.index', ['course_id' => $course->id]) }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium transition-colors duration-150 bg-white border border-gray-200 rounded-lg text-slate-700 hover:bg-slate-50
                   dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">
            <svg class="w-4 h-4 text-slate-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Icon color --}}
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Chapter Management
        </a>
    </div>

    {{-- Chapter Loop --}}
    @forelse($course->chapters as $chapter)
        <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700"> {{-- Dark mode card --}}
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700"> {{-- Dark mode header --}}
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-8 h-8 text-sm font-medium rounded-lg text-rose-600 bg-rose-100 dark:text-rose-300 dark:bg-rose-900"> {{-- Dark mode for chapter number badge --}}
                        {{ $loop->iteration }}
                    </div>
                    <div>
                        <h3 class="text-base font-medium text-slate-900 dark:text-white">{{ $chapter->titles }}</h3> {{-- Dark mode text, slightly larger font --}}
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-wrap justify-end"> {{-- Added flex-wrap justify-end for responsiveness --}}
                    <a href="{{ route('filament.teacher.resources.chapters.index', ['course_id' => $course->id]) }}"
                        class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium transition-colors duration-150 rounded-md text-emerald-700 bg-emerald-50 hover:bg-emerald-100
                                dark:text-emerald-300 dark:bg-emerald-900 dark:hover:bg-emerald-800"> {{-- Dark mode for Material button --}}
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Icon color --}}
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Material
                    </a>

                    <a href="{{ route('filament.teacher.resources.chapters.index', ['course_id' => $course->id]) }}"
                        class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-indigo-700 transition-colors duration-150 rounded-md bg-indigo-50 hover:bg-indigo-100
                                dark:text-indigo-300 dark:bg-indigo-900 dark:hover:bg-indigo-800"> {{-- Dark mode for Assignment button --}}
                        <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Icon color --}}
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Assignment
                    </a>
                </div>
            </div>

            <div class="p-4 border-t border-gray-200 dark:border-gray-700"> {{-- Added border-t to Chapter Content --}}
                <h1 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Content Preview</h1> {{-- Added a placeholder title --}}
                
                {{-- Materials --}}
                @if ($chapter->materials->isNotEmpty())
                    <div class="mb-6"> {{-- Increased bottom margin --}}
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-xs font-medium uppercase text-slate-700 dark:text-gray-400">Materials</h4> {{-- Dark mode text --}}
                            <span class="text-xs text-slate-500 dark:text-gray-400">{{ $chapter->materials->count() }} items</span> {{-- Dark mode text --}}
                        </div>
                        <div class="space-y-2">
                            @foreach ($chapter->materials as $material)
                                <div class="flex items-center justify-between p-2 rounded-md hover:bg-slate-50 dark:hover:bg-gray-700 group"> {{-- Dark mode hover --}}
                                    <div class="flex items-center flex-1 min-w-0"> {{-- Added min-w-0 for truncate --}}
                                        <div
                                            class="flex items-center justify-center w-6 h-6 mr-3 text-xs font-medium rounded-md text-slate-400 bg-slate-50 group-hover:bg-slate-100
                                            dark:text-gray-300 dark:bg-gray-700 dark:group-hover:bg-gray-600"> {{-- Dark mode for order number badge --}}
                                            {{ $material->order_number }}
                                        </div>
                                        <svg class="w-4 h-4 mr-2 text-slate-400 dark:text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Dark mode icon color, flex-shrink-0 --}}
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span class="text-sm text-slate-600 dark:text-gray-300 truncate"> {{-- Dark mode text, truncate --}}
                                            {{ $material->material_name }}
                                        </span>
                                    </div>
                                    @if ($material->duration)
                                        <span class="text-xs text-slate-400 dark:text-gray-500 flex-shrink-0"> {{-- Dark mode text, flex-shrink-0 --}}
                                            {{ $material->duration }} min
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Quizzes --}}
                @if ($chapter->quizzes->isNotEmpty())
                    <div class="mb-6"> {{-- Increased bottom margin --}}
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-xs font-medium uppercase text-slate-700 dark:text-gray-400">Quizzes</h4> {{-- Dark mode text --}}
                            <a href="{{ route('filament.teacher.resources.quizzes.create', ['chapter_id' => $chapter->id, 'course_id' => $course->id]) }}"
                                class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium transition-colors duration-150 rounded-md text-emerald-700 bg-emerald-50 hover:bg-emerald-100
                                       dark:text-emerald-300 dark:bg-emerald-900 dark:hover:bg-emerald-800"> {{-- Dark mode for Add Quiz button --}}
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Icon color --}}
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Add Quiz
                            </a>
                        </div>
                        <div class="space-y-2">
                            @foreach ($chapter->quizzes as $quiz)
                                <div class="flex items-center justify-between p-2 rounded-md hover:bg-slate-50 dark:hover:bg-gray-700"> {{-- Dark mode hover --}}
                                    <div class="flex items-center flex-1 min-w-0"> {{-- Added flex-1 min-w-0 --}}
                                        <svg class="w-4 h-4 mr-2 text-rose-400 dark:text-rose-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Dark mode icon color, flex-shrink-0 --}}
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span class="text-sm text-slate-600 dark:text-gray-300 truncate"> {{-- Dark mode text, truncate --}}
                                            {{ $quiz->title }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 flex-shrink-0"> {{-- Added flex-shrink-0 --}}
                                        <a href="{{ route('filament.teacher.resources.quizzes.edit', $quiz) }}"
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-blue-700 transition-colors duration-150 rounded-md bg-blue-50 hover:bg-blue-100
                                                   dark:text-blue-300 dark:bg-blue-900 dark:hover:bg-blue-800"> {{-- Dark mode for Edit button --}}
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Icon color --}}
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="{{ route('filament.teacher.resources.quizzes.view', ['record' => $quiz->id]) }}"
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-purple-700 transition-colors duration-150 rounded-md bg-purple-50 hover:bg-purple-100
                                                   dark:text-purple-300 dark:bg-purple-900 dark:hover:bg-purple-800"> {{-- Dark mode for View button --}}
                                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Icon color --}}
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </a>
                                        <button wire:click="deleteQuiz({{ $quiz->id }})"
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-red-700 transition-colors duration-150 rounded-md bg-red-50 hover:bg-red-100
                                                   dark:text-red-300 dark:bg-red-900 dark:hover:bg-red-800"> {{-- Dark mode for Delete button --}}
                                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Icon color --}}
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Assignments --}}
                @if ($chapter->assignments->isNotEmpty())
                    <div class="mb-6"> {{-- Increased bottom margin for consistency --}}
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-xs font-medium uppercase text-slate-700 dark:text-gray-400">Assignments</h4> {{-- Dark mode text --}}
                            {{-- Add Assignment button if needed --}}
                            {{-- <a href="..." class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium transition-colors duration-150 rounded-md text-emerald-700 bg-emerald-50 hover:bg-emerald-100 dark:text-emerald-300 dark:bg-emerald-900 dark:hover:bg-emerald-800">
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Assignment
                            </a> --}}
                        </div>
                        <div class="space-y-2">
                            @foreach ($chapter->assignments as $assignment)
                                <div class="flex items-center justify-between p-2 rounded-md hover:bg-slate-50 dark:hover:bg-gray-700"> {{-- Dark mode hover --}}
                                    <div class="flex items-center flex-1 min-w-0"> {{-- Added flex-1 min-w-0 --}}
                                        <svg class="w-4 h-4 mr-2 text-indigo-400 dark:text-indigo-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Dark mode icon color, flex-shrink-0 --}}
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span class="text-sm text-slate-600 dark:text-gray-300 truncate"> {{-- Dark mode text, truncate --}}
                                            {{ $assignment->title }}
                                        </span>
                                    </div>
                                    @if ($assignment->deadline)
                                        <span class="text-xs text-slate-500 dark:text-gray-400 flex-shrink-0"> {{-- Dark mode text, flex-shrink-0 --}}
                                            Due:
                                            {{ \Carbon\Carbon::parse($assignment->deadline)->format('M d, Y') }}
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="p-12 text-center bg-white border border-dashed rounded-xl border-slate-200
                    dark:bg-gray-800 dark:border-gray-700 dark:border-dashed"> {{-- Dark mode for empty state --}}
            <svg class="w-12 h-12 mx-auto text-slate-400 dark:text-gray-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No chapters found</h3> {{-- Dark mode text --}}
            <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">
                You haven't added any chapters to this course yet.
            </p>
            <div class="mt-6"> {{-- Added margin-top for the button below --}}
                <a href="{{ route('filament.teacher.resources.chapters.index', ['course_id' => $course->id]) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium transition-colors duration-150 bg-white border border-gray-200 rounded-lg text-slate-700 hover:bg-slate-50
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600"> {{-- Dark mode for button --}}
                    <svg class="w-4 h-4 text-slate-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add First Chapter
                </a>
            </div>
        </div>
    @endforelse
</div>