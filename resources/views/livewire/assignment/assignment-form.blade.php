<div class="p-6 bg-white shadow-sm rounded-xl">
    @if (!$hasReviewed)
        <form wire:submit.prevent="create" class="space-y-6">
            <div class="prose max-w-none">
                {{ $this->form }}
            </div>

            <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg">
                <p><strong>Important:</strong> If you're submitting links from Google Drive, Google Docs, or similar
                    services:</p>
                <ul class="mt-2 ml-4 list-disc">
                    <li>Make sure to set the sharing permission to "Anyone with the link can view"</li>
                    <li>Double-check that the link is accessible before submitting</li>
                    <li>Keep the sharing settings unchanged until your assignment is reviewed</li>
                </ul>
            </div>

            <div class="flex justify-end pt-4 border-t">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 rounded-lg shadow-sm bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-700 hover:to-purple-700 focus:ring-2 focus:ring-offset-2 focus:ring-fuchsia-500">
                    <x-heroicon-m-paper-airplane class="w-4 h-4 mr-2" />
                    Submit Assignment
                </button>
            </div>
        </form>
    @else
        <div class="space-y-6">
            <!-- Status Header -->
            <div class="flex items-center space-x-3">
                @if ($status === 'approved')
                    <div class="flex-shrink-0">
                        <div class="p-2 bg-green-100 rounded-full">
                            <x-heroicon-m-check-circle class="w-6 h-6 text-green-600" />
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-green-600">{{ $message }}</h2>
                        <p class="text-sm text-green-600/75">Your assignment has been reviewed and graded</p>
                    </div>
                @elseif($status === 'rejected')
                    <div class="flex-shrink-0">
                        <div class="p-2 bg-red-100 rounded-full">
                            <x-heroicon-m-x-circle class="w-6 h-6 text-red-600" />
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-red-600">{{ $message }}</h2>
                        <p class="text-sm text-red-600/75">Please review the feedback and make necessary improvements
                        </p>
                    </div>
                @else
                    <div class="flex-shrink-0">
                        <div class="p-2 rounded-full bg-fuchsia-100">
                            <x-heroicon-m-clock class="w-6 h-6 text-fuchsia-600" />
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-fuchsia-600">{{ $message }}</h2>
                        <p class="text-sm text-fuchsia-600/75">Your assignment is being reviewed</p>
                    </div>
                @endif
            </div>

            @if ($status === 'approved')
                <div class="overflow-hidden bg-gray-50 rounded-xl">
                    <!-- Score Section -->
                    @if ($score !== null)
                        <div class="px-6 py-5 border-b border-gray-200/75">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <x-heroicon-m-star class="w-5 h-5 text-gray-400" />
                                    <span class="text-sm font-medium text-gray-600">Score Achieved</span>
                                </div>
                                <span
                                    class="text-2xl font-bold tracking-tight {{ $score >= 85
                                        ? 'text-green-600'
                                        : ($score >= 70
                                            ? 'text-blue-600'
                                            : ($score >= 50
                                                ? 'text-amber-600'
                                                : 'text-red-600')) }}">
                                    {{ $score }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <!-- Teacher's Notes Section -->
                    @if ($notes)
                        <div class="px-6 py-5">
                            <div class="space-y-3">
                                <div class="flex items-center space-x-2">
                                    <x-heroicon-m-chat-bubble-left-right class="w-5 h-5 text-gray-400" />
                                    <span class="text-sm font-medium text-gray-600">Teacher's Feedback</span>
                                </div>
                                <div class="p-4 bg-white border rounded-lg border-gray-200/75">
                                    <p class="text-gray-700 whitespace-pre-line">{{ $notes }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @endif
</div>
