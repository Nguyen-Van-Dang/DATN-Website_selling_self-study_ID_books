<div class="iq-sidebar-logo d-flex justify-content-between">
    <a href="<?php echo e(route('homeClient')); ?>" class="header-logo">
        <img id="main-logo" src="<?php echo e(asset('assets/images/book/icon/big_logo.png')); ?>" class="img-fluid rounded-normal"
            alt="">
    </a>
    <div class="iq-menu-bt align-self-center">
        <div class="wrapper-menu">
            <i class="bi bi-list"></i>
        </div>
    </div>
</div>
<div id="sidebar-scrollbar">
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('component.rendersidebar');

$__html = app('livewire')->mount($__name, $__params, 'lw-3174794058-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>;
</div>
<style>
    .iq-menu-bt {
        display: none;
    }

    @media (max-width: 768px) {
        .iq-menu-bt {
            display: block;
        }
    }

    .custom-hide {
        display: none;
    }

    @media (max-width: 1023px) {
        .custom-hide {
            display: block;
        }
    }

    .iq-sidebar.collapsed {
        width: 80px;
    }

    .CourseImage {
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        text-align: center;
        background-color: rgb(127, 130, 227);
        color: white;
        font-size: 20px;
        text-decoration: none;
        object-fit: cover;
    }
</style>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/components/client/sidebar.blade.php ENDPATH**/ ?>