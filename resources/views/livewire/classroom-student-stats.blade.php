<div class="space-y-6 bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-200 py-6 px-4 sm:px-6 lg:px-8">
    @forelse($studentStats as $stat)
        <div class="overflow-hidden bg-white rounded-xl shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-700">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full dark:bg-purple-900">
                            <span class="text-xl font-bold text-purple-600 dark:text-purple-300">
                                {{ $stat['student']['initial'] }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white">{{ $stat['student']['name'] }}</h4>
                    </div>
                </div>
            </div>

            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    {{-- Overall Progress - Persentase di atas, X/Y materials di bawah --}}
                    <div class="p-4 text-center rounded-lg bg-purple-50 dark:bg-purple-900 transition-shadow duration-300 hover:shadow-xl dark:hover:shadow-2xl">
                        <div class="text-3xl font-extrabold text-purple-600 dark:text-purple-300">
                            {{ $stat['material_completion']['percentage'] }}% {{-- Persentase tetap ada di sini --}}
                        </div>
                        <div class="text-sm font-semibold text-purple-600 dark:text-purple-400 mt-1">Overall Progress</div>
                        <div class="text-xs text-purple-500 dark:text-purple-500 mt-0.5">
                            {{ $stat['material_completion']['completed'] }}/{{ $stat['material_completion']['total'] }} materials {{-- X/Y materials --}}
                        </div>
                    </div>

                    {{-- Quiz Average --}}
                    <div class="p-4 text-center rounded-lg bg-blue-50 dark:bg-blue-900 transition-shadow duration-300 hover:shadow-xl dark:hover:shadow-2xl">
                        <div class="text-3xl font-extrabold text-blue-600 dark:text-blue-300">
                            {{ $stat['quiz_performance']['average_score'] }}
                        </div>
                        <div class="text-sm font-semibold text-blue-600 dark:text-blue-400 mt-1">Quiz Average</div>
                        <div class="text-xs text-blue-500 dark:text-blue-500 mt-0.5">
                            {{ $stat['quiz_performance']['attempts'] }} attempts
                        </div>
                    </div>

                    {{-- Total Points --}}
                    <div class="p-4 text-center rounded-lg bg-amber-50 dark:bg-amber-900 transition-shadow duration-300 hover:shadow-xl dark:hover:shadow-2xl">
                        <div class="text-3xl font-extrabold text-amber-600 dark:text-amber-300">
                            {{ number_format($stat['total_points']) }}
                        </div>
                        <div class="text-sm font-semibold text-amber-600 dark:text-amber-400 mt-1">Total Points</div>
                    </div>
                </div>
            </div>

            @if (isset($stat['courses']) && count($stat['courses']) > 0)
                <div class="p-6">
                    <h5 class="mb-4 text-base font-semibold text-gray-700 dark:text-gray-400">Course Progress</h5>
                    <div class="space-y-4">
                        @foreach ($stat['courses'] as $course)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700 last:border-b-0">
                                <div class="flex-1 min-w-0 sm:pr-4 mb-2 sm:mb-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $course['name'] }}
                                        </span>
                                        <span class="text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $course['completion'] }}%
                                        </span>
                                    </div>
                                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                                        <div class="h-full transition-all duration-500 rounded-full"
                                            @class([
                                                'bg-green-500' => $course['completion'] == 100,
                                                'bg-purple-500' => $course['completion'] > 0 && $course['completion'] < 100,
                                                'bg-red-500' => $course['completion'] == 0,
                                            ])
                                            style="width: {{ $course['completion'] }}%">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 flex items-center space-x-4 ml-0 sm:ml-4 w-full sm:w-auto justify-end sm:justify-start">
                                    <div class="text-right">
                                        <div class="text-xs text-gray-500 whitespace-nowrap dark:text-gray-500">Quiz Score</div>
                                        <div class="text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $course['quiz_average'] }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-xs text-gray-500 whitespace-nowrap dark:text-gray-500">Points</div>
                                        <div class="text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ number_format($course['points']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @empty
        <div class="py-12 text-center bg-white rounded-lg shadow border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600">
                <x-heroicon-o-users class="w-12 h-12" />
            </div>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No Students</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No students are enrolled in this classroom yet.</p>
        </div>
    @endforelse
</div>