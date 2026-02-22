<div>
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
    <h2 class="px-6 py-2 text-2xl font-semibold text-gray-800 dark:text-white">Review Details</h2>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reviews.avg-rate', ['courseID' => $courseID,'lazy' => true]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1972453846-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reviews.polling', ['starCount' => 5,'star_count' => 5,'courseID' => $courseID,'lazy' => true]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1972453846-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reviews.polling', ['starCount' => 4,'star_count' => 4,'courseID' => $courseID,'lazy' => true]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1972453846-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reviews.polling', ['starCount' => 3,'star_count' => 3,'courseID' => $courseID,'lazy' => true]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1972453846-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reviews.polling', ['starCount' => 2,'star_count' => 2,'courseID' => $courseID,'lazy' => true]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1972453846-4', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reviews.polling', ['starCount' => 1,'star_count' => 1,'courseID' => $courseID,'lazy' => true]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1972453846-5', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reviews.comment-form', ['courseID' => $courseID]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1972453846-6', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

    <div class="mt-4">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reviews.comment', ['courseID' => $courseID]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1972453846-7', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
</div>
<?php /**PATH D:\Coding\plisBisa\resources\views/livewire/courses/review.blade.php ENDPATH**/ ?>