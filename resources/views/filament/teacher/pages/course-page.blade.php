<x-filament-panels::page>
    {{-- The header actions will automatically appear in the page header --}}
    {{-- INI ADALAH DIV UTAMA YANG PERLU DITAMBAHKAN PADDING HORIZONTAL --}}
    <div class="space-y-8 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-200 min-h-screen px-4 py-8 sm:px-6 lg:px-8 rounded-xl"> {{-- << DITAMBAH: px-4 sm:px-6 lg:px-8 --}}
        <div class="p-4 mb-6 border-l-4 border-blue-500 bg-blue-50 rounded-r-xl dark:bg-blue-900/20 dark:border-blue-700">
            <div class="flex items-start">
                <div class="flex-shrink-0 pt-0.5">
                    <svg class="w-5 h-5 text-blue-400 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">Important Notice</h3>
                    <div class="mt-1 text-sm text-blue-700 dark:text-blue-400">
                        Only published courses will be visible to students. Please ensure your course is marked as
                        "Published" to make it available in the student portal.
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 bg-white shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-end">
                <div>
                    <label for="status" class="text-sm font-medium text-slate-700 dark:text-gray-300 block mb-1">Status Filter</label>
                    <select wire:model.live="selectedStatus" id="status"
                        class="block w-full py-2 pl-3 pr-10 text-base transition-all duration-200 rounded-lg shadow-sm border-slate-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="all">All Courses</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="col-span-1 md:col-span-1 lg:col-span-2">
                    <label for="search" class="text-sm font-medium text-slate-700 dark:text-gray-300 block mb-1">Search Courses</label>
                    <div class="relative">
                        <input type="search" wire:model.live.debounce.300ms="searchQuery" id="search"
                            placeholder="Search by course name..."
                            class="block w-full py-2 pl-10 pr-4 text-base transition-all duration-200 rounded-lg shadow-sm border-slate-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:placeholder-gray-400 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach (['My Courses' => $myCourses, 'Other Courses' => $allCourses] as $title => $courses)
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $title }}</h2>
                    <span class="text-sm text-slate-500 dark:text-gray-400">{{ count($courses) }} courses</span>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @forelse($courses as $course)
                        <div
                            class="relative overflow-hidden transition-all duration-300 bg-white border shadow-sm group rounded-xl hover:shadow-md border-slate-100
                            dark:bg-gray-800 dark:border-gray-700 dark:hover:shadow-lg flex flex-col">
                            <div class="relative overflow-hidden aspect-video bg-slate-100 dark:bg-gray-700">
                                @if ($course->course_photo)
                                    <img src="{{ Storage::url($course->course_photo) }}"
                                        alt="{{ $course->course_name }}"
                                        class="object-cover w-full h-full transition-transform duration-300 transform group-hover:scale-105">
                                @else
                                    <div
                                        class="absolute inset-0 transition-transform duration-300 transform bg-gradient-to-br from-indigo-500 to-blue-600 group-hover:scale-105
                                        dark:from-indigo-700 dark:to-blue-800">
                                        <div
                                            class="absolute inset-0 transition-colors duration-300 bg-black/10 group-hover:bg-black/0">
                                        </div>
                                        <svg class="absolute w-12 h-12 transform -translate-x-1/2 -translate-y-1/2 text-white/90 top-1/2 left-1/2"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="absolute top-3 right-3">
                                    <span @class([
                                        'px-2.5 py-1 text-xs font-medium rounded-full shadow-sm backdrop-blur-sm transition-all duration-300',
                                        'bg-green-100/90 text-green-800 dark:bg-green-900/50 dark:text-green-300' => $course->course_publish,
                                        'bg-slate-100/90 text-slate-800 dark:bg-gray-700/50 dark:text-gray-300' => !$course->course_publish,
                                    ])>
                                        {{ $course->course_publish ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <h3 class="text-lg font-medium truncate text-slate-900 dark:text-white mb-2">{{ $course->course_name }}</h3>

                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500 dark:text-gray-400 mt-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-slate-500 dark:text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        {{ $course->chapters_count ?? 0 }} Chapters
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-slate-500 dark:text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $course->total_materials ?? 0 }} Materials
                                    </span>
                                </div>
                            </div>

                            <div class="px-4 py-3 border-t bg-slate-50/80 border-slate-100 dark:bg-gray-700/50 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-medium text-slate-600 dark:text-gray-300">Teaching</span>
                                    <a href="{{ route('filament.teacher.resources.course-details.view', ['record' => $course]) }}"
                                        class="inline-flex items-center text-xs font-medium text-indigo-600 transition-colors duration-200 hover:text-indigo-500
                                        dark:text-indigo-400 dark:hover:text-indigo-300">
                                        Manage
                                        <svg class="w-4 h-4 ml-1 transition-transform duration-200 transform group-hover:translate-x-1"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="p-12 text-center bg-white border border-dashed rounded-xl border-slate-200
                                        dark:bg-gray-800 dark:border-gray-700 dark:border-dashed">
                                <svg class="w-12 h-12 mx-auto text-slate-400 dark:text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No courses found</h3>
                                <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">
                                    {{ $title === 'My Courses' ? 'Get started by creating a new course.' : 'Check back later for new courses.' }}
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>