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
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>

                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#reset-pwd">
                                        Quên mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                        Lịch sử đơn hàng
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
                        
                        
                        
                        <div class="tab-pane fade  active show" id="chang-pwd" role="tabpanel">
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
                                            
                                            <input type="password" class="form-control" id="cpass" name="password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass"
                                                name="new_password" required>
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
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Thông tin cá nhân</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <form>
                                        <div class="form-group row align-items-center">
                                            <div class="col-md-12">
                                                <div class="profile-img-edit">
                                                    <img class="profile-pic"
                                                        src="<?php echo e(asset('assets/images/book/user/1.jpg')); ?>"
                                                        alt="profile-pic">
                                                    <div class="p-image">
                                                        <i class="ri-pencil-line upload-button"></i>
                                                        <input class="file-upload" type="file" accept="image/*" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row align-items-center">
                                            <div class="form-group col-sm-6">
                                                <label for="fname">Họ và tên:</label>
                                                <input type="text" class="form-control" id="fname"
                                                    value="Ông">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="lname">Số điện thoại:</label>
                                                <input type="text" class="form-control" id="lname"
                                                    value="Trần Thuận">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="uname">Email:</label>
                                                <input type="text" class="form-control" id="uname"
                                                    value="Thuangiaosu">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cname">Ngày sinh:</label>
                                                <input type="date" class="form-control" id="cname"
                                                    value="TV Team">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Tỉnh thành:</label>
                                                <input class="form-control" id="dob" value="1984-01-24">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Quận:</label>
                                                <input class="form-control" id="dob" value="1984-01-24">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Huyện:</label>
                                                <input class="form-control" id="dob" value="1984-01-24">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Xã:</label>
                                                <input class="form-control" id="dob" value="1984-01-24">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label>Ghi chú thêm địa chỉ:</label>
                                                <textarea class="form-control" name="address" rows="5" style="line-height: 22px;">06 Nam Thành Đà Nãng, VA 23803 Viet Nam Zip Code: 40001
                                       </textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Xác nhận</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
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
                                            
                                            <input type="password" class="form-control" id="cpass" name="password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass"
                                                name="new_password" required>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/admin/user/userInfo.blade.php ENDPATH**/ ?>