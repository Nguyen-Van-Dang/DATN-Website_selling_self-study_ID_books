<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $__env->yieldContent('title', 'TRANG CHỦ'); ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/images/book/icon/favicon.png')); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="zalo-platform-site-verification" content="RDkY3gkeAL1KtF9nd_zrHtx2uXkIj392E3Kn" />

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo e(asset('vendor/flasher/css/flasher.css')); ?>">
    <script src="<?php echo e(asset('vendor/flasher/js/flasher.js')); ?>"></script>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/typography.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/toast.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/login.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/reals.css')); ?>">
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <style>
        body {
            margin-top: 20px;
            background-color: #f0f2f5;
        }

        .dropdown-list-image {
            position: relative;
            height: 2.5rem;
            width: 2.5rem;
        }

        .dropdown-list-image img {
            height: 2.5rem;
            width: 2.5rem;
        }

        .btn-light {
            color: #2cdd9b;
            background-color: #e5f7f0;
            border-color: #d8f7eb;
        }

        .overflow-scroll {
            overflow: scroll;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <div class="iq-sidebar">
            <?php if (isset($component)) { $__componentOriginal5a61ac90d11808e4b4c17319c3805602 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a61ac90d11808e4b4c17319c3805602 = $attributes; } ?>
<?php $component = App\View\Components\Client\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('client.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Client\Sidebar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a61ac90d11808e4b4c17319c3805602)): ?>
<?php $attributes = $__attributesOriginal5a61ac90d11808e4b4c17319c3805602; ?>
<?php unset($__attributesOriginal5a61ac90d11808e4b4c17319c3805602); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a61ac90d11808e4b4c17319c3805602)): ?>
<?php $component = $__componentOriginal5a61ac90d11808e4b4c17319c3805602; ?>
<?php unset($__componentOriginal5a61ac90d11808e4b4c17319c3805602); ?>
<?php endif; ?>
        </div>
        <div class="iq-top-navbar">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('component.render-header', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3570623300-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <div id="content-page" class="content-page content-page-client mb-5">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <footer class="iq-footer">
        <?php if (isset($component)) { $__componentOriginal3b4558293c8dc3f33d2069df2429bfc7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b4558293c8dc3f33d2069df2429bfc7 = $attributes; } ?>
<?php $component = App\View\Components\Client\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('client.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Client\Footer::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b4558293c8dc3f33d2069df2429bfc7)): ?>
<?php $attributes = $__attributesOriginal3b4558293c8dc3f33d2069df2429bfc7; ?>
<?php unset($__attributesOriginal3b4558293c8dc3f33d2069df2429bfc7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b4558293c8dc3f33d2069df2429bfc7)): ?>
<?php $component = $__componentOriginal3b4558293c8dc3f33d2069df2429bfc7; ?>
<?php unset($__componentOriginal3b4558293c8dc3f33d2069df2429bfc7); ?>
<?php endif; ?>
    </footer>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    
    <script src="<?php echo e(asset('assets/js/key.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/popup.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/image.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/reals.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/login.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/toast.js')); ?>" defer></script>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
</body>

</html>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/layouts/client/client.blade.php ENDPATH**/ ?>