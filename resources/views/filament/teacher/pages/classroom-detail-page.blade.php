<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="p-6 bg-white shadow-sm rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $classroom->class_name }}</h1>
                    <div class="mt-1 space-x-2">
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-purple-700 bg-purple-100 rounded-full">
                            {{ $classroom->program->program_name }}
                        </span>
                        <span class="text-sm text-gray-500">Year: {{ $classroom->enrollment_year }}</span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-full">
                        Class Code: {{ $classroom->class_code }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($studentStats as $stat)
                <div class="p-6 bg-white shadow-sm rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 text-lg font-bold text-white bg-blue-500 rounded-xl">
                                {{ substr($stat['student']->name, 0, 1) }}
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $stat['student']->name }}</h3>
                            <p class="text-sm text-gray-500">Student</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="p-3 rounded-lg bg-gray-50">
                            <p class="text-sm font-medium text-gray-500">Material Progress</p>
                            <div class="flex items-baseline mt-1">
                                <p class="text-2xl font-semibold text-gray-900">{{ $stat['material_completion']['percentage'] }}%</p>
                                <p class="ml-2 text-sm text-gray-500">
                                    {{ $stat['material_completion']['completed'] }}/{{ $stat['material_completion']['total'] }}
                                </p>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-gray-50">
                            <p class="text-sm font-medium text-gray-500">Avg Quiz Score</p>
                            <div class="flex items-baseline mt-1">
                                <p class="text-2xl font-semibold text-gray-900">{{ $stat['quiz_performance']['average_score'] }}</p>
                                <p class="ml-2 text-sm text-gray-500">
                                    ({{ $stat['quiz_performance']['attempts'] }} attempts)
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="p-3 rounded-lg bg-purple-50">
                            <p class="text-sm font-medium text-purple-600">Total Points</p>
                            <p class="text-2xl font-semibold text-purple-700">{{ number_format($stat['total_points']) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-filament-panels::page>