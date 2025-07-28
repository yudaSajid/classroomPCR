<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
    @foreach ($shortcuts as $shortcut)
        <a href="{{ $shortcut['url'] }}" class="
            flex flex-col items-center justify-center p-6 rounded-lg shadow-md transition-all duration-200
            hover:shadow-lg hover:scale-105
            bg-white dark:bg-gray-800
            text-{{ strtolower($shortcut['color']) }}-600 dark:text-{{ strtolower($shortcut['color']) }}-400
            border border-gray-200 dark:border-gray-700
        ">
            <x-filament::icon
                :name="$shortcut['icon']"
                class="h-12 w-12 mb-3"
            />
            <span class="text-lg font-semibold text-gray-900 dark:text-white text-center">{{ $shortcut['label'] }}</span>
        </a>
    @endforeach
</div>
