<div>
    <style>
        /* CSS ini harus dipindahkan ke file CSS utama Anda (misalnya filament-custom.css)
           atau setidaknya ditambahkan di bawah @layer components di file CSS Anda.
           Menempatkannya di <style> block dalam Blade view Livewire tidak ideal untuk performance
           dan cache busting Tailwind. */
        .rich-content ul,
        .rich-content ol {
            @apply pl-6 my-2;
        }

        .rich-content li {
            @apply my-1;
        }

        .rich-content ul {
            @apply list-disc;
        }

        .rich-content ol {
            @apply list-decimal;
        }

        /* --- TAMBAHKAN INI UNTUK DARK MODE PADA rich-content --- */
        .dark .rich-content {
            @apply text-gray-300; /* Warna teks umum untuk rich-content di dark mode */
        }

        .dark .rich-content a {
            @apply text-blue-400 hover:text-blue-300; /* Link di rich-content */
        }

        .dark .rich-content h1,
        .dark .rich-content h2,
        .dark .rich-content h3,
        .dark .rich-content h4,
        .dark .rich-content h5,
        .dark .rich-content h6 {
            @apply text-gray-100; /* Heading di rich-content */
        }

        .dark .rich-content strong {
            @apply text-gray-50; /* Bold text di rich-content */
        }

        .dark .rich-content code {
            @apply bg-gray-700 text-gray-100; /* Inline code di rich-content */
        }

        .dark .rich-content pre {
            @apply bg-gray-900 text-gray-100 border border-gray-700; /* Code blocks di rich-content */
        }
        /* --- AKHIR PENAMBAHAN UNTUK DARK MODE PADA rich-content --- */
    </style>

<div id="material-info-section" class="max-w-4xl mx-auto space-y-6">
    <!--[if BLOCK]><![endif]--><?php if($material): ?>
    
    
    <?php if (isset($component)) { $__componentOriginale2f365c7094bff4327525ae36f935879 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2f365c7094bff4327525ae36f935879 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.custom-alert','data' => ['type' => 'info','message' => 'Silahkan baca modul sesuai dengan limit waktu yang diberikan untuk menyelesaikan modul','class' => 'mt-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('custom-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'info','message' => 'Silahkan baca modul sesuai dengan limit waktu yang diberikan untuk menyelesaikan modul','class' => 'mt-4']); ?>
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

        
        <div wire:key="material-<?php echo e($material->id); ?>" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            <div class="aspect-video">
                <!--[if BLOCK]><![endif]--><?php if($material->material_type == 'youtube'): ?>
                    <iframe src="<?php echo e($material->embed_link); ?>" class="w-full h-full rounded-t-2xl" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                <?php elseif($material->material_type == 'pdf'): ?>
                    <!--[if BLOCK]><![endif]--><?php if(!empty($material->pdf_link)): ?>
                        <div class="w-full h-[800px] bg-gray-100 dark:bg-gray-900 rounded-t-2xl flex items-center justify-center"> 
                            <iframe src="<?php echo e(Storage::url($material->pdf_link)); ?>#toolbar=0"
                                class="w-full h-full rounded-t-2xl" frameborder="0">
                            </iframe>
                        </div>
                    <?php else: ?>
                        <div class="p-4 bg-red-100 dark:bg-red-800 dark:text-red-100">PDF file missing - please contact admin</div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            <?php echo e($material->material_name); ?>

                        </h1>
                        <div
                            class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                            <?php echo e(Str::ucfirst($material->material_type)); ?>

                        </div>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($material->duration_in_minutes): ?>
                        <div x-data="{
                            minutes: 0,
                            seconds: 0,
                            intervalId: null,
                            durationInSeconds: 0,
                            isMaterialCompleted: <?php echo json_encode($isMaterialCompleted, 15, 512) ?>,

                            init() {
                                if (this.isMaterialCompleted) {
                                    this.durationInSeconds = 0;
                                    this.updateDisplay();
                                } else {
                                    this.$wire.on('startTimer', (duration) => {
                                        this.startTimer(duration);
                                    });
                                    this.$wire.on('stopTimer', () => {
                                        this.stopTimer();
                                    });

                                    // Initial check if timerDuration is already set on load
                                    if (this.$wire.get('timerDuration') > 0) {
                                        this.startTimer(this.$wire.get('timerDuration'));
                                    }
                                }
                            },

                            startTimer(durationInMinutes) {
                                this.stopTimer(); // Clear any existing timer
                                this.durationInSeconds = durationInMinutes * 60;
                                this.updateDisplay();

                                this.intervalId = setInterval(() => {
                                    if (this.durationInSeconds > 0) {
                                        this.durationInSeconds--;
                                        this.updateDisplay();
                                    } else {
                                        this.stopTimer();
                                        // Optionally emit an event to Livewire when timer finishes
                                        this.$wire.dispatch('timerFinished');
                                    }
                                }, 1000);
                            },

                            stopTimer() {
                                if (this.intervalId) {
                                    clearInterval(this.intervalId);
                                    this.intervalId = null;
                                }
                            },

                            updateDisplay() {
                                this.minutes = Math.floor(this.durationInSeconds / 60);
                                this.seconds = this.durationInSeconds % 60;
                            },

                            formattedTime() {
                                const m = this.minutes < 10 ? '0' + this.minutes : this.minutes;
                                const s = this.seconds < 10 ? '0' + this.seconds : this.seconds;
                                return `${m}:${s}`;
                            }
                        }"
                        x-show="durationInSeconds > 0 || isMaterialCompleted" 
                        class="text-2xl font-bold text-red-500 dark:text-red-400">
                            <span x-text="isMaterialCompleted ? '00:00' : formattedTime()"></span>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div class="mt-6 prose prose-purple max-w-none">
                    
                    <div class="text-gray-700 rich-content dark:text-gray-300"> 
                        <?php echo $material->material_text; ?>

                    </div>
                </div>

                <!--[if BLOCK]><![endif]--><?php if($showNextButton): ?>
                    <div class="mt-6 text-right">
                        <button wire:click="nextMaterial" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-indigo-700 dark:hover:bg-indigo-600 dark:focus:ring-offset-gray-800">
                            Next Material
                            <svg class="w-4 h-4 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        
        <!--[if BLOCK]><![endif]--><?php if($material && $material->is_code): ?>
        
        <?php if (isset($component)) { $__componentOriginale2f365c7094bff4327525ae36f935879 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2f365c7094bff4327525ae36f935879 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.custom-alert','data' => ['type' => 'info','message' => 'Kamu bisa berlatih menggunakan code playground berikut.','class' => 'mt-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('custom-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'info','message' => 'Kamu bisa berlatih menggunakan code playground berikut.','class' => 'mt-4']); ?>
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
            <div class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
                
                <iframe src="<?php echo e($iframeSrc); ?>"
                    class="w-full h-80 md:h-[32rem] xl:h-[40rem] 2xl:h-[48rem]"
                    frameborder="0">
                </iframe>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    
    <?php elseif($assignment): ?> 
        
        <div wire:key="assignment-<?php echo e($assignment->id); ?>" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100"> 
                    <?php echo e($assignment->title); ?>

                </h2>
                <div class="mt-6 prose prose-purple max-w-none rich-content dark:text-gray-300"> 
                    <?php echo $assignment->description; ?>

                </div>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-700"> 
                <div class="p-6">
                    
                    
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('assignment.assignment-form', ['assignmentID' => $assignment->id]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3986408571-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
        </div>

    

    <?php elseif($quiz): ?> 
        <div wire:key="quiz-<?php echo e($quiz->id); ?>" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            <div class="p-6">
                
                <!--[if BLOCK]><![endif]--><?php if($hasPerfectScore): ?>
                    <div class="flex items-center p-6 bg-green-50 rounded-xl dark:bg-green-900/50">
                        <div class="flex-shrink-0">
                            <span class="p-2 bg-green-100 rounded-full dark:bg-green-800">
                                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-s-check-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 text-green-600 dark:text-green-300']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                            </span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-green-800 dark:text-green-200">Skor Sempurna Dicapai!</h3>
                            <p class="mt-1 text-sm text-green-600 dark:text-green-300">
                                Selamat! Anda telah menguasai kuis ini dengan skor sempurna 100%.
                            </p>
                        </div>
                    </div>
                <?php elseif($canAttemptToday): ?>
                    
                    <div class="flex items-center mb-6 space-x-2">
                        <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < $maxLivesPerDay; $i++): ?>
                            <!--[if BLOCK]><![endif]--><?php if($i < $todayLivesRemaining): ?>
                                <span class="text-red-500 transition-all duration-300 transform hover:scale-110 dark:text-red-400">
                                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-s-heart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                                </span>
                            <?php else: ?>
                                <span class="text-gray-300 dark:text-gray-600">
                                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-heart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                                </span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">
                            <?php echo e($todayLivesRemaining); ?> percobaan tersisa hari ini
                        </span>
                    </div>

                     <?php if (isset($component)) { $__componentOriginale2f365c7094bff4327525ae36f935879 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2f365c7094bff4327525ae36f935879 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.custom-alert','data' => ['type' => 'info','message' => 'Syarat untuk lulus kuis ini adalah mendapatkan skor minimal 100%.','class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('custom-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'info','message' => 'Syarat untuk lulus kuis ini adalah mendapatkan skor minimal 100%.','class' => 'mb-4']); ?>
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

                    
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('take-quiz', ['quiz' => $quiz,'canAttemptToday' => $canAttemptToday,'todayLivesRemaining' => $todayLivesRemaining,'maxLivesPerDay' => $maxLivesPerDay]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3986408571-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                <?php else: ?>
                    
                    <div class="p-6 bg-yellow-50 rounded-xl dark:bg-yellow-900/50">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-s-clock'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 text-yellow-600 dark:text-yellow-300']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-yellow-800 dark:text-yellow-200">
                                    Batas Percobaan Harian Tercapai
                                </h3>
                                <p class="mt-1 text-sm text-yellow-600 dark:text-yellow-300">
                                    Harap tinjau materi dan coba lagi besok. Percobaan Anda akan direset pada tengah malam.
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                
                <!--[if BLOCK]><![endif]--><?php if($quizAttempts->isNotEmpty()): ?>
                    <div class="mt-8 space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Riwayat Percobaan</h3>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $quizAttempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 bg-gray-50 rounded-xl dark:bg-gray-700">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="flex items-center justify-center w-8 h-8 text-sm font-medium
                                            <?php echo e($attempt->score == 100 ? 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200'); ?> rounded-full">
                                            #<?php echo e($loop->iteration); ?>

                                        </span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Skor:
                                                <span
                                                    class="<?php echo e($attempt->score == 100 ? 'text-green-600 dark:text-green-300' : ($attempt->score >= 70 ? 'text-blue-600 dark:text-blue-300' : 'text-yellow-600 dark:text-yellow-300')); ?>">
                                                    <?php echo e($attempt->score); ?>%
                                                </span>
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                <?php echo e($attempt->created_at->format('M d, Y H:i')); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php if($attempt->score == 100): ?>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200">
                                            Skor Sempurna
                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    <?php elseif($material): ?> 
        
        
        
        <div wire:key="material-<?php echo e($material->id); ?>" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            
            <div class="aspect-video">
                <!--[if BLOCK]><![endif]--><?php if($material->material_type == 'youtube'): ?>
                    <iframe src="<?php echo e($material->embed_link); ?>" class="w-full h-full rounded-t-2xl" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php elseif($material->material_type == 'pdf'): ?>
                    <!--[if BLOCK]><![endif]--><?php if(!empty($material->pdf_link)): ?>
                        <iframe src="<?php echo e(Storage::url($material->pdf_link)); ?>#toolbar=0" class="w-full h-full rounded-t-2xl" frameborder="0"></iframe>
                    <?php else: ?>
                        <div class="p-4 bg-red-100 dark:bg-red-800 dark:text-red-100">PDF file missing - please contact admin</div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100"><?php echo e($material->material_name); ?></h1>
                <div class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                    <?php echo e(Str::ucfirst($material->material_type)); ?>

                </div>
                <div class="mt-6 prose prose-purple max-w-none">
                    <div class="text-gray-700 rich-content dark:text-gray-300">
                        <?php echo $material->material_text; ?>

                    </div>
                </div>
            </div>
        </div>
    <?php elseif($assignment): ?> 
        
        
        <div wire:key="assignment-<?php echo e($assignment->id); ?>" class="overflow-hidden bg-white shadow-sm rounded-2xl dark:bg-gray-800 dark:shadow-lg dark:border dark:border-gray-700">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100"><?php echo e($assignment->title); ?></h2>
                <div class="mt-6 prose prose-purple max-w-none rich-content dark:text-gray-300">
                    <?php echo $assignment->description; ?>

                </div>
            </div>
            <div class="border-t border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('assignment.assignment-form', ['assignmentID' => $assignment->id]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3986408571-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
        </div>
    <?php else: ?> 
        
        <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/50">
            <div class="flex">
                <div class="flex-shrink-0">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-s-information-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-blue-400 dark:text-blue-300']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700 dark:text-blue-200"><?php echo e($message ?? 'Silahkan pilih materi, kuis, atau tugas dari daftar pelajaran.'); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]--> 

        
        <!--[if BLOCK]><![endif]--><?php if(!empty($message)): ?>
            <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/50"> 
                <div class="flex">
                    <div class="flex-shrink-0">
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-s-information-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-blue-400 dark:text-blue-300']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?> 
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700 dark:text-blue-200"><?php echo e($message); ?></p> 
                    </div>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div><?php /**PATH D:\Coding\plisBisa\resources\views/livewire/courses/material-info.blade.php ENDPATH**/ ?>