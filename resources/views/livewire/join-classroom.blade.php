<!-- filepath: /c:/Programs/e-learning-app-multi/resources/views/livewire/join-classroom.blade.php -->
<div>
    <!-- Join Button -->
    <button wire:click="$set('showJoinModal', true)"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Join Class
    </button>

    <!-- Join Modal -->
    <div x-data="{ shown: @entangle('showJoinModal') }" x-show="shown" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">

        <div class="flex items-center justify-center min-h-screen p-4 ">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

            <div class="relative w-full max-w-md bg-white dark:bg-gray-900 shadow-lg rounded-xl">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Join a Classroom</h3>
                        <button wire:click="$set('showJoinModal', false)" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <!-- Search Input -->
                    <div class="mb-4">
                        <input type="text" wire:model.live="search"
                            class="block w-full px-4 py-2 border border-gray-500 dark:bg-gray-900 rounded-lg focus:ring-rose-500 focus:border-rose-500"
                            placeholder="Search classes...">
                    </div>

                    <!-- Available Classes List -->
                    <div class="mb-4 space-y-2 overflow-y-auto max-h-60">
                        @forelse($availableClassrooms as $classroom)
                            <div
                                class="flex items-center justify-between p-3 rounded-lg bg-gray-50 group hover:bg-rose-50">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $classroom->class_name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $classroom->program->program_name }}</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="font-mono text-sm text-gray-500">{{ $classroom->class_code }}</span>
                                    <button wire:click="joinWithCode('{{ $classroom->class_code }}')"
                                        class="px-3 py-1 text-sm rounded-md text-rose-600 bg-rose-100 hover:bg-rose-200">
                                        Join
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="py-4 text-center text-gray-500">
                                No available classes found
                            </div>
                        @endforelse
                    </div>

                    <!-- Direct Join Form -->
                    <div class="pt-4 border-t">
                        <form wire:submit="joinClassroom">
                            {{ $this->form }}

                            <div class="flex justify-end mt-4 space-x-3">
                                <button type="button" wire:click="$set('showJoinModal', false)"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white rounded-lg bg-rose-600 hover:bg-rose-700">
                                    Join Class
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
