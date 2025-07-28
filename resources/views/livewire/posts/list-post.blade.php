<div class="grid grid-cols-1 gap-6 md:grid-cols-1 lg:grid-cols-1">
    <style>
        .rich-content ul,
        .rich-content ol {
            @apply pl-6 my-2;
        }

        .rich-content li {
            @apply my-1;
        }

        .rich-content ul {
            @apply list-disc;
        }

        .rich-content ol {
            @apply list-decimal;
        }
    </style>

    @forelse ($posts as $item)
        <div
            class="overflow-hidden transition-all duration-300 bg-white border shadow-sm rounded-xl hover:shadow-md dark:bg-slate-800 border-slate-100 dark:border-slate-700">
            <!-- Header with user name and post date -->
            <div class="p-4 border-b border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- User Avatar (optional) -->
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-10 h-10 font-medium text-white rounded-full bg-gradient-to-r from-indigo-500 to-blue-500">
                            {{ strtoupper(substr($item->user->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-900 dark:text-white">
                                {{ $item->user->name ?? 'Anonymous' }}
                            </h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                {{ $item->created_at->format('M d, Y · H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content section -->
            <div class="p-4">
                <div class="prose prose-slate dark:prose-invert max-w-none">
                    {!! $item->content !!}
                </div>
            </div>

            <!-- Actions -->
            <div class="px-4 py-3 border-t bg-slate-50 dark:bg-slate-800/50 border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <!-- Like Button -->
                        <button
                            class="inline-flex items-center space-x-2 transition-colors text-slate-500 hover:text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span class="text-sm font-medium">Like</span>
                        </button>

                        <!-- Comment Button -->
                        <button wire:click="toggleComments({{ $item->id }})"
                            class="inline-flex items-center space-x-2 transition-colors text-slate-500 hover:text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <span class="text-sm font-medium">Comment ({{ $item->comments->count() }})</span>
                        </button>
                    </div>

                    <!-- Share Button -->
                    <button
                        class="inline-flex items-center space-x-2 transition-colors text-slate-500 hover:text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <span class="text-sm font-medium">Share</span>
                    </button>
                </div>

                <!-- Comments Section -->
                @if ($selectedPost === $item->id)
                    <div class="mt-4 space-y-4">
                        <!-- Comment Form -->
                        <form wire:submit.prevent="addComment({{ $item->id }})" class="space-y-3">
                            <textarea wire:model.defer="newComment"
                                class="w-full px-3 py-2 text-sm border rounded-lg resize-none border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                                rows="2" placeholder="Write a comment..."></textarea>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white transition-colors rounded-lg bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    Post Comment
                                </button>
                            </div>
                        </form>

                        <!-- Comments List -->
                        @foreach ($item->comments->sortByDesc('created_at') as $comment)
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 text-sm font-medium text-white rounded-full bg-gradient-to-r from-indigo-500 to-blue-500">
                                        {{ strtoupper(substr($comment->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-1 p-4 bg-white rounded-lg shadow-sm dark:bg-slate-700">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-medium text-slate-900 dark:text-white">
                                            {{ $comment->user->name }}
                                        </h4>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="p-8 text-center bg-white shadow-sm rounded-xl dark:bg-slate-800">
            <svg class="w-12 h-12 mx-auto text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No posts available</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Get started by creating your first post.</p>
        </div>
    @endforelse

    <!-- Pagination -->
    <div class="col-span-full">
        <x-filament::pagination :paginator="$posts" />
    </div>
</div>
