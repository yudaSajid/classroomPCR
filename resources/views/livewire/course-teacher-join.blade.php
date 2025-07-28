<div class="space-y-4 bg-gray-50 dark:bg-gray-900 p-6 rounded-lg"> {{-- Added overall padding and background for context --}}
    @if (!$isTeaching)
        <button wire:click="joinAsCourseTeacher" wire:loading.attr="disabled" type="button"
            class="group relative inline-flex items-center text-white justify-center gap-2 px-4 py-2.5 text-sm font-medium bg-rose-600 border border-transparent rounded-lg shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition-all duration-200 ease-in-out disabled:opacity-70 disabled:cursor-not-allowed overflow-hidden">
            <span wire:loading.remove class="flex items-center gap-2">
                <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-12" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Join as Teacher
            </span>
            <span wire:loading class="flex items-center gap-2">
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Joining...
            </span>
            <div
                class="absolute inset-0 transition-opacity duration-200 opacity-0 bg-gradient-to-r from-rose-500 to-rose-600 group-hover:opacity-10">
            </div>
        </button>
    @else
        <div
            class="flex items-center gap-2 px-4 py-3 text-sm font-medium border rounded-lg text-rose-700 bg-rose-50 border-rose-100
            dark:text-rose-300 dark:bg-rose-900 dark:border-rose-800"> {{-- Dark mode adjustments for teaching status message --}}
            <svg class="w-5 h-5 text-rose-500 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"> {{-- Dark mode icon color --}}
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-slate-700 dark:text-gray-200">You are currently teaching this course</span> {{-- Dark mode text color --}}
        </div>
    @endif
</div>