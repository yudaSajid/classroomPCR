<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <div class="flex flex-col items-center md:flex-row">
            <div class="w-full {{ $hasUserInfo ? 'lg:w-full' : 'lg:w-3/4' }}">
                @livewire('dashboard.index')
            </div>
            @if (!$hasUserInfo || !$hasUserEdu)
                <div class="w-full lg:w-1/4">
                    <div class="px-6 py-4 bg-white rounded drop-shadow-sm">
                        {{-- <h1 class="font-semibold text-md text-slate-700">Announcement</h1> --}}
                        <div class="px-6 py-4 bg-white rounded-sm drop-shadow-sm">
                            <div class="flex flex-col">
                                <div class="w-24 h-24 overflow-hidden rounded">
                                    @if ($user && $user->avatar)
                                        <img class="object-cover w-full h-full "
                                            src="{{ asset('storage/' . $user->avatar) }}" alt="User Avatar">
                                    @else
                                        <img class="object-cover w-full h-full" src="https://picsum.photos/100/100/"
                                            alt="Default Avatar">
                                    @endif
                                </div>
                                <div id="text">
                                    <h1 class="mb-4 font-bold text-gray-800 text-md">Your profile has not been
                                        completed!
                                    </h1>
                                    <p class="text-sm text-gray-600">
                                        Complete your information regarding <span class="font-semibold">personal and
                                            educational data</span> according to the
                                        correct data. Complete and get rewarded!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
