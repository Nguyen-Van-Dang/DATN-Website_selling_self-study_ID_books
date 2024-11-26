<?php $__env->startSection('title', 'Thêm khóa học'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.course.course-add', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2462552772-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/admin/course/addCourse.blade.php ENDPATH**/ ?>