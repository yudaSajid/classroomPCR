<div class="space-y-6">
    <div class="p-6 bg-white border shadow-sm rounded-xl border-slate-100
                dark:bg-gray-800 dark:border-gray-700 dark:shadow-lg"> {{-- Dark mode for outer container --}}
        <div class="mb-6">
            <h3 class="text-lg font-medium leading-6 text-slate-900 dark:text-gray-100"> {{-- Dark mode for title --}}
                Add Course to Classroom
            </h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-gray-400"> {{-- Dark mode for description --}}
                Select an existing course to add to this classroom.
            </p>
        </div>

        <form wire:submit="addCourse" class="space-y-4">
            {{ $this->form }} {{-- Ini adalah form yang dihasilkan Filament, seharusnya sudah mendukung dark mode secara otomatis --}}

            <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-gray-700"> {{-- Dark mode for border --}}
                <x-filament::button type="submit" size="sm">
                    <x-slot name="icon">
                        <x-heroicon-m-plus class="w-5 h-5" /> {{-- Ikon ini akan menyesuaikan warna berdasarkan tombol Filament --}}
                    </x-slot>
                    Add Course
                </x-filament::button>
            </div>
        </form>
    </div>

    <div class="overflow-hidden bg-white border shadow-sm rounded-xl border-slate-100
                dark:bg-gray-800 dark:border-gray-700 dark:shadow-lg"> {{-- Dark mode for outer list container --}}
        <div class="p-6 border-b border-slate-100 dark:border-gray-700"> {{-- Dark mode for border --}}
            <h3 class="text-lg font-medium leading-6 text-slate-900 dark:text-gray-100"> {{-- Dark mode for title --}}
                Current Courses
            </h3>
        </div>

        <ul class="divide-y divide-slate-100 dark:divide-gray-700"> {{-- Dark mode for list dividers --}}
            @forelse($assignedCourses as $course)
                <li class="flex items-center justify-between p-4 hover:bg-slate-50 dark:hover:bg-gray-700"> {{-- Dark mode for hover background --}}
                    <div class="flex items-center space-x-3">
                        <div @class([
                            'flex-shrink-0 w-2 h-2 rounded-full',
                            'bg-green-500 dark:bg-green-400' => $course->classrooms->first()?->pivot->is_active, // Dark mode for active dot
                            'bg-slate-300 dark:bg-gray-600' => !$course->classrooms->first()?->pivot->is_active, // Dark mode for inactive dot
                        ])></div>
                        <div>
                            <h4 class="text-sm font-medium text-slate-900 dark:text-gray-100"> {{-- Dark mode for course name --}}
                                {{ $course->course_name }}
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-gray-400"> {{-- Dark mode for status text --}}
                                {{ $course->classrooms->first()?->pivot->is_active ? 'Active' : 'Inactive' }}
                            </p>
                        </div>
                    </div>

                    <button type="button" wire:click="toggleCourseStatus({{ $course->id }})"
                        wire:loading.attr="disabled" wire:target="toggleCourseStatus({{ $course->id }})"
                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full transition-colors"
                        @class([
                            'text-green-700 bg-green-50 hover:bg-green-100 dark:text-green-200 dark:bg-green-900 dark:hover:bg-green-800 disabled:opacity-50' => $course->classrooms->first()?->pivot->is_active, // Dark mode for active button
                            'text-slate-700 bg-slate-50 hover:bg-slate-100 dark:text-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 disabled:opacity-50' => !$course->classrooms->first()?->pivot->is_active, // Dark mode for inactive button
                        ])>
                        <span wire:loading.remove wire:target="toggleCourseStatus({{ $course->id }})">
                            {{ $course->classrooms->first()?->pivot->is_active ? 'Deactivate' : 'Activate' }}
                        </span>
                        <span wire:loading wire:target="toggleCourseStatus({{ $course->id }})"
                            class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </li>
            @empty
                <li class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center">
                        <x-heroicon-o-book-open class="w-12 h-12 text-slate-300 dark:text-gray-600" /> {{-- Dark mode for empty state icon --}}
                        <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-gray-100">No courses yet</h3> {{-- Dark mode for empty state title --}}
                        <p class="mt-1 text-sm text-slate-500 dark:text-gray-400"> {{-- Dark mode for empty state description --}}
                            Get started by adding a course to this classroom.
                        </p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
</div>
