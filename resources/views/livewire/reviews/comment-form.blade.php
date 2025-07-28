<div class="px-6 py-4">
    @if (!$hasReviewed)
    <h2 class="text-xl font-semibold text-fuchsia-500">Let's Rating this Course!</h2>
    <form wire:submit.prevent="create" class="p-4">
        {{ $this->form }}

        <div class="flex justify-end mt-2">
            <button
                class="px-4 py-2 mb-2 text-sm font-semibold text-white transition duration-300 rounded-lg bg-fuchsia-600 hover:bg-fuchsia-700"
                type="submit">
                Submit
            </button>
        </div>
    </form>
    @else
    <p class="p-4 font-semibold text-green-500">
        {{ $message }}
    </p>
    @endif
</div>
