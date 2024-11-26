

<?php $__env->startSection('title', 'Phản hồi liên hệ'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header">
                    <h4 class="card-title">Phản hồi liên hệ</h4>
                </div>
                <div class="iq-card-body">
                    <form method="POST" action="<?php echo e(route('sendReply', $contact->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label>Tên người liên hệ:</label>
                            <input type="text" class="form-control" value="<?php echo e($contact->name); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" value="<?php echo e($contact->email); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nội dung:</label>
                            <textarea class="form-control" readonly><?php echo e($contact->message); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phản hồi:</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Nhập nội dung phản hồi..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/admin/contact/replyContact.blade.php ENDPATH**/ ?>