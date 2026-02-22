<div class="flex flex-col lg:flex-row gap-4 p-4">

    <div class="w-full lg:w-[320px] xl:w-[360px] p-2 overflow-auto rounded-lg
                bg-slate-100 dark:bg-gray-800 shadow-md dark:shadow-lg
                lg:max-h-[calc(100vh-100px)] xl:max-h-full xl:overflow-visible">
        <h1 class="p-2 mb-2 text-xl font-bold text-center
                   text-slate-700 dark:text-gray-200">Lesson List</h1>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('courses.material-selection',['courseID' => $courseID]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2896229372-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>

    <div class="flex-1 rounded-lg">
        <div class="mx-auto max-w-full 2xl:max-w-7xl">
             <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('courses.material-info');

$__html = app('livewire')->mount($__name, $__params, 'lw-2896229372-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </div>
</div><?php /**PATH D:\Coding\plisBisa\resources\views/livewire/courses/learn-layout.blade.php ENDPATH**/ ?>