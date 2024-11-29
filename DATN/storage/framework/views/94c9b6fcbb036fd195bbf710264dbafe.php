<?php $__env->startSection('title', 'Gửi liên hệ'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header">
                        <div class="iq-header-title">
                            <h4 class="card-title">Gửi liên hệ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <!-- Hiển thị thông báo nếu có -->
                        <?php if(session()->has('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php elseif(session()->has('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('storeContact')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Tên của bạn:</label>
                                <input type="text" name="name" class="form-control" 
                                    value="<?php echo e(old('name', Auth::check() ? Auth::user()->name : '')); ?>" 
                                    placeholder="Nhập tên của bạn" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" 
                                    value="<?php echo e(old('email', Auth::check() ? Auth::user()->email : '')); ?>" 
                                    placeholder="Nhập email của bạn" required>
                            </div>
                            <div class="form-group">
                                <label>Nội dung:</label>
                                <textarea name="message" class="form-control" rows="4" 
                                    placeholder="Nhập nội dung..." required><?php echo e(old('message')); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                            <button type="reset" class="btn btn-danger">Xóa</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/client/contact/addContact.blade.php ENDPATH**/ ?>