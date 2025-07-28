<x-filament-panels::page>

    <x-filament::tabs>
        <x-filament::tabs.item :active="$activeTab === 'tab1'" wire:click="$set('activeTab', 'tab1')">
            Education Data
        </x-filament::tabs.item>
        <x-filament::tabs.item :active="$activeTab === 'tab2'" wire:click="$set('activeTab', 'tab2')">
            Personal Data
        </x-filament::tabs.item>

    </x-filament::tabs>
    @if ($activeTab == 'tab1')
        <div class="px-6 py-4 bg-white rounded drop-shadow-md">
            <h1 class="p-3 text-xl font-semibold text-left">Education Data</h1>
            @livewire('user-informations.edit-education')
        </div>
    @elseif ($activeTab == 'tab2')
        <div class="px-6 py-4 bg-white rounded drop-shadow-md">
            <h1 class="p-3 text-xl font-semibold text-left">Personal Data</h1>
            @livewire('user-informations.edit-product')
        </div>
    @endif
</x-filament-panels::page>
