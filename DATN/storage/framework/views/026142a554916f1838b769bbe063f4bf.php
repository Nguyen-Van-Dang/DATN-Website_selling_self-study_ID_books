<!DOCTYPE html>
<html lang="en">

<head>


    <title><?php echo $__env->yieldContent('title', 'TRANG CHỦ ADMIN'); ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/images/book/icon/favicon.png')); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/typography.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/blur-effect.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>

<body>
    <div class="wrapper">
        <div class="iq-sidebar">
            <?php if (isset($component)) { $__componentOriginale842643f388f3f2a729c3cad188d3504 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale842643f388f3f2a729c3cad188d3504 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Sidebar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale842643f388f3f2a729c3cad188d3504)): ?>
<?php $attributes = $__attributesOriginale842643f388f3f2a729c3cad188d3504; ?>
<?php unset($__attributesOriginale842643f388f3f2a729c3cad188d3504); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale842643f388f3f2a729c3cad188d3504)): ?>
<?php $component = $__componentOriginale842643f388f3f2a729c3cad188d3504; ?>
<?php unset($__componentOriginale842643f388f3f2a729c3cad188d3504); ?>
<?php endif; ?>
        </div>
        <div class="iq-top-navbar" style="z-index: 2;">
            <?php if (isset($component)) { $__componentOriginal45d9cbba1e84739af2366cafaf311004 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45d9cbba1e84739af2366cafaf311004 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal45d9cbba1e84739af2366cafaf311004)): ?>
<?php $attributes = $__attributesOriginal45d9cbba1e84739af2366cafaf311004; ?>
<?php unset($__attributesOriginal45d9cbba1e84739af2366cafaf311004); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45d9cbba1e84739af2366cafaf311004)): ?>
<?php $component = $__componentOriginal45d9cbba1e84739af2366cafaf311004; ?>
<?php unset($__componentOriginal45d9cbba1e84739af2366cafaf311004); ?>
<?php endif; ?>
        </div>
        <div id="content-page" class="content-page">
            <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

            <?php echo $__env->yieldContent('content'); ?>
            <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

        </div>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.appear.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/countdown.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/apexcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/smooth-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/lottie.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/core.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/charts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/animated.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/kelly.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/maps.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/worldLow.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/raphael-min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/morris.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/morris.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/flatpickr.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/style-customizer.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/blur-effect.js')); ?>"></script>
</body>

</html>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/layouts/admin/admin.blade.php ENDPATH**/ ?>