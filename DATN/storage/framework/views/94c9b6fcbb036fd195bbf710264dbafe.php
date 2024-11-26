

<?php $__env->startSection('title', 'Gửi liên hệ'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header ">
                        <div class="iq-header-title">
                            <h4 class="card-title">Gửi liên hệ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <!-- Hiển thị thông báo nếu có -->
                        
                        <?php if(auth()->guard()->check()): ?>
                            <form method="POST" action="<?php echo e(route('storeContact')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label>Tên tài khoản:</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo e(Auth::user()->name); ?>"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo e(Auth::user()->email); ?>"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="Nhập nội dung..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                                <button type="reset" class="btn btn-danger">Trở lại</button>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <strong>Vui lòng <a href="<?php echo e(route('handleLogin')); ?>">đăng nhập</a> để gửi liên hệ.</strong>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/client/contact/addContact.blade.php ENDPATH**/ ?>