<div
    class="relative flex flex-col h-full max-w-xs overflow-hidden transition-all duration-300 ease-out transform bg-white shadow-xl group rounded-xl dark:bg-gray-800/95 hover:shadow-2xl hover:-translate-y-2">
    <a href="{{ route('filament.student.resources.course-details.view', ['record' => $route]) }}"
        class="absolute inset-0 z-10" wire:navigate aria-label="{{ $title }}"></a>
    <div class="relative flex-grow p-5 pointer-events-none">
        {{-- Status Badge --}}
        <span
            class="absolute top-3 left-3 z-20 bg-fuchsia-600/90 backdrop-blur-sm text-white text-xs font-medium px-3 py-1.5 rounded-full shadow-lg">
            {{ $status }}
        </span>

        {{-- Image Container with Overlay --}}
        <div class="relative w-full h-40 mb-4 overflow-hidden rounded-lg">
            <img class="object-cover w-full h-full transition-transform duration-500 transform group-hover:scale-110"
                src="{{ asset('storage/' . $image) }}" alt="{{ $title }}">
            <div
                class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/30 to-transparent group-hover:opacity-100">
            </div>
        </div>

        {{-- Content Section --}}
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white min-h-[55px] leading-tight">
                {{ $title }}
            </h2>

            {{-- Progress Info --}}
            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-300">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-fuchsia-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 5h18M9 3v2m6-2v2m-6 16v-6h6v6m-2-8h4m-10 0H5" />
                    </svg>
                    <span>{{ $completedMaterials }}/{{ $totalMaterials }} Materi</span>
                </div>
            </div>

            {{-- Progress Bar --}}
            <div class="relative w-full h-3 overflow-hidden bg-gray-200 rounded-full dark:bg-gray-700">
                <div class="absolute h-full transition-all duration-500 ease-out bg-gradient-to-r from-fuchsia-500 to-fuchsia-600"
                    style="width: {{ $progress }}%">
                </div>
                <div
                    class="absolute inset-0 flex items-center justify-center text-xs font-medium text-white mix-blend-difference">
                    {{ round($progress, 1) }}%
                </div>
            </div>
        </div>
    </div>
</div>
