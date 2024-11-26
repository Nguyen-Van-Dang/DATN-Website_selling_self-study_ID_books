<div class="col-sm-12">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh sách thông báo</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a href="<?php echo e(route('addNotification')); ?>" class="btn btn-primary">Gửi thông báo</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-borderless">
                    <thead class="text-center">
                        <tr>
                            <th  style="width: 3%;">Mã số</th>
                            <th  style="width: 20%;">Trạng thái</th>
                            <th  style="width: 20%;">Người Gửi</th>
                            <th  style="width: 10%;" class="text-center">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $notificationUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($item->id); ?></td>
                                <td class="text-center"><?php echo e($item->status == 1 ? 'Đã Gửi' : 'Chưa Gửi'); ?></td>
                                <?php
                                    $user = $item->user;
                                ?>
                                <td class="text-center"><?php echo e($user->name); ?></td>
                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" title="Xem chi tiết"
                                            href="<?php echo e(route('listNotification', $item->id)); ?>"><i class="ri-eye-line"></i></a>
                                        <a id="deleteButton-<?php echo e($item->id); ?>" class="bg-primary text-white"
                                            href="" data-toggle="tooltip" title="Xóa"><i
                                                class="ri-delete-bin-line"></i></a>
                                    </div>
                                    <form action="<?php echo e(route('nguoi-dung.destroy', $item->id)); ?>" method="POST"
                                        id="delete-form-<?php echo e($item->id); ?>" style="display:none">
                                        <?php echo method_field('DELETE'); ?>
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
            
            <div class="text-end">
                <?php echo e($notificationUser->links()); ?>

            </div>
        </div>
    </div>
        <!-- Popup xác nhận -->
        <div id="confirmPopup"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
        <p>Bạn có chắc chắn muốn xóa thông báo này không?</p>
        <div class="text-center">
            <button id="yesButton"
                style="width: 90px; height: 35px; border: none; color: white; background: #11e1c2; border-radius: 5px;">
                Xác nhận
            </button>
            <button id="noButton"
                style="width: 90px; height: 35px; border: none; color: black; background-color: #0000000e; border-radius: 5px;">
                Trở về
            </button>
        </div>
    </div>
    <!-- Màn che -->
    <div id="overlay"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;">
    </div>
</div>

<script>
    document.querySelectorAll('[id^=deleteButton-]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            // Lấy ID tài khoản từ nút xóa
            const notificationId = this.id.split('-')[1];
            // Hiển thị popup và màn che
            document.getElementById('confirmPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            // Gán sự kiện cho nút Xác nhận
            document.getElementById('yesButton').onclick = function() {
                // Gửi form xóa tài khoản
                document.getElementById(`delete-form-${notificationId}`).submit();
            };
        });
    });
    // Ẩn popup khi nhấn nút "Trở về"
    document.getElementById('noButton').addEventListener('click', function() {
        document.getElementById('confirmPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    });
</script><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/livewire/notification/render-notification.blade.php ENDPATH**/ ?>