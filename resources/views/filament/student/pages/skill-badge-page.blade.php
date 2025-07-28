<x-filament-panels::page>
    <div class="p-4">
        {{-- Section: Your Achievement Badges (Header and Total Points) --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                {{-- Header Text --}}
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Your Achievement Badges</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Track your progress and earn rewards</p>
            </div>
            {{-- Total Points Card --}}
            <div class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-100 rounded-lg shadow-sm
                        dark:bg-gray-800 dark:border-gray-700 dark:shadow-lg"> {{-- Add dark: classes --}}
                <svg class="w-5 h-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"> {{-- Add dark:text --}}
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium text-gray-900 dark:text-gray-100">{{ number_format($this->getUserPoints()) }}</span> {{-- Add dark:text --}}
                <span class="text-sm text-gray-500 dark:text-gray-400">points</span> {{-- Add dark:text --}}
            </div>
        </div>

        {{-- Grid of Badges --}}
        <div class="grid grid-cols-4 gap-6 sm:grid-cols-1 lg:grid-cols-4 xl:grid-cols-4">
            @foreach ($this->getBadges() as $badge)
                <div
                    class="relative overflow-hidden transition-all duration-300 rounded-xl hover:shadow-xl
                           bg-white dark:bg-gray-800 shadow-md dark:shadow-lg group"> {{-- Add dark: classes for badge card --}}
                    <div class="relative p-6 {{ !$badge['is_claimable'] ? 'grayscale' : '' }}">
                        <div class="flex justify-center mb-4">
                            <div
                                class="relative w-24 h-24 transition-transform duration-300 transform group-hover:scale-110">
                                @if ($badge['image'])
                                    <img src="{{ Storage::url($badge['image']) }}" alt="{{ $badge['name'] }}"
                                        class="object-cover w-full h-full rounded-full ring-4 ring-offset-2
                                               {{ $badge['is_claimed'] ? 'ring-green-500 dark:ring-green-400' : ($badge['is_claimable'] ? 'ring-indigo-500 dark:ring-indigo-400' : 'ring-gray-200 dark:ring-gray-700') }}
                                               dark:ring-offset-gray-800"> {{-- Add dark:ring and dark:ring-offset --}}
                                @else
                                    <div class="flex items-center justify-center w-full h-full text-3xl font-bold text-white rounded-full ring-4 ring-offset-2
                                                {{ $badge['is_claimed'] ? 'ring-green-500 dark:ring-green-400' : ($badge['is_claimable'] ? 'ring-indigo-500 dark:ring-indigo-400' : 'ring-gray-200 dark:ring-gray-700') }}
                                                dark:ring-offset-gray-800" {{-- Add dark:ring and dark:ring-offset --}}
                                        style="background-color: {{ $badge['color'] }}">
                                        {{ substr($badge['name'], 0, 2) }}
                                    </div>
                                @endif

                                @if ($badge['is_claimed'])
                                    <div
                                        class="absolute -top-1 -right-1 p-1.5 text-white bg-green-500 rounded-full shadow-lg dark:bg-green-700 dark:text-green-100"> {{-- Add dark:bg & dark:text --}}
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-center">
                            <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $badge['name'] }}</h3> {{-- Add dark:text --}}
                            <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">{!! $badge['description'] !!}</p> {{-- Add dark:text --}}
                            <div class="mb-4">
                                @if ($badge['type']->value === \App\Enums\BadgeType::Custom->value)
                                    <span
                                        class="px-3 py-1 text-sm border rounded-full shadow-sm
                                        bg-amber-50 text-amber-600 border-amber-200
                                        dark:bg-amber-900 dark:text-amber-200 dark:border-amber-700">Gifted</span> {{-- Add dark: classes --}}
                                @else
                                    <span
                                        class="px-3 py-1 text-sm rounded-full
                                        {{ $badge['is_claimable'] ? 'text-indigo-600 bg-indigo-50 dark:text-indigo-200 dark:bg-indigo-900' : 'text-gray-600 bg-gray-100 dark:text-gray-300 dark:bg-gray-700' }}"> {{-- Add dark: classes --}}
                                        {{ number_format($badge['point_require']) }} points required
                                    </span>
                                @endif
                            </div>

                            @if ($badge['is_claimable'] && !$badge['is_claimed'])
                                <button wire:click="claimBadge({{ $badge['id'] }})" wire:loading.attr="disabled"
                                    class="w-full px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-indigo-600 rounded-lg shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50
                                           dark:bg-indigo-700 dark:hover:bg-indigo-600 dark:focus:ring-offset-gray-800"> {{-- Add dark: classes --}}
                                    <span class="flex items-center justify-center">
                                        <svg wire:loading.remove class="w-5 h-5 mr-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <svg wire:loading class="w-5 h-5 mr-2 animate-spin" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        <span wire:loading.remove>Claim Badge</span>
                                        <span wire:loading>Claiming...</span>
                                    </span>
                                </button>
                            @elseif($badge['is_claimed'])
                                <span
                                    class="inline-block w-full px-4 py-2 text-sm font-medium rounded-lg
                                           text-green-700 bg-green-100 dark:bg-green-800 dark:text-green-200"> {{-- Add dark: classes --}}
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Claimed
                                    </span>
                                </span>
                            @else
                                <span
                                    class="inline-block w-full px-4 py-2 text-sm font-medium rounded-lg
                                           text-gray-500 bg-gray-100 dark:bg-gray-700 dark:text-gray-200"> {{-- Add dark: classes --}}
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Not Yet Available
                                    </span>
                                </span>
                            @endif
                        </div>
                    </div>

                    @if (!$badge['is_claimed'] && !$badge['is_claimable'])
                        <div class="h-2 bg-gray-200 dark:bg-gray-700"> {{-- Menyesuaikan background progress bar --}}
                            <div class="h-full transition-all duration-300 bg-gradient-to-r
                                        from-indigo-600 to-purple-600
                                        dark:from-indigo-500 dark:to-purple-500" {{-- Menyesuaikan gradient untuk dark mode --}}
                                style="width: {{ min(100, ($this->getUserPoints() / $badge['point_require']) * 100) }}%">
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="p-4 mt-8">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Point History</h3> {{-- Add dark:text --}}
        <div class="mt-4 bg-white shadow-sm rounded-xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700"> {{-- Add dark: classes --}}
            <div class="overflow-hidden">
                <ul class="divide-y divide-gray-100 dark:divide-gray-700"> {{-- Add dark:divide --}}
                    @forelse($this->getPointHistory() as $point)
                        <li
                            class="relative flex items-center justify-between p-4 transition-all duration-200 group
                                   hover:bg-gray-50 dark:hover:bg-gray-700"> {{-- Add dark:hover --}}
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if (str_contains(strtolower($point->reason), 'quiz'))
                                        <div class="p-2 rounded-lg
                                                    text-purple-600 bg-purple-100 dark:text-purple-300 dark:bg-purple-900/50"> {{-- Add dark: classes --}}
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    @elseif(str_contains(strtolower($point->reason), 'course'))
                                        <div class="p-2 rounded-lg
                                                    text-blue-600 bg-blue-100 dark:text-blue-300 dark:bg-blue-900/50"> {{-- Add dark: classes --}}
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @else
                                        <div class="p-2 rounded-lg
                                                    text-emerald-600 bg-emerald-100 dark:text-emerald-300 dark:bg-emerald-900/50"> {{-- Add dark: classes --}}
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $point->reason }}</p> {{-- Add dark:text --}}
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $point->created_at->diffForHumans() }}</p> {{-- Add dark:text --}}
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full
                                           {{ $point->points >= 0 ? 'text-green-700 bg-green-100 dark:text-green-200 dark:bg-green-800' : 'text-red-700 bg-red-100 dark:text-red-200 dark:bg-red-800' }}"> {{-- Add dark: classes --}}
                                    {{ $point->points >= 0 ? '+' : '' }}{{ $point->points }}
                                </span>
                                <div class="transition-opacity opacity-0 group-hover:opacity-100">
                                    @if ($point->course)
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs rounded
                                                   text-gray-600 bg-gray-100 dark:text-gray-300 dark:bg-gray-700"> {{-- Add dark: classes --}}
                                            {{ Str::limit($point->course->title, 20) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="p-8 text-center">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-gray-50 dark:bg-gray-700"> {{-- Add dark:bg --}}
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400">No point history available yet</p> {{-- Add dark:text --}}
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-filament-panels::page>