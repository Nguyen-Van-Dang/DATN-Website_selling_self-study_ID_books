<div class="iq-navbar-custom">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <div class="navbar-breadcrumb">
            <h5 class="mb-0">Dashboard</h5>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list">
                <li class="nav-item nav-icon search-content">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-search-line"></i>
                    </a>
                    <form action="#" class="search-box p-0">
                        <input type="text" class="text search-input" placeholder="Type here to search...">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                    </form>
                </li>
                <?php
                    $courseNotifications = \App\Models\Course::where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();

                    $bookNotifications = \App\Models\Book::where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                    $notifications = $courseNotifications->merge($bookNotifications)->sortByDesc('created_at')->take(5);
                    $hasNotifications = $notifications->isNotEmpty();
                ?>

                <li class="nav-item nav-icon">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-notification-2-line"></i>
                        <?php if($hasNotifications): ?>
                            <span class="bg-primary dots"></span>
                        <?php endif; ?>
                    </a>
                    <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">Thông Báo
                                        <small
                                            class="badge badge-light float-right pt-1"><?php echo e($notifications->count()); ?></small>
                                    </h5>
                                </div>
                                <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <?php
                                                    $avatar = auth()
                                                        ->user()
                                                        ->images()
                                                        ->where('image_name', 'thumbnail')
                                                        ->first();
                                                ?>
                                                <img class="avatar-40 rounded"
                                                    src="<?php echo e($avatar ? $avatar->image_url : asset('assets/images/book/user/avatar.jpg')); ?>">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">
                                                    <?php echo e(isset($notification->title) ? $notification->title : $notification->name); ?>

                                                </h6>
                                                <small
                                                    class="float-right font-size-12"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                                                <p class="mb-0">
                                                    <?php echo e(isset($notification->price) ? number_format($notification->price, 0, ',', '.') . 'đ' : ''); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Không có sản phẩm nào cần duyệt</h6>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                 <!-- Hiển thị liên kết "Xem thêm" nếu có nhiều hơn 5 sản phẩm -->
                                 <?php if($notification->count() > 5): ?>
                                 <div class="text-center">
                                     <a href="<?php echo e(route('listNotificationUser')); ?>" class="btn btn-link">Xem thêm</a>
                                 </div>
                             <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
                    $unrepliedMessages = \App\Models\Contact::where('is_replied', 0)
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                ?>

                <li class="nav-item nav-icon dropdown">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-mail-line"></i>
                        <?php if($unrepliedMessages->count() > 0): ?>
                            <span class="bg-primary dots"></span>
                        <?php endif; ?>
                    </a>
                    <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">Tin Nhắn
                                        <small
                                            class="badge badge-light float-right pt-1"><?php echo e($unrepliedMessages->count()); ?></small>
                                    </h5>
                                </div>
                                <?php $__empty_1 = true; $__currentLoopData = $unrepliedMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <?php
                                                    $avatar = auth()
                                                        ->user()
                                                        ->images()
                                                        ->where('image_name', 'thumbnail')
                                                        ->first();
                                                ?>
                                                <img class="avatar-40 rounded"
                                                    src="<?php echo e($avatar ? $avatar->image_url : asset('assets/images/book/user/avatar.jpg')); ?>">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0"><?php echo e($message->name); ?></h6>
                                                <small
                                                    class="float-right font-size-12"><?php echo e($message->created_at->diffForHumans()); ?></small>
                                            </div>
                                        </div>
                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Không có liên hệ nào cần duyệt</h6>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Hiển thị liên kết "Xem thêm" nếu có nhiều hơn 5 tin nhắn -->
                                <?php if($unrepliedMessages->count() > 5): ?>
                                    <div class="text-center">
                                        <a href="<?php echo e(route('listContact')); ?>" class="btn btn-link">Xem thêm</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="line-height pt-3">
                    <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <?php
                            $avatar = auth()->user()->images()->where('image_name', 'thumbnail')->first();
                        ?>
                        <img class="img-fluid rounded-circle mr-3"
                            src="<?php echo e($avatar ? $avatar->image_url : asset('assets/images/book/user/avatar.jpg')); ?>">
                        <?php
                            $userName = Auth::user()->name;
                            $displayName = Str::limit($userName, 10, '...');
                        ?>
                        <h6 class="mb-1 line-height"><?php echo e($displayName); ?>!</h6>
                    </a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <?php
                                        $userName = Auth::user()->name;
                                        $displayName1 = Str::limit($userName, 25, '...');
                                    ?>
                                    <h5 class="mb-0 text-white line-height">Xin Chào <br>
                                        <?php echo e($displayName1); ?></h5>
                                </div>
                                <?php if(Auth::check() && Auth::user()->role_id == 1): ?>
                                    <a href="<?php echo e(route('userInfo')); ?>" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Tài khoản của tôi</h6>
                                            </div>
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('userInformation')); ?>" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Tài khoản của tôi</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-account-box-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Đơn hàng của tôi</h6>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="<?php echo e(route('logout')); ?>"
                                        role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- color-customizer -->
<div class="iq-colorbox color-fix">
    <div class="buy-button"> <a class="color-full" href="#" style="z-index: 1;"><i
                class="fa fa-spinner fa-spin"></i></a> </div>
    <div class="clearfix color-picker text-center">
        <h3 class="iq-font-black">Màu sắc tuyệt vời</h3>
        <p>Combo màu này có sẵn bên trong toàn bộ mẫu. Bạn có thể thay đổi theo mong muốn của mình, Thậm chí bạn có thể
            tự tạo ra khả năng vô hạn!</p>
        <ul class="iq-colorselect clearfix">
            <li class="color-1 iq-colormark" data-style="color-1"></li>
            <li class="color-2" data-style="iq-color-2"></li>
            <li class="color-3" data-style="iq-color-3"></li>
            <li class="color-4" data-style="iq-color-4"></li>
            <li class="color-5" data-style="iq-color-5"></li>
            <li class="color-6" data-style="iq-color-6"></li>
            <li class="color-7" data-style="iq-color-7"></li>
            <li class="color-8" data-style="iq-color-8"></li>
            <li class="color-9" data-style="iq-color-9"></li>
            <li class="color-10" data-style="iq-color-10"></li>
            <li class="color-11" data-style="iq-color-11"></li>
            <li class="color-12" data-style="iq-color-12"></li>
            <li class="color-13" data-style="iq-color-13"></li>
            <li class="color-14" data-style="iq-color-14"></li>
            <li class="color-15" data-style="iq-color-15"></li>
            <li class="color-16" data-style="iq-color-16"></li>
            <li class="color-17" data-style="iq-color-17"></li>
            <li class="color-18" data-style="iq-color-18"></li>
            <li class="color-19" data-style="iq-color-19"></li>
            <li class="color-20" data-style="iq-color-20"></li>
        </ul>
        <a class="btn btn-primary d-block mt-3" href="">Mua Ngay</a>
    </div>
</div>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/components/admin/header.blade.php ENDPATH**/ ?>