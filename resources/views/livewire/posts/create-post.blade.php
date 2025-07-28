<div class="px-6 py-4">
    <div class="max-w-2xl mx-auto">
        <form wire:submit.prevent="create" class="space-y-6">
            <div class="p-6 bg-white border shadow-sm rounded-xl border-slate-100">
                <!-- Form Title -->
                <div class="mb-6">
                    <h2
                        class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600">
                        Create New Post
                    </h2>
                    <div class="mt-1 text-sm text-slate-500">
                        Share your thoughts with the community
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="prose max-w-none">
                    {{ $this->form }}
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 mt-6 border-t border-slate-100">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 rounded-lg shadow-sm bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Publish Post
                    </button>
                </div>
            </div>
        </form>
    </div>

    <x-filament-actions::modals />
</div>
