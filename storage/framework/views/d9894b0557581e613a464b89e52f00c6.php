<div <?php echo e($attributes); ?> class="w-full h-full ">
    <?php echo e($getChildComponentContainer()); ?>

    <style type="text/css">
        /* Pastikan elemen-elemen ul, ol, dan li memiliki padding dan margin yang benar */
        .rich-content ul,
        .rich-content ol {
            padding-left: 1.5rem;
            /* Adjust as needed */
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .rich-content li {
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
        }

        /* Optionally, you can customize the appearance of the list markers */
        .rich-content ul {
            list-style-type: disc;
            /* or circle, square, etc. */
        }

        .rich-content ol {
            list-style-type: decimal;
            /* or lower-alpha, upper-roman, etc. */
        }
    </style>
    <div class="flex items-center p-6 overflow-hidden bg-white rounded dark:bg-gray-800">
        <img class="object-contain w-48 h-48 rounded" src="<?php echo e(asset('storage/' . $getRecord()->course_photo)); ?>"
            alt="Class Image">
        <div class="flex-grow ml-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white"> <?php echo e($getRecord()->course_name); ?></h2>
            <p class="mt-1 text-gray-600 dark:text-white">Last Progress:</p>
            <div class="flex items-center p-4 mt-2 bg-gray-100 rounded dark:bg-gray-600">
                <?php
                    $totalMaterialsCompleted = $getRecord()->getTotalMaterialsCompletedByUser(Auth::user()->id);
                    $lastCompleted = $getRecord()->getLastCompletedMaterialByUser(Auth::user()->id);
                ?>
                <span
                    class=" text-gray-800 text-sm font-medium px-2 py-0.5 rounded dark:text-white"><?php echo e($lastCompleted); ?></span>
                <span
                    class="ml-3 text-sm text-gray-600 dark:text-white"><?php echo e($totalMaterialsCompleted); ?>/<?php echo e($getRecord()->total_materials); ?>

                    materials</span>
                
            </div>
            <div class="float-right py-4">
                <!--[if BLOCK]><![endif]--><?php if($totalMaterialsCompleted == $getRecord()->total_materials): ?>
                
                    <?php if (isset($component)) { $__componentOriginale2f365c7094bff4327525ae36f935879 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2f365c7094bff4327525ae36f935879 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.custom-alert','data' => ['class' => 'mt-4','type' => 'info','message' => 'Pastikan anda telah mengisi data pendidikan pada Informations !']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('custom-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4','type' => 'info','message' => 'Pastikan anda telah mengisi data pendidikan pada Informations !']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2f365c7094bff4327525ae36f935879)): ?>
<?php $attributes = $__attributesOriginale2f365c7094bff4327525ae36f935879; ?>
<?php unset($__attributesOriginale2f365c7094bff4327525ae36f935879); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2f365c7094bff4327525ae36f935879)): ?>
<?php $component = $__componentOriginale2f365c7094bff4327525ae36f935879; ?>
<?php unset($__componentOriginale2f365c7094bff4327525ae36f935879); ?>
<?php endif; ?>
                    <a href="<?php echo e(route('certificate.download', $getRecord())); ?>"
                    class="px-4 py-2 mt-4 float-right text-sm font-semibold text-white transition duration-300 rounded-lg bg-fuchsia-600 hover:bg-fuchsia-700">
                    <i class="fas fa-file-download"></i> Download Certificate
                </a>
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginale2f365c7094bff4327525ae36f935879 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2f365c7094bff4327525ae36f935879 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.custom-alert','data' => ['type' => 'info','message' => 'Selesaikan modul untuk mendownload certificate','class' => 'mt-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('custom-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'info','message' => 'Selesaikan modul untuk mendownload certificate','class' => 'mt-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2f365c7094bff4327525ae36f935879)): ?>
<?php $attributes = $__attributesOriginale2f365c7094bff4327525ae36f935879; ?>
<?php unset($__attributesOriginale2f365c7094bff4327525ae36f935879); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2f365c7094bff4327525ae36f935879)): ?>
<?php $component = $__componentOriginale2f365c7094bff4327525ae36f935879; ?>
<?php unset($__componentOriginale2f365c7094bff4327525ae36f935879); ?>
<?php endif; ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

    </div>
    <div class="items-center max-w-full p-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800">
        <h2 class="text-xl font-semibold text-fuchsia-500">About this Course</h2>
        <hr class="my-4 border-t-2 border-gray-300" />
        <article class="text-gray-700 rich-content dark:text-white"><?php echo $getRecord()->course_description; ?></article>
    </div>

</div>
<?php /**PATH D:\Coding\plisBisa\resources\views/infolists/components/detail-test.blade.php ENDPATH**/ ?>