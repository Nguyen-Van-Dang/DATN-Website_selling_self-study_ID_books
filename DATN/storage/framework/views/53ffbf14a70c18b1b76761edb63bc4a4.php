<?php $__env->startSection('title', 'Thông Tin Tài khoản'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if(session('message')): ?>
        <div class="alert alert-success">
            <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-body p-0">
                    <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                            <?php if(Auth::check() && Auth::user()->role_id == 1): ?>
                                <li class="col-md-4 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>

                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#reset-pwd">
                                        Quên mật khẩu
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information1">
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang1-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#reset1-pwd">
                                        Quên mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                        Lịch sử đơn hàng
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <?php if(Auth::check() && Auth::user()->role_id == 1): ?>
                        
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('client.user.profile-user', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1386138315-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        </div>
                        
                        <div class="tab-pane fade  show" id="chang-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Đổi mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">

                                    <form action="<?php echo e(route('userInfo')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="cpass">Mật khẩu hiện tại:</label>
                                            
                                            <input type="password" class="form-control" id="cpass" name="password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass" name="new_password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="vpass">Xác nhận lại mật khẩu:</label>
                                            <input type="password" class="form-control" id="vpass"
                                                name="new_password_confirmation" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Reset mật khẩu -->
                        <div class="tab-pane fade" id="reset-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Quên mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <!-- Form gửi mã OTP -->
                                    <form action="<?php echo e(route('send-otp')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Nhập email của bạn" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi mã OTP</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>

                                    <form action="<?php echo e(route('verify-otp')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="email" value="<?php echo e(isset($email) ? $email : ''); ?>">
                                        <div class="form-group">
                                            <label for="otp">Mã xác thực 6 số:</label>
                                            <input type="text" class="form-control" id="otp" name="otp"
                                                maxlength="6" placeholder="Nhập mã xác thực" required>
                                        </div>
                                    </form>

                                    
                                    <form method="POST" action="<?php echo e(route('change-password')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password_confirmation">Nhập lại mật khẩu mới</label>
                                            <input type="password" name="new_password_confirmation"
                                                id="new_password_confirmation" class="form-control" required>
                                        </div>

                                        <input type="hidden" name="email" value="<?php echo e(session('email')); ?>">

                                        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                                    </form>

                                    <!-- Form thay đổi mật khẩu -->
                                    <form action="<?php echo e(route('change-password')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password" placeholder="Nhập mật khẩu mới" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password_confirmation">Xác nhận mật khẩu:</label>
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Đổi mật khẩu</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Lịch Sử Đơn Hàng</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">

                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        
                        <div class="tab-pane fade active show" id="personal-information1" role="tabpanel">
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('client.user.profile-user', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1386138315-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        </div>
                        
                        <div class="tab-pane fade show" id="chang1-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Đổi mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">

                                    <form action="<?php echo e(route('userInfo')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="cpass">Mật khẩu hiện tại:</label>
                                            
                                            <input type="password" class="form-control" id="cpass" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass"
                                                name="new_password">
                                        </div>
                                        <div class="form-group">
                                            <label for="vpass">Xác nhận lại mật khẩu:</label>
                                            <input type="password" class="form-control" id="vpass"
                                                name="new_password_confirmation">
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Reset mật khẩu -->
                        <div class="tab-pane fade" id="reset1-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Quên mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <!-- Form gửi mã OTP -->
                                    <form action="<?php echo e(route('send-otp')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Nhập email của bạn" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi mã OTP</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>

                                    <form action="<?php echo e(route('verify-otp')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="email" value="<?php echo e(isset($email) ? $email : ''); ?>">
                                        <div class="form-group">
                                            <label for="otp">Mã xác thực 6 số:</label>
                                            <input type="text" class="form-control" id="otp" name="otp"
                                                maxlength="6" placeholder="Nhập mã xác thực" required>
                                        </div>
                                    </form>

                                    
                                    <form method="POST" action="<?php echo e(route('change-password')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password_confirmation">Nhập lại mật khẩu mới</label>
                                            <input type="password" name="new_password_confirmation"
                                                id="new_password_confirmation" class="form-control" required>
                                        </div>

                                        <input type="hidden" name="email" value="<?php echo e(session('email')); ?>">

                                        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                                    </form>
                                    <!-- Form thay đổi mật khẩu -->
                                    <form action="<?php echo e(route('change-password')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password" placeholder="Nhập mật khẩu mới" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password_confirmation">Xác nhận mật khẩu:</label>
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Đổi mật khẩu</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        

                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                            <div class="container-fluid">
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('client.order.PaidOrders', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1386138315-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/client/user/userInformation.blade.php ENDPATH**/ ?>