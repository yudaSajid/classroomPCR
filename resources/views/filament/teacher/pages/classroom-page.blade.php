<x-filament-panels::page>
    <div class="space-y-6 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen p-6">

        <div class="space-y-6">
            <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg sm:p-6 rounded-xl">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">My Classrooms</h2>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Manage your classes, students, and courses all in one place.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-end sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
                        <button wire:click="$set('showCreateModal', true)"
                            class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create Classroom
                        </button>
                        <div wire:ignore class="w-full sm:w-auto">
                            @livewire('join-classroom')
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($this->getClassrooms() as $classroom)
                    <div class="relative group">
                        <div class="h-full flex flex-col transition-all duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:shadow-lg hover:border-rose-600 overflow-hidden"> {{-- Added overflow-hidden --}}
                            <div class="p-5 border-b border-gray-200 dark:border-gray-700 text-center"> {{-- Added text-center --}}
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1 whitespace-nowrap overflow-hidden text-ellipsis"> {{-- Added whitespace-nowrap, overflow-hidden, text-ellipsis --}}
                                    <a href="{{ route('filament.teacher.resources.classroom-details.view', ['record' => $classroom]) }}"
                                       class="inline-block transition-colors hover:text-rose-500 w-full"> {{-- Changed inline-flex to inline-block, added w-full --}}
                                       {{ $classroom->class_name }}
                                    </a>
                                </h3>
                                <a href="{{ route('filament.teacher.resources.classroom-details.view', ['record' => $classroom]) }}"
                                   class="block text-sm text-gray-500 dark:text-gray-400 group-hover:text-rose-400 mt-1 whitespace-nowrap overflow-hidden text-ellipsis"> {{-- Moved "(click for details)" link below --}}
                                   (click for details)
                                   <svg class="inline-block w-4 h-4 ml-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                   </svg>
                                </a>
                                <div class="flex items-center justify-between text-sm mt-3"> {{-- Adjusted spacing --}}
                                    <p class="text-gray-500 dark:text-gray-400 whitespace-nowrap overflow-hidden text-ellipsis">Year: {{ $classroom->enrollment_year }}</p> {{-- Added whitespace-nowrap --}}
                                    <span class="text-ellipsis font-medium rounded-full text-gray-500 dark:text-gray-400  bg-transparent whitespace-nowrap overflow-hidden text-ellipsis"> {{-- Removed bg-rose-900, added border-rose-900, bg-transparent --}}
                                        {{ $classroom->program->program_name }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 p-5 border-b border-gray-200 dark:border-gray-700">
                                <div class="text-center">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">
                                        {{ $classroom->courses->count() }}
                                    </span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 whitespace-nowrap overflow-hidden text-ellipsis">Courses</p> {{-- Added whitespace-nowrap --}}
                                </div>
                                <div class="text-center">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">
                                        {{ $this->getStudentCount($classroom->id) }}
                                    </span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 whitespace-nowrap overflow-hidden text-ellipsis">Students</p> {{-- Added whitespace-nowrap --}}
                                </div>
                            </div>

                            <div class="p-5 mt-auto">
                                <div class="p-3 mb-4 text-center rounded-lg bg-gray-100 dark:bg-gray-700">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap overflow-hidden text-ellipsis">Class Code</p> {{-- Added whitespace-nowrap --}}
                                    <div class="flex items-center justify-center space-x-2">
                                        <span class="font-mono text-lg font-bold text-gray-900 dark:text-white whitespace-nowrap overflow-hidden text-ellipsis">{{ $classroom->class_code }}</span> {{-- Added whitespace-nowrap --}}
                                        <button onclick="navigator.clipboard.writeText('{{ $classroom->class_code }}')"
                                            class="p-1 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <button wire:click="showCourses('{{ $classroom->id }}')"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-rose-700 dark:text-rose-300 bg-rose-100 dark:bg-rose-900 hover:bg-rose-200 dark:hover:bg-rose-800 whitespace-nowrap overflow-hidden text-ellipsis"> {{-- Added whitespace-nowrap --}}
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        Courses
                                    </button>
                                    <button wire:click="showStudents('{{ $classroom->id }}')"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-700 dark:text-blue-300 rounded-lg bg-blue-100 dark:bg-blue-900 hover:bg-blue-200 dark:hover:bg-blue-800 whitespace-nowrap overflow-hidden text-ellipsis"> {{-- Added whitespace-nowrap --}}
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        Students
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($this->getClassrooms()->isEmpty())
                <div class="flex flex-col items-center justify-center p-8 text-center bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 text-gray-400 dark:text-gray-600">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No Classrooms Yet</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating your first classroom.</p>
                </div>
            @endif
        </div>

        {{-- Modals --}}
        <div x-data="{ shown: @entangle('showCreateModal') }" x-show="shown" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-4" class="fixed inset-0 z-50 overflow-y-auto"
            style="display: none;">

            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" x-show="shown"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div class="absolute inset-0 bg-gray-500/75 dark:bg-gray-900/75"></div>
                </div>

                <div class="relative w-full p-4 mx-auto bg-white dark:bg-gray-800 shadow-xl min-w-md rounded-2xl text-gray-800 dark:text-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-10 h-10 bg-rose-100 dark:bg-rose-900 rounded-xl text-rose-600 dark:text-rose-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                Create New Classroom
                            </h3>
                        </div>
                        <button wire:click="$set('showCreateModal', false)"
                            class="text-gray-500 dark:text-gray-400 transition-colors hover:text-gray-700 dark:hover:text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit="createClassroom" class="space-y-4">
                        <div class="p-1 space-y-4">
                            {{ $this->form }}
                        </div>

                        <div class="flex items-center justify-end pt-4 space-x-3 border-t border-gray-200 dark:border-gray-700">
                            <button type="button" wire:click="$set('showCreateModal', false)"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-rose-500/50">
                                Cancel
                            </button>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-lg bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500/50">
                                Create Classroom
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div x-data="{ shown: @entangle('showCoursesModal') }" x-show="shown" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-4" class="fixed inset-0 z-50 overflow-y-auto"
            style="display: none;">

            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" x-show="shown"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div class="absolute inset-0 bg-gray-500/75 dark:bg-gray-900/75"></div>
                </div>

                <div class="relative w-full max-w-sm p-4 mx-auto bg-white dark:bg-gray-800 shadow-xl rounded-2xl text-gray-800 dark:text-gray-200">
                    @if ($selectedClassroom)
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                Courses
                            </h3>
                            <button wire:click="$set('showCoursesModal', false)"
                                class="text-gray-500 dark:text-gray-400 transition-colors hover:text-gray-700 dark:hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="relative">
                            <div class="space-y-1">
                                @forelse($selectedClassroom->courses as $course)
                                    <div
                                        class="flex items-center px-3 py-2 transition-all duration-150 rounded-lg group hover:bg-rose-100/50 dark:hover:bg-rose-900/50">
                                        <div class="flex-shrink-0">
                                            <div @class([
                                                'flex items-center justify-center w-8 h-8 transition-colors rounded-lg',
                                                'text-rose-600 dark:text-rose-300 bg-rose-100 dark:bg-rose-900 group-hover:bg-rose-200 dark:group-hover:bg-rose-800' => $course->course_publish,
                                                'text-gray-500 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 group-hover:bg-gray-300 dark:group-hover:bg-gray-600' => !$course->course_publish,
                                            ])>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 ml-3">
                                            <span @class([
                                                'text-sm font-medium group-hover:text-rose-500',
                                                'text-gray-900 dark:text-white' => $course->course_publish,
                                                'text-gray-500 dark:text-gray-400' => !$course->course_publish,
                                            ])>
                                                {{ $course->course_name }}
                                            </span>
                                        </div>
                                        @if (!$course->course_publish)
                                            <span
                                                class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                                Draft
                                            </span>
                                        @endif
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center py-6">
                                        <div
                                            class="flex items-center justify-center w-12 h-12 rounded-lg text-rose-500 bg-rose-100 dark:bg-rose-900">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No courses available</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div x-data="{ shown: @entangle('showStudentsModal') }" x-show="shown" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-4" class="fixed inset-0 z-50 overflow-y-auto"
            style="display: none;">

            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" x-show="shown"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div class="absolute inset-0 bg-gray-500/75 dark:bg-gray-900/75"></div>
                </div>

                <div class="relative w-full max-w-sm p-4 mx-auto bg-white dark:bg-gray-800 shadow-xl rounded-2xl text-gray-800 dark:text-gray-200">
                    @if ($selectedClassroomForStudents)
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                Students
                            </h3>
                            <button wire:click="$set('showStudentsModal', false)"
                                class="text-gray-500 dark:text-gray-400 transition-colors hover:text-gray-700 dark:hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="relative">
                            <div class="space-y-1">
                                @forelse($selectedClassroomForStudents->classroomUsers as $classroomUser)
                                    <div
                                        class="flex items-center px-3 py-2 transition-all duration-150 rounded-lg group hover:bg-blue-100/50 dark:hover:bg-blue-900/50">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 text-blue-700 dark:text-blue-300 transition-colors bg-blue-100 dark:bg-blue-900 rounded-lg group-hover:bg-blue-200 dark:group-hover:bg-blue-800">
                                                {{ substr($classroomUser->user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="flex-1 ml-3">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-500">
                                                {{ $classroomUser->user->name }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center py-6">
                                        <div
                                            class="flex items-center justify-center w-12 h-12 text-blue-500 rounded-lg bg-blue-100 dark:bg-blue-900">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No students enrolled</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
