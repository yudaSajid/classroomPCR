<div>
    <div class="relative p-8 overflow-hidden shadow-2xl bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-xl">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
            <svg viewBox="0 0 100 100" class="w-full h-full fill-current">
                <circle cx="50" cy="50" r="40"></circle>
            </svg>
        </div>

        <!-- Header Section -->
        <div class="relative z-10">
            <h1 class="text-3xl font-bold text-white">
                Welcome back, <span class="text-fuchsia-200">{{ Auth::user()->name }}</span> 
            </h1>
            <p class="mt-2 text-fuchsia-100 opacity-90">
                Here's a quick overview of your teaching activities.
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="relative z-10 grid grid-cols-2 gap-4 mt-6 md:grid-cols-4">
            <!-- Classrooms Card -->
            <div class="block p-4 transition-shadow rounded-lg bg-white/95 hover:shadow hover:bg-white">
                <div class="flex items-center space-x-3">
                    <div class="p-2 text-fuchsia-600 bg-fuchsia-100 rounded-lg">
                        <x-heroicon-o-academic-cap class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Classrooms</p>
                        <p class="text-2xl font-bold text-fuchsia-600">{{ $classroomCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Courses Card -->
            <div class="block p-4 transition-shadow rounded-lg bg-white/95 hover:shadow hover:bg-white">
                <div class="flex items-center space-x-3">
                    <div class="p-2 text-green-600 bg-green-100 rounded-lg">
                        <x-heroicon-o-book-open class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Courses</p>
                        <p class="text-2xl font-bold text-green-600">{{ $courseCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Assignments Card -->
            <div class="block p-4 transition-shadow rounded-lg bg-white/95 hover:shadow hover:bg-white">
                <div class="flex items-center space-x-3">
                    <div class="p-2 text-red-600 bg-red-100 rounded-lg">
                        <x-heroicon-o-pencil-square class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Assignments</p>
                        <p class="text-2xl font-bold text-red-600">{{ $assignmentCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Students Card -->
            <div class="block p-4 transition-shadow rounded-lg bg-white/95 hover:shadow hover:bg-white">
                <div class="flex items-center space-x-3">
                    <div class="p-2 text-purple-600 bg-purple-100 rounded-lg">
                        <x-heroicon-o-users class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Students</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $studentCount }}</p>
                    </div>
                </div>
            </div>
        </div> <!-- End of Stats Cards -->

        <!-- Quick Access Section -->
        <div class="relative z-10 mt-6">
            <div class="p-4 rounded-lg bg-white/95">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Quick Access</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <a href="{{ \App\Filament\Teacher\Pages\ClassroomPage::getUrl() }}" class="flex items-center p-4 space-x-3 transition-colors duration-200 border border-gray-100 rounded-lg hover:bg-gray-50">
                        <div class="p-2 text-fuchsia-600 bg-fuchsia-100 rounded-lg">
                            <x-heroicon-o-academic-cap class="w-6 h-6" />
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Manage Classrooms</h3>
                            <p class="text-sm text-gray-500">View and edit your classrooms</p>
                        </div>
                    </a>
                    <a href="{{ \App\Filament\Teacher\Pages\CoursePage::getUrl() }}" class="flex items-center p-4 space-x-3 transition-colors duration-200 border border-gray-100 rounded-lg hover:bg-gray-50">
                        <div class="p-2 text-green-600 bg-green-100 rounded-lg">
                            <x-heroicon-o-book-open class="w-6 h-6" />
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Manage Courses</h3>
                            <p class="text-sm text-gray-500">Create and update courses</p>
                        </div>
                    </a>
                    <a href="{{ \App\Filament\Teacher\Pages\BadgePage::getUrl() }}" class="flex items-center p-4 space-x-3 transition-colors duration-200 border border-gray-100 rounded-lg hover:bg-gray-50">
                        <div class="p-2 text-amber-600 bg-amber-100 rounded-lg">
                            <x-heroicon-o-trophy class="w-6 h-6" />
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Manage Badges</h3>
                            <p class="text-sm text-gray-500">Award badges to students</p>
                        </div>
                    </a>
                    <a href="{{ \App\Filament\Teacher\Resources\AssignmentResource::getUrl('index') }}" class="flex items-center p-4 space-x-3 transition-colors duration-200 border border-gray-100 rounded-lg hover:bg-gray-50">
                        <div class="p-2 text-red-600 bg-red-100 rounded-lg">
                            <x-heroicon-o-pencil-square class="w-6 h-6" />
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Grade Assignments</h3>
                            <p class="text-sm text-gray-500">Review and grade submissions</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
