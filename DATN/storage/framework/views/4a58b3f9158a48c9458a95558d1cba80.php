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
                            <tr class="text-center">
                                <td><?php echo e($item->id); ?></td>
                                <td><?php echo e($item->price); ?></td>
                                <td>
                                    <!--[if BLOCK]><![endif]--><?php if($item->payment_status == 0): ?>
                                        Chưa thanh toán
                                    <?php elseif($item->payment_status == 1): ?>
                                        Đã thanh toán
                                    <?php elseif($item->payment_status == 2): ?>
                                        Đang giao
                                    <?php else: ?>
                                        Đã Giao
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <?php
                                    $user = $item->user;
                                ?>
                                <td><?php echo e($user ? optional($item->user)->name : 'Không có người dùng'); ?></td>
                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" title="Xem chi tiết"
                                            style="cursor: pointer" id="orderId <?php echo e($item->id); ?>"
                                            wire:click="openDetailPopup(<?php echo e($item->id); ?>)">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role_id == 1): ?>
                                            <a class="bg-primary" data-toggle="tooltip" title="Sửa Trạng Thái"
                                                style="cursor: pointer"
                                                wire:click="openPaymentPopup(<?php echo e($item->id); ?>)">
                                                <i class="ri-pencil-line"></i></a>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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

    <!-- Popup Chỉnh Sửa -->
    <div style="backdrop-filter: blur(1px);" class="modal fade <?php echo e($isPaymentPopupOpen ? 'show d-block' : ''); ?>"
        tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh Trạng Thái</h5>
                    <button type="button" class="close" wire:click="closePaymentPopup">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="form-control" wire:model="payment_status">
                        <option value="0">Chưa Thanh Toán</option>
                        <option value="1">Đã Thanh Toán</option>
                        <option value="2">Đang Giao</option>
                        <option value="3">Đã Giao</option>
                    </select>
                    <button class="btn btn-primary d-block mt-3" wire:click="updatePaymentStatus">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Chi Tiết -->
    <div style="backdrop-filter: blur(1px);" class="modal fade <?php echo e($isDetailPopupOpen ? 'show d-block' : ''); ?>"
        tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết Đơn Hàng <?php echo e($this->order ? $this->order->id : 'N/A'); ?> (
                        Chưa Thuế)
                    </h5>
                    <button type="button" class="close" wire:click="closeDetailPopup">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="iq-card-body">
                        <ul class="list-inline p-0 m-0">
                            <!--[if BLOCK]><![endif]--><?php if($this->order): ?>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->order->orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="checkout-product">
                                        <div class="row align-items-center">
                                            <div class="col-sm-2">
                                                <span class="checkout-product-img">
                                                    <a href="javascript:void();">
                                                        <!--[if BLOCK]><![endif]--><?php if($detail->book): ?>
                                                            <?php
                                                                $bookImage = $detail->book->images
                                                                    ->where('image_name', 'thumbnail')
                                                                    ->first();
                                                            ?>
                                                            <!--[if BLOCK]><![endif]--><?php if($bookImage): ?>
                                                                <img src="<?php echo e($bookImage->image_url); ?>"
                                                                    class="img-thumbnail">
                                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                        <?php elseif($detail->course): ?>
                                                            <?php
                                                                $courseImage = $detail->course->images
                                                                    ->where('image_name', 'thumbnail')
                                                                    ->first();
                                                            ?>

                                                            <!--[if BLOCK]><![endif]--><?php if($courseImage): ?>
                                                                <img src="<?php echo e($courseImage->image_url); ?>"
                                                                    class="img-thumbnail">
                                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <!--[if BLOCK]><![endif]--><?php if($detail->book): ?>
                                                    <div class="checkout-product-details">
                                                        <h5><?php echo e($detail->book->name); ?></h5>
                                                        <div class="price">
                                                            <h5><?php echo e(number_format($detail->book->price)); ?>đ</h5>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="checkout-product-details">
                                                        <h5><?php echo e($detail->course->name); ?></h5>
                                                        <div class="price">
                                                            <h5><?php echo e(number_format($detail->course->price)); ?>đ
                                                            </h5>
                                                        </div>
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row align-items-center mt-2">
                                                            <div class="col-md-4">
                                                                <input type="text" readonly
                                                                    id="quantity<?php echo e($detail->id); ?>" class="quantity"
                                                                    style=" width: 30px; height: 28px;"
                                                                    value="<?php echo e($detail->quantity); ?>">
                                                            </div>
                                                            <div class="col-md-7 text-center">
                                                                <h5>Tổng Tiền</h5>
                                                                <!--[if BLOCK]><![endif]--><?php if($detail->book): ?>
                                                                    <span class="product-price">
                                                                        <?php echo e(number_format($detail->book->price * $detail->quantity)); ?>đ</span>
                                                                <?php else: ?>
                                                                    <span class="product-price">
                                                                        <?php echo e(number_format($detail->course->price)); ?>đ</span>
                                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </ul>
                    </div>
                </div>
            </div>
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
</script>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/livewire/order/render-order.blade.php ENDPATH**/ ?>