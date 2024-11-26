<div class="col-sm-12">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh sách đơn hàng</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <div class="dropdown">
                    <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                        <i class="ri-more-fill"></i>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                        <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>Xem</a>
                        <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Xoá</a>
                        <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Sửa</a>
                        <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>In</a>
                        <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Tải xuống</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-borderless">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Mã Số</th>
                            <th scope="col">Số tiền</th>
                            <th scope="col">Trạng Thái</th>
                            <th scope="col">Người dùng</th>
                            <th scope="col" class="text-center">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $Order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr  class="text-center">
                                <td><?php echo e($item->id); ?></td>
                                <td><?php echo e($item->price); ?></td>
                                <td><?php echo e($item->payment_status); ?></td>
                                    <?php
                                        $user = $item->user;
                                    ?>
                                    <td><?php echo e($user ? optional($item->user)->name : 'Không có người dùng'); ?></td>
                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" title="Xem chi tiết"
                                            href="#"><i class="ri-eye-line"></i></a>
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
                <?php echo e($Order->links()); ?>

            </div>
        </div>
    </div>
    <!-- Popup xác nhận -->
    <div id="confirmPopup"
    style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
    <p>Bạn có chắc chắn muốn xóa đơn hàng này không?</p>
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
            const orderId = this.id.split('-')[1];
            // Hiển thị popup và màn che
            document.getElementById('confirmPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            // Gán sự kiện cho nút Xác nhận
            document.getElementById('yesButton').onclick = function() {
                // Gửi form xóa tài khoản
                document.getElementById(`delete-form-${orderId}`).submit();
            };
        });
    });
    // Ẩn popup khi nhấn nút "Trở về"
    document.getElementById('noButton').addEventListener('click', function() {
        document.getElementById('confirmPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    });
</script><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/livewire/order/render-order.blade.php ENDPATH**/ ?>