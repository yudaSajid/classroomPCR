<div>
    <form wire:submit="save">
        {{ $this->form }}
        <button
            class="float-right px-4 py-2 mt-3 mr-2 font-semibold text-white transition duration-300 rounded-lg text-md bg-fuchsia-600 hover:bg-fuchsia-700"
            type="submit">
            Save
        </button>
    </form>

    <x-filament-actions::modals />
</div>
