<x-filament-panels::page>

    <div class="max-w-3xl mx-auto mb-8 text-center">
        <h2 class="mb-4 text-3xl font-bold text-slate-700">
            Welcome to your Course!
        </h2>
        <p class="mb-4 leading-relaxed text-gray-600">
            Your learning journey starts here. Course materials will appear once you've joined a classroom.
            Contact your lecturer or instructor for the <b>class code</b> and enter it on your dashboard.
        </p>
        <div class="flex items-center justify-center gap-2 text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <p class="text-lg font-medium">Ready to begin your learning adventure!</p>
        </div>
    </div>

    <x-filament::tabs>
        <x-filament::tabs.item :active="$activeTab === 'tab1'" wire:click="$set('activeTab', 'tab1')">
            All Classes
        </x-filament::tabs.item>
        <x-filament::tabs.item :active="$activeTab === 'tab2'" wire:click="$set('activeTab', 'tab2')">
            Not Started
        </x-filament::tabs.item>
        <x-filament::tabs.item :active="$activeTab === 'tab3'" wire:click="$set('activeTab', 'tab3')">
            On Going
        </x-filament::tabs.item>
        <x-filament::tabs.item :active="$activeTab === 'tab4'" wire:click="$set('activeTab', 'tab4')">
            Completed
        </x-filament::tabs.item>
    </x-filament::tabs>

    <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @if ($activeTab === 'tab1')
            @foreach ($courses as $course)
                <livewire:class-card status="All" :image="$course->course_photo" :title="$course->course_name" :completed-materials="$course->completed_material_count"
                    :total-materials="$course->total_material_count" :points="100" :total-points="960" :progress="$course->percentage_completed" :route="$course" />
            @endforeach
        @elseif ($activeTab === 'tab2')
            @foreach ($courses->filter(function ($course) {
        return $course->completed_material_count === 0;
    }) as $course)
                <livewire:class-card status="Not Started" :image="$course->course_photo" :title="$course->course_name" :completed-materials="$course->completed_material_count"
                    :total-materials="$course->total_material_count" :points="100" :total-points="960" :progress="$course->percentage_completed" :route="$course" />
            @endforeach
        @elseif ($activeTab === 'tab3')
            @foreach ($courses->filter(function ($course) {
        return $course->completed_material_count >= 1 && $course->completed_material_count < $course->total_material_count;
    }) as $course)
                <livewire:class-card status="On Going" :image="$course->course_photo" :title="$course->course_name" :completed-materials="$course->completed_material_count"
                    :total-materials="$course->total_material_count" :points="100" :total-points="960" :progress="$course->percentage_completed" :route="$course" />
            @endforeach
        @elseif ($activeTab === 'tab4')
            @foreach ($courses->filter(function ($course) {
        return $course->completed_material_count >= 1 && $course->completed_material_count == $course->total_material_count;
    }) as $course)
                <livewire:class-card status="Completed" :image="$course->course_photo" :title="$course->course_name" :completed-materials="$course->completed_material_count"
                    :total-materials="$course->total_material_count" :points="100" :total-points="960" :progress="$course->percentage_completed" :route="$course" />
            @endforeach
        @endif

    </div>
</x-filament-panels::page>
