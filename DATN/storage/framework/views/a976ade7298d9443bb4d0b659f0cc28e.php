<?php $__env->startSection('title', 'Danh mục Sách'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
       
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('bookCate.render-bookCate', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-4215155954-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
      
    </div>
 </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/admin/categoryBook/listCategoryBook.blade.php ENDPATH**/ ?>