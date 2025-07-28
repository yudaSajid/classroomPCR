<div>
    <div class="relative p-8 overflow-hidden shadow-2xl bg-gradient-to-br from-fuchsia-600 to-purple-700 rounded-xl">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
            <svg viewBox="0 0 100 100" class="w-full h-full fill-current">
                <circle cx="50" cy="50" r="40"></circle>
            </svg>
        </div>

        <!-- Header Section -->
        <div class="relative z-10">
            <h1 class="text-3xl font-bold text-white">
                Hey there, <span class="text-fuchsia-200">{{ Auth::user()->name }}</span> 👋
            </h1>
            <p class="mt-2 text-fuchsia-100 opacity-90">
                Ready to level up your skills today? Let's get started!
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="relative z-10 grid grid-cols-2 gap-4 mt-6">
            <!-- SkilPoin Card -->
            <a href="{{ route('filament.student.pages.skill-badge-page') }}"
                class="block p-4 transition-shadow rounded-lg bg-white/95 hover:shadow hover:bg-white">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-lg text-fuchsia-600 bg-fuchsia-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total SkilPoin</p>
                        <p class="text-2xl font-bold text-fuchsia-600">{{ $points }}</p>
                    </div>
                </div>
            </a>

            <!-- SkilBadge Card -->
            <a href="{{ route('filament.student.pages.skill-badge-page') }}"
                class="block p-4 transition-shadow rounded-lg bg-white/95 hover:shadow hover:bg-white">
                <div class="flex items-center space-x-3">
                    <div class="p-2 text-yellow-600 bg-yellow-100 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">SkilBadge</p>
                        <p class="text-2xl font-bold text-yellow-500">{{ $badgeCount }}</p>
                    </div>
                </div>
            </a>
        </div> <!-- End of Stats Cards -->

        <!-- After Stats Cards and before Redeem Code Section -->
        <div class="relative z-10 mt-6">
            <div class="p-4 rounded-lg bg-white/95">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">My Class Enrollments</h2>

                <div class="space-y-3">
                    @forelse($enrolledClassrooms as $enrollment)
                        <div
                            class="flex items-center justify-between p-3 transition-colors duration-200 border border-gray-100 rounded-lg hover:bg-gray-50">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="flex items-center justify-center w-10 h-10 text-purple-600 bg-purple-100 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">
                                        {{ $enrollment->classroom?->class_name ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $enrollment->classroom?->program?->program_name ?? 'No Program' }}
                                        • {{ $enrollment->classroom?->class_code ?? 'No Code' }}
                                </div>
                            </div>
                            {{-- <a href="{{ route('filament.student.pages.classroom-details', ['record' => $enrollment->classroom]) }}" --}}
                            {{-- <a href="#"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-purple-600 border border-purple-200 rounded-lg hover:bg-purple-50">
                                View Class
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a> --}}
                        </div>
                    @empty
                        <div class="py-6 text-center">
                            <div class="flex justify-center mb-3">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="font-medium text-gray-500">No Classes Yet</h3>
                            <p class="mt-1 text-sm text-gray-400">Join a class to get started!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Redeem Code Section -->
        <div class="relative z-10 mt-6">
            <button wire:click="$set('showRedeemModal', true)"
                class="flex items-center px-4 py-2 space-x-2 text-sm font-medium transition-all duration-200 rounded-lg bg-white/90 hover:bg-white focus:outline-none focus:ring-2 focus:ring-white/50">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="text-gray-700">Join New Class</span>
            </button>
        </div>
    </div>

    <!-- Redeem Modal -->
    <div x-data="{ show: @entangle('showRedeemModal') }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white dark:bg-gray-900 rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                <div>
                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-purple-100 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Join a Class
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Enter the 6-character class code provided by your teacher.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div>
                        <label for="classCode" class="sr-only">Class Code</label>
                        <input wire:model="classCode" type="text" id="classCode"
                            class="block w-full px-4 py-3 text-center uppercase dark:bg-gray-700 border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500"
                            placeholder="XXXX00" maxlength="6">
                        @error('classCode')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-5 space-y-2 sm:mt-6">
                    <button wire:click="redeemCode"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white transition-colors duration-200 bg-purple-600 border border-transparent rounded-md shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:text-sm">
                        Join Class
                    </button>
                    <button wire:click="$set('showRedeemModal', false)"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 transition-colors duration-200 bg-gray-100 border border-transparent rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
