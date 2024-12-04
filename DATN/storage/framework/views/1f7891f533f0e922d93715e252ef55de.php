<div>
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0 ">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="las la-bars"></i></div>
                </div>
                <div class="iq-navbar-logo d-flex justify-content-between">
                    <a href="<?php echo e(route('homeClient')); ?>" class="header-logo">
                        <div class="logo-title">
                            <span class="text-primary text-uppercase">
                                <img src="<?php echo e(asset('assets/images/book/icon/big_logo.png')); ?>" alt="">
                            </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="d-flex nav-menu">
                <div class="navbar-breadcrumb px-3 <?php echo e(Request::is('/') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('homeClient')); ?>" class="iq-waves-effect text-gray rounded">
                        <h6 class="mb-0">Trang Chủ</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 <?php echo e(Request::is('book-list') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('bookList')); ?>" class="iq-waves-effect rounded">
                        <h6 class="mb-0">Sách</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 <?php echo e(Request::is('khoa-hoc*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('khoa-hoc.index')); ?>" class="iq-waves-effect rounded">
                        <h6 class="mb-0">Khóa học</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 <?php echo e(Request::is('hoc-tap') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('hoc-tap')); ?>" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Học tập</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 <?php echo e(Request::is('chat*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('chat')); ?>" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Tin nhắn</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 <?php echo e(Request::is('reels') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('reals')); ?>" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Reels</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 <?php echo e(Request::is('de-thi*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('de-thi.index')); ?>" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Đề thi</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 <?php echo e(Request::is('addContact*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('addContact')); ?>" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Liên hệ</h6>
                    </a>
                </div>
            </div>
            <div class="nav-button" style="margin-left: auto">
                <a href="<?php echo e(route('kich-hoat-sach')); ?>" class="btn btn-primary float-end"> <b>Kích hoạt ID Sách
                        !</b></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    
                    
                    
                    
                    
                    
                    <li class="nav-item nav-icon dropdown">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-shopping-cart-2-line"></i>
                            <span class="badge badge-danger count-cart rounded-circle">
                                <?php echo e(auth()->check() ? $cartCount : 0); ?>

                            </span>
                        </a>
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 toggle-cart-info">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">
                                            Giỏ Hàng
                                            <small
                                                class="badge badge-light float-right pt-1"><?php echo e(auth()->check() ? $cartCount : 0); ?></small>
                                        </h5>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php if(auth()->check() && $cartCount > 0): ?>
                                        <div class="custom-scrollbar">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row">
                                                    <div class="col-10">
                                                        <a class="iq-sub-card">
                                                            <div class="media align-items-center">
                                                                <div><?php
                                                                    $thumbnail = $item->book
                                                                        ->images()
                                                                        ->where('image_name', 'thumbnail')
                                                                        ->first();
                                                                ?>
                                                                    <img class="rounded"
                                                                        src="<?php echo e($thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/02.jpg')); ?>">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0">Tên: <?php echo e($item->book->name); ?>

                                                                    </h6>
                                                                    <p class="mb-0">Giá:
                                                                        <?php echo e($item->book->price * $item->quantity); ?> đ
                                                                    </p>
                                                                    <p class="mb-0">Số Lượng: <?php echo e($item->quantity); ?>

                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                                        <a style="padding-right: 20px">
                                                            <div class="font-size-24 text-danger"
                                                                style="cursor: pointer;">
                                                                <i class="ri-close-fill"
                                                                    wire:click="removeFromCart(<?php echo e($item->id); ?>)"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        <?php else: ?>
                                            <p class="text-center p-3">Giỏ hàng trống</p>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="align-items-center text-center p-3">
                                    <a class="btn btn-primary iq-sign-btn" href="<?php echo e(route('shoppingCart')); ?>"
                                        role="button">Giỏ Hàng</a>
                                    <a class="btn btn-primary iq-sign-btn" href="<?php echo e(route('shoppingCart')); ?>"
                                        role="button">Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <?php if(auth()->check() && in_array(Auth::user()->role_id, [1, 2])): ?>
                        <li class="nav-item nav-icon dropdown">
                            <a href="<?php echo e(route('tai-video.index')); ?>" class="text-gray rounded">
                                <i class="ri-upload-cloud-line"></i>
                            </a>
                        </li>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    
                    <?php if(auth()->check()): ?>
                        <li class="line-height pt-3">
                            <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                <?php
                                    $avatar = auth()->user()->images()->where('image_name', 'thumbnail')->first();
                                ?>
                                <img class="img-fluid rounded-circle mr-3"
                                    src="<?php echo e($avatar ? $avatar->image_url : asset('assets/images/book/user/1.jpg')); ?>">

                                <div class="caption"
                                    <?php
$userName = Auth::user()->name;
                                        $displayName = Str::limit($userName, 10, '...'); ?>>
                                    <h6 class="mb-1 line-height"><?php echo e($displayName); ?>!</h6>
                                    <p class="mb-0 text-primary">Tài Khoản</p>
                                </div>
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white line-height">Xin Chào
                                                <?php echo e(auth()->user()->name); ?>

                                            </h5>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if(Auth::user()->role_id == 1): ?>
                                            <a href="<?php echo e(route('userInformation')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-file-user-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Sửa thông tin</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="<?php echo e(route('homeAdmin')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-shield-user-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Vào trang quản trị</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php elseif(Auth::user()->role_id == 2): ?>
                                            <a href="<?php echo e(route('userDetail')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-file-user-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Tài khoản của tôi</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="<?php echo e(route('userInformation')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-profile-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Sửa thông tin</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="<?php echo e(route('homeAdmin')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-shield-user-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Vào trang quản trị</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php else: ?>
                                            
                                            <a href="<?php echo e(route('userInformation')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-profile-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Sửa thông tin</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="<?php echo e(route('kich-hoat-sach')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-key-2-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Kích hoạt sách ID</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="<?php echo e(route('orderList')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-account-box-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Đơn hàng của tôi</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="<?php echo e(route('getAllBookFavorite')); ?>"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-heart-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Yêu Thích</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <div class="d-inline-block w-100 text-center p-3">
                                            <a class="bg-primary iq-sign-btn" href="<?php echo e(route('logout')); ?>"
                                                role="button">
                                                Sign out<i class="ri-login-box-line ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="line-height pt-2">
                            <button id="open-popup-btn" class="btnn">Đăng Nhập</button>
                            <div class="popup-overlay"></div>
                            <div id="popup" class="popup" style="margin-top:10%">
                                <div class="popup-content">
                                    <a id="close-popup-btn" class="close-btn">x</a>
                                    <div class="container">
                                        <div class="forms-container">
                                            <div class="signin-signup">
                                                
                                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('client.user.login-user', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2095043844-0', $__slots ?? [], get_defined_vars());

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
[$__name, $__params] = $__split('client.user.register-user', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2095043844-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                            </div>
                                        </div>
                                        <div class="panels-container">
                                            <div class="panel left-panel">
                                                <div class="content">
                                                    <h3>Bạn chưa có tài khoản ?</h3>
                                                    <p>
                                                        Tạo tài khoản ngay để trải nghiệm tất cả các tính năng tuyệt vời
                                                        của
                                                        chúng tôi.
                                                        Đăng ký miễn phí, dễ dàng nhanh chóng chỉ trong vài bước!
                                                    </p>
                                                    <button class="btn transparent" id="sign-up-btn">
                                                        Đăng ký
                                                    </button>
                                                </div>
                                                <img src="<?php echo e(asset('assets/images/log.svg')); ?>" class="image"
                                                    alt="" />
                                            </div>
                                            <div class="panel right-panel">
                                                <div class="content">
                                                    <h3>Bạn đã có tài khoản ?</h3>
                                                    <p>
                                                        Đăng nhập ngay để tiếp tục khám phá, sử dụng các dịch vụ tuyệt
                                                        vời
                                                        mà chúng tôi cung cấp.
                                                        Chúng tôi rất vui được chào đón bạn quay lại!
                                                    </p>
                                                    <button class="btn transparent" id="sign-in-btn">
                                                        Đăng nhập
                                                    </button>
                                                </div>
                                                <img src="<?php echo e(asset('assets/images/register.svg')); ?>" class="image"
                                                    alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </ul>
            </div>
        </nav>
    </div>
    <style>
        a {
            text-decoration: none
        }

        #sign-up-btn:hover {
            border-radius: 20px;
            transition: 1s;
            background: white;
        }

        #sign-in-btn:hover {
            border-radius: 20px;
            transition: 1s;
            background: white;
        }

        .navbar-breadcrumb a h6 {
            color: var(--iq-body-text);
        }

        .navbar-breadcrumb a h6:hover {
            color: var(--iq-primary);
            transition: 1s;
            text-decoration: none;
        }

        .iq-top-navbar .iq-navbar-custom .active h6 {
            color: #49f0d3;
            font-weight: bold
        }

        .nav-button .btn {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: scale(1);
            }

            40% {
                transform: scale(1.05);
            }

            60% {
                transform: scale(1.03);
            }
        }

        .nav-button .btn {
            animation: bounce 2s infinite;
            transition: box-shadow 0.3s ease;
        }

        .nav-button .btn:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .custom-scrollbar {
            overflow-x: hidden;
            overflow-y: auto;
            max-height: 350px;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #20c997;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #108562;
        }
    </style>
</div>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/livewire/component/render-header.blade.php ENDPATH**/ ?>