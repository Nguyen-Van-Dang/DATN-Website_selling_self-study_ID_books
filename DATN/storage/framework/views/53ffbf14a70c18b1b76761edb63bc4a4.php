<?php $__env->startSection('title', 'Thông Tin Tài khoản'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-body p-0">
                    <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                            <li class="col-md-3 p-0">
                                <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                    Thông tin cá nhân
                                </a>
                            </li>
                            <li class="col-md-3 p-0">
                                <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                    Đổi mật khẩu
                                </a>
                            </li>
                            <li class="col-md-3 p-0">
                                <a class="nav-link" data-toggle="pill" href="#emailandsms">
                                    Lịch sử bài kiểm tra
                                </a>
                            </li>
                            <li class="col-md-3 p-0">
                                <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                    Lịch sử đơn hàng
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Thông tin cá nhân</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form method="POST" action="<?php echo e(route('userInformation')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group row align-items-center">
                                        <div class="col-md-12">
                                            <div class="profile-img-edit">
                                                <img class="profile-pic" src="<?php echo e(auth()->user()->image_url); ?>"
                                                    alt="profile-pic">
                                                <div class="p-image">
                                                    <i class="ri-pencil-line upload-button"></i>
                                                    <input class="file-upload" name="image_url" type="file"
                                                        accept="image/*" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="form-group col-sm-6">
                                            <label for="fname">Họ và tên:</label>
                                            <input type="text" class="form-control" id="fname" name="name"
                                                value="<?php echo e(auth()->user()->name); ?>">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="lname">Số điện thoại:</label>
                                            <input type="text" class="form-control" id="lname" name="phone"
                                                value="<?php echo e(auth()->user()->phone); ?>">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="uname">Email:</label>
                                            <input type="email" class="form-control" id="uname" name="email"
                                                value="<?php echo e(auth()->user()->email); ?>">
                                        </div>

                                        <?php if(auth()->check()): ?>
                                            <?php if(Auth::user()->role_id == 2): ?>
                                                <div class="form-group col-sm-6">
                                                    <label for="sex">Giới tính:</label>
                                                    <select class="form-control" id="sex" name="sex">
                                                        <option value="0"
                                                            <?php echo e(auth()->user()->sex == 0 ? 'selected' : ''); ?>>Nam</option>
                                                        <option value="1"
                                                            <?php echo e(auth()->user()->sex == 1 ? 'selected' : ''); ?>>Nữ</option>
                                                    </select>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary mr-2">Xác nhận</button>
                                    <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Đổi mật khẩu</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form>
                                    <div class="form-group">
                                        <label for="cpass">Mật khẩu hiện tại:</label>
                                        <a href="javascripe:void();" class="float-right">Quên mật khẩu</a>
                                        <input type="Password" class="form-control" id="cpass" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="npass">Mật khẩu mới:</label>
                                        <input type="Password" class="form-control" id="npass" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="vpass">Xác nhận lại mật khẩu:</label>
                                        <input type="Password" class="form-control" id="vpass" value="">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                                    <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Lịch Sử Bài Kiểm Tra</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">

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
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/client/user/userInformation.blade.php ENDPATH**/ ?>