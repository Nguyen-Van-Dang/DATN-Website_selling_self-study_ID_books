<?php $__env->startSection('title', 'Danh sách liên hệ'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form method="GET" action="<?php echo e(route('listContact')); ?>" class="mb-3">
        </form>
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-center">Danh sách liên hệ</h4>
                        <div class="col-md-2 mb-3">
                            <button type="button" id="deleteAllBtn" class="btn btn-danger w-100">Xóa tất cả</button>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th> <!-- Checkbox "Check All" -->
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Nội dung</th>
                                    
                                    <th>Thời gian</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" class="contact-checkbox" value="<?php echo e($contact->id); ?>">
                                        </td>
                                        <td><?php echo e($contact->id); ?></td>
                                        <td><?php echo e($contact->name); ?></td>
                                        <td><?php echo e($contact->email); ?></td>
                                        <td><?php echo e(\Illuminate\Support\Str::limit($contact->message, 50, '...')); ?></td>
                                        <td><?php echo e($contact->created_at->format('d/m/Y H:i:s')); ?></td>
                                        <td>
                                            <?php if($contact->is_replied == 1): ?>
                                                <span
                                                    style="background-color: #4CAF50; color: white; padding: 5px; border-radius: 5px;">Đã
                                                    trả lời</span>
                                            <?php elseif($contact->is_replied == 0): ?>
                                                <span
                                                    style="background-color: #f44336; color: white; padding: 5px; border-radius: 5px;">Chưa
                                                    trả lời</span>
                                            <?php else: ?>
                                                <span
                                                    style="background-color: #9E9E9E; color: white; padding: 5px; border-radius: 5px;">Không
                                                    xác định</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="flex justify-content-center align-items-center list-user-action">
                                                <!-- Trả lời liên hệ -->
                                                <form action="<?php echo e(route('replyContact', $contact->id)); ?>" method="GET"
                                                    style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-toggle="tooltip" title="Trả lời liên hệ">
                                                        <i class="ri-reply-line"></i>
                                                    </button>
                                                </form>
                                                <!-- Xóa liên hệ -->
                                                <form action="<?php echo e(route('contacts.destroy', $contact->id)); ?>" method="POST"
                                                    style="display:inline;" onsubmit="return confirmDelete(event, this)">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-toggle="tooltip" title="Xóa liên hệ">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>

                                                <script>
                                                    function confirmDelete(event, form) {
                                                        event.preventDefault(); // Chặn hành động mặc định của form
                                                        Swal.fire({
                                                            title: 'Bạn có chắc chắn?',
                                                            text: "Hành động này không thể hoàn tác!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Xóa',
                                                            cancelButtonText: 'Hủy'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                form.submit(); // Gửi form nếu người dùng xác nhận
                                                            }
                                                        });
                                                        return false; // Chặn gửi form ban đầu
                                                    }
                                                </script>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/admin/contact/listContact.blade.php ENDPATH**/ ?>