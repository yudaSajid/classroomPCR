<div class="p-6 space-y-8 bg-gray-900 min-h-screen text-gray-200">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Badge Management</h1>
            <p class="mt-1 text-sm text-gray-400">Manage and assign custom badges to users</p>
        </div>
        <div class="flex space-x-3">
            <button wire:click="toggleRecipients"
                class="px-4 py-2 text-sm font-medium border rounded-lg hover:bg-gray-700
                       {{ $showRecipients ? 'bg-gray-700 text-white border-gray-600' : 'text-gray-300 border-gray-700' }}">
                {{ $showRecipients ? 'Show Badges' : 'Show Recipients' }}
            </button>
            <button wire:click="openModal"
                class="px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-600 hover:bg-primary-500">
                Create New Badge
            </button>
        </div>
    </div>

    <x-custom-alert type="info" message="Anda bisa memberikan badge custom untuk student"
        class="mt-4" />
    @if (!$showRecipients)
        <div class="bg-gray-800 shadow-sm rounded-xl">
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @forelse($badges as $badge)
                        <div
                            class="relative overflow-hidden transition-all duration-300 bg-gray-700 border border-gray-700 group rounded-xl hover:shadow-lg hover:border-primary-600">
                            <div class="p-5">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ Storage::url($badge->image) }}" alt="{{ $badge->name }}"
                                            class="object-cover w-20 h-20 transition-transform transform rounded-lg group-hover:scale-105"
                                            style="border: 3px solid {{ $badge->color }}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-white truncate">
                                            {{ $badge->name }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-400 line-clamp-2">
                                            {{ $badge->description }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button wire:click="selectBadge({{ $badge->id }})"
                                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Assign Badge
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="flex flex-col items-center justify-center py-12 col-span-full bg-gray-800 rounded-xl">
                            <x-heroicon-o-check-badge class="w-16 h-16 text-gray-600" />
                            <p class="mt-4 text-lg font-medium text-white">No Badges Available</p>
                            <p class="mt-1 text-sm text-gray-400">Create your first badge to get started</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @else
        <div class="bg-gray-800 shadow-sm rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-white">Badge Recipients</h2>
                </div>

                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">
                                    User</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">
                                    Badge</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">
                                    Awarded Date</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @forelse($recipients as $recipient)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ $recipient->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($recipient->user->name) . '&background=374151&color=ffffff' }}"
                                                    alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-white">
                                                    {{ $recipient->user->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-8 h-8">
                                                <img src="{{ Storage::url($recipient->badge->image) }}"
                                                    class="w-8 h-8 rounded-full"
                                                    style="border: 2px solid {{ $recipient->badge->color }}">
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm text-white">{{ $recipient->badge->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-400 whitespace-nowrap">
                                        {{ $recipient->awarded_date->format('M d, Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full {{ $recipient->is_claimed ? 'text-green-300 bg-green-900' : 'text-yellow-300 bg-yellow-900' }}">
                                            {{ $recipient->is_claimed ? 'Claimed' : 'Unclaimed' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <button wire:click="toggleClaimed({{ $recipient->id }})"
                                            class="text-indigo-400 hover:text-indigo-300">
                                            {{ $recipient->is_claimed ? 'Mark Unclaimed' : 'Mark Claimed' }}
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-400">
                                        No recipients found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div x-data x-show="$wire.isModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
        x-on:keydown.escape.window="$wire.closeModal()">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" x-on:click="$wire.closeModal()">
            </div>

            <div
                class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-gray-800 rounded-lg shadow-xl text-gray-200">
                <h3 class="mb-4 text-lg font-medium leading-6 text-white">Create New Badge</h3>
                <form wire:submit="createBadge">
                    {{ $this->form }}
                    <div class="flex justify-end mt-6 space-x-2">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-gray-300 border border-gray-700 rounded-lg hover:bg-gray-700">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-600 hover:bg-primary-500">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($selectedBadge instanceof \App\Models\Badge)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" wire:click="clearSelectedBadge">
                </div>
                

                <div class="relative w-full max-w-lg p-8 bg-gray-800 shadow-2xl rounded-xl text-gray-200">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-white">Assign Badge</h2>
                            <p class="mt-2 text-sm text-gray-400">Select a user to assign the
                                "{{ $selectedBadge->name }}" badge</p>
                        </div>

                        <div class="flex-shrink-0">
                            <img src="{{ Storage::url($selectedBadge->image) }}" alt="{{ $selectedBadge->name }}"
                                class="w-16 h-16 rounded-lg shadow-sm"
                                style="border: 3px solid {{ $selectedBadge->color }}">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live="search"
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-700 border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-200 placeholder-gray-400"
                                placeholder="Search users by name or email...">
                        </div>

                        <select wire:model.live="selectedUser"
                            class="w-full py-2.5 bg-gray-700 border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-200">
                            <option value="">Select a user</option>
                            @foreach ($filteredUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="flex justify-end mt-8 space-x-3">
                        <button wire:click="clearSelectedBadge"
                            class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Cancel
                        </button>
                        <button wire:click="assignBadge" @class([
                            'px-4 py-2 text-sm font-medium rounded-lg transition-colors',
                            'text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500' => $selectedUser,
                            'text-gray-400 bg-gray-700 cursor-not-allowed' => !$selectedUser,
                        ]) :disabled="!$selectedUser">
                            Assign Badge
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>