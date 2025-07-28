{{-- resources/views/components/custom-alert.blade.php --}}
@props(['type' => 'info', 'message'])

@php
    $bgColor = '';
    $textColor = '';
    $iconComponentName = '';
    $iconColor = '';

    // Dark mode classes
    $darkBgColor = '';
    $darkTextColor = '';
    $darkIconColor = '';

    switch ($type) {
        case 'info':
            $bgColor = 'bg-blue-50';
            $textColor = 'text-blue-700';
            $iconComponentName = 'heroicon-s-information-circle';
            $iconColor = 'text-blue-400';
            $darkBgColor = 'dark:bg-blue-900/50';
            $darkTextColor = 'dark:text-blue-200';
            $darkIconColor = 'dark:text-blue-300';
            break;
        case 'warning':
            $bgColor = 'bg-yellow-50';
            $textColor = 'text-yellow-700';
            $iconComponentName = 'heroicon-s-exclamation-triangle';
            $iconColor = 'text-yellow-400';
            $darkBgColor = 'dark:bg-yellow-900/50';
            $darkTextColor = 'dark:text-yellow-200';
            $darkIconColor = 'dark:text-yellow-300';
            break;
        case 'success':
            $bgColor = 'bg-green-50';
            $textColor = 'text-green-700';
            $iconComponentName = 'heroicon-s-check-circle';
            $iconColor = 'text-green-600';
            $darkBgColor = 'dark:bg-green-900/50';
            $darkTextColor = 'dark:text-green-200';
            $darkIconColor = 'dark:text-green-300';
            break;
        case 'danger':
            $bgColor = 'bg-red-50';
            $textColor = 'text-red-700';
            $iconComponentName = 'heroicon-s-x-circle';
            $iconColor = 'text-red-400';
            $darkBgColor = 'dark:bg-red-900/50';
            $darkTextColor = 'dark:text-red-200';
            $darkIconColor = 'dark:text-red-300';
            break;
        // Tambahkan tipe lain sesuai kebutuhan Anda
    }
@endphp

<div {{ $attributes->merge(['class' => 'p-4 rounded-xl ' . $bgColor . ' ' . $darkBgColor]) }}>
    <div class="flex">
        <div class="flex-shrink-0">
            <x-dynamic-component :component="$iconComponentName" class="w-5 h-5 {{ $iconColor }} {{ $darkIconColor }}" />
        </div>
        <div class="ml-3">
            <p class="text-sm {{ $textColor }} {{ $darkTextColor }}">{{ $message }}</p>
        </div>
    </div>
</div>