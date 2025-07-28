<div class="text-gray-800 dark:text-gray-200 min-h-screen bg-gray-100 dark:bg-gray-900">
    {{-- Header --}}
    <div class="flex items-center p-5 bg-gray-200 dark:bg-gray-800 rounded-t-lg shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.25 2.25a.75.75 0 00-1.5 0v1.125c-1.01.16-1.95.5-2.793 1.028A6.75 6.75 0 002.25 15v.75a.75.75 0 001.5 0v-.75a5.25 5.25 0 019.44-2.402.75.75 0 00-1.41-.548A3.75 3.75 0 008.25 15v.75a.75.75 0 001.5 0v-.75a2.25 2.25 0 014.5 0v.75a.75.75 0 001.5 0V15a6.75 6.75 0 00-6.75-6.75 6.73 6.73 0 00-3.25.834V3.375c.996-.434 2.12-.625 3.25-.625V2.25z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 16.5a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.5a.75.75 0 01-.75-.75z" />
        </svg>
        <h2 class="ml-3 text-2xl font-bold text-gray-900 dark:text-white">Leaderboard on <span class="text-yellow-600 dark:text-yellow-400">{{ $courseName }}</span></h2>
    </div>

    <div class="p-6 bg-gray-100 dark:bg-gray-900">
        {{-- Top 3 Podium --}}
        @if(count($topPoints) > 0)
            <div class="flex flex-col md:flex-row items-end justify-center gap-x-6 mb-10">
                {{-- Rank 2 --}}
                @if(isset($topPoints[1]))
                <div class="order-2 md:order-1 w-full md:w-1/4 text-center mt-6 md:mt-0 transition-transform duration-300 transform hover:scale-105">
                    <div class="relative inline-block p-2 bg-gray-200 dark:bg-gray-700 rounded-xl border-b-4 border-gray-300 dark:border-gray-600">
                        <img src="{{ $topPoints[1]->avatar }}" class="w-20 h-20 mx-auto rounded-full object-cover shadow-lg ring-4 ring-gray-400 dark:ring-gray-500" alt="{{ $topPoints[1]->name }}">
                        <div class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 -mt-4 -mr-4 bg-gray-500 dark:bg-gray-600 border-2 border-white dark:border-gray-800 rounded-full shadow-md">
                            <span class="text-lg font-bold text-white">2</span>
                        </div>
                    </div>
                    <h3 class="mt-3 text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $topPoints[1]->name }}</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">{{ $topPoints[1]->formatted_points }} Pts</p>
                </div>
                @endif

                {{-- Rank 1 --}}
                @if(isset($topPoints[0]))
                <div class="order-1 md:order-2 z-10 w-full md:w-1/3 text-center transition-transform duration-300 transform hover:scale-105">
                    <div class="relative inline-block p-3 bg-yellow-300 dark:bg-yellow-700 rounded-xl border-b-4 border-yellow-400 dark:border-yellow-600">
                        <img src="{{ $topPoints[0]->avatar }}" class="w-24 h-24 mx-auto rounded-full object-cover shadow-xl ring-4 ring-yellow-500 dark:ring-yellow-400" alt="{{ $topPoints[0]->name }}">
                        <div class="absolute top-0 right-0 flex items-center justify-center w-10 h-10 -mt-5 -mr-5 bg-yellow-500 dark:bg-yellow-600 border-2 border-white dark:border-gray-800 rounded-full shadow-md">
                            <span class="text-xl font-bold text-white">1</span>
                        </div>
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-yellow-800 dark:text-yellow-200">{{ $topPoints[0]->name }}</h3>
                    <p class="font-semibold text-lg text-yellow-700 dark:text-yellow-400">{{ $topPoints[0]->formatted_points }} Pts</p>
                </div>
                @endif

                {{-- Rank 3 --}}
                @if(isset($topPoints[2]))
                <div class="order-3 md:order-3 w-full md:w-1/4 text-center mt-6 md:mt-0 transition-transform duration-300 transform hover:scale-105">
                    <div class="relative inline-block p-2 bg-orange-200 dark:bg-orange-700 rounded-xl border-b-4 border-orange-300 dark:border-orange-600">
                        <img src="{{ $topPoints[2]->avatar }}" class="w-20 h-20 mx-auto rounded-full object-cover shadow-lg ring-4 ring-orange-400 dark:ring-orange-500" alt="{{ $topPoints[2]->name }}">
                        <div class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 -mt-4 -mr-4 bg-orange-500 dark:bg-orange-600 border-2 border-white dark:border-gray-800 rounded-full shadow-md">
                            <span class="text-lg font-bold text-white">3</span>
                        </div>
                    </div>
                    <h3 class="mt-3 text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $topPoints[2]->name }}</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">{{ $topPoints[2]->formatted_points }} Pts</p>
                </div>
                @endif
            </div>
        @else
            <div class="text-center py-8 text-lg font-medium text-gray-500 dark:text-gray-400">
                The leaderboard is empty. Be the first to get points!
            </div>
        @endif

        {{-- Ranks 4+ --}}
        <div class="mt-8">
            <h3 class="mb-4 text-xl font-bold text-center text-gray-700 dark:text-gray-300">Top Ranks</h3>
            <div class="space-y-3">
                @foreach($topPoints as $index => $point)
                    @if($index >= 3)
                    <div class="flex items-center p-3 transition-all duration-300 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 transform hover:-translate-y-0.5">
                        <div class="w-10 text-xl font-bold text-center text-gray-600 dark:text-gray-300">{{ $index + 1 }}</div>
                        <img src="{{ $point->avatar }}" class="w-12 h-12 ml-4 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-700" alt="{{ $point->name }}">
                        <div class="ml-4 flex-grow">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $point->name }}</h4>
                        </div>
                        <div class="ml-auto text-lg font-bold text-gray-800 dark:text-gray-200">{{ $point->formatted_points }} Pts</div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- Current User Rank --}}
    @if($currentUserRank)
    <div class="p-5 bg-gray-200 dark:bg-gray-800 rounded-b-lg shadow-inner mt-4">
        <div class="flex items-center">
            <div class="w-14 text-2xl font-bold text-center text-gray-800 dark:text-white">#{{ $currentUserRank }}</div>
            <img src="{{ Auth::user()->profile_photo_url }}" class="w-14 h-14 ml-4 rounded-full object-cover ring-3 ring-fuchsia-500 shadow-md" alt="{{ Auth::user()->name }}">
            <div class="ml-4 flex-grow">
                <h4 class="font-bold text-gray-800 dark:text-white">Your Position</h4>
                <p class="text-gray-600 dark:text-gray-300">{{ Auth::user()->name }}</p>
            </div>
            <div class="ml-auto text-xl font-bold text-fuchsia-600 dark:text-fuchsia-400">{{ $currentUserPoints }} Pts</div>
        </div>
    </div>
    @else
        <div class="p-5 text-center text-base text-white bg-gray-800 rounded-b-lg shadow-inner mt-4">
            You are not yet ranked in this course. Complete activities to earn points!
        </div>
    @endif
</div>