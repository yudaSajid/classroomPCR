
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'info', 'message']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type' => 'info', 'message']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
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
?>

<div <?php echo e($attributes->merge(['class' => 'p-4 rounded-xl ' . $bgColor . ' ' . $darkBgColor])); ?>>
    <div class="flex">
        <div class="flex-shrink-0">
            <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $iconComponentName] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 '.e($iconColor).' '.e($darkIconColor).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
        </div>
        <div class="ml-3">
            <p class="text-sm <?php echo e($textColor); ?> <?php echo e($darkTextColor); ?>"><?php echo e($message); ?></p>
        </div>
    </div>
</div><?php /**PATH D:\Coding\plisBisa\resources\views/components/custom-alert.blade.php ENDPATH**/ ?>