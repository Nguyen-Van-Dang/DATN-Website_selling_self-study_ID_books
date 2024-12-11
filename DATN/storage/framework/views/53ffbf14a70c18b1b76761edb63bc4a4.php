<?php $__env->startSection('title', 'Thông Tin Tài khoản'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
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
                                <li class="col-md-6 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="col-md-6 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang1-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-4 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal1-information">
                                        Thông tin cá nhân
                                    </a>
                                </li>

                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#manage1-contact">
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
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
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
                                            <input type="password" class="form-control" id="npass" name="new_password">
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
                        
                        <div class="tab-pane fade " id="personal1-information" role="tabpanel">
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
                        
                        <div class="tab-pane fade active show" id="chang1-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Đổi mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body ">

                                    <form action="<?php echo e(route('userInfo')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        
                                        <div class="form-group">
                                            <label for="cpass">Mật khẩu hiện tại:</label>
                                            <input type="password" class="form-control" id="cpass" name="password">
                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass" name="new_password">
                                            <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="vpass">Xác nhận mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="vpass"
                                                name="new_password_confirmation">
                                            <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        
                                        <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="manage1-contact" role="tabpanel">
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