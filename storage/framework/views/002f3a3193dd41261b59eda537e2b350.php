<div class="space-y-4">
    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <article
            class="overflow-hidden transition-all duration-300 bg-white border shadow-sm rounded-xl hover:shadow-md dark:bg-slate-800 border-slate-100 dark:border-slate-700">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div
                                class="flex items-center justify-center w-10 h-10 text-sm font-medium text-white rounded-full bg-gradient-to-r from-indigo-500 to-blue-500">
                                <?php echo e(strtoupper(substr($item->user->name, 0, 1))); ?>

                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white">
                                <?php echo e($item->user->name); ?>

                            </h4>
                            <div class="flex items-center mt-1 space-x-1">
                                <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < 5; $i++): ?>
                                    <!--[if BLOCK]><![endif]--><?php if($i < $item->rating): ?>
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    <?php else: ?>
                                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>
                    <time datetime="<?php echo e($item->created_at->format('Y-m-d H:i:s')); ?>"
                        class="text-xs text-slate-500 dark:text-slate-400">
                        <?php echo e($item->created_at->format('M d, Y · H:i')); ?>

                    </time>
                </div>
                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <p class="text-slate-600 dark:text-slate-300">
                        <?php echo e($item->comment); ?>

                    </p>
                </div>
            </div>
        </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="p-8 text-center bg-white shadow-sm rounded-xl dark:bg-slate-800">
            <svg class="w-12 h-12 mx-auto text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No comments yet</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Be the first to share your thoughts.</p>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!-- Pagination -->
    <div class="mt-6">
        <?php if (isset($component)) { $__componentOriginal0c287a00f29f01c8f977078ff96faed4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0c287a00f29f01c8f977078ff96faed4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.pagination.index','data' => ['paginator' => $comments]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['paginator' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($comments)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0c287a00f29f01c8f977078ff96faed4)): ?>
<?php $attributes = $__attributesOriginal0c287a00f29f01c8f977078ff96faed4; ?>
<?php unset($__attributesOriginal0c287a00f29f01c8f977078ff96faed4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0c287a00f29f01c8f977078ff96faed4)): ?>
<?php $component = $__componentOriginal0c287a00f29f01c8f977078ff96faed4; ?>
<?php unset($__componentOriginal0c287a00f29f01c8f977078ff96faed4); ?>
<?php endif; ?>
    </div>
</div>
<?php /**PATH D:\Coding\plisBisa\resources\views/livewire/reviews/comment.blade.php ENDPATH**/ ?>