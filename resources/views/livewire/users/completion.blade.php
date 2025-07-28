<div>
    {{-- Because she competes with no one, no one can compete with her. --}}



   <div class="space-y-4"> <!-- Menambahkan jarak antar item -->
    @forelse ($coursesInProgress as $item)
        <div class="flex items-center justify-between border-b border-slate-200 py-4">
            <div class="flex-1">
                <p class="text-lg font-semibold text-gray-800">
                    {{ $item->course_name }}
                </p>
                <p class="text-gray-500 text-sm">{{ $coursePoints[$item->id] }} pts</p>
            </div>
            <div class="w-1/2">
                <div class="relative h-3 bg-gray-300 rounded-full">
                    <div class="bg-rose-500 h-3 rounded-full" style="width: {{ $item->completion_progress }}%"></div>
                    <div class="absolute inset-0 flex justify-center items-center text-xs font-semibold text-white">
                        {{ round($item->completion_progress, 1) }}%
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500">No courses in progress.</p>
    @endforelse
</div>

</div>
