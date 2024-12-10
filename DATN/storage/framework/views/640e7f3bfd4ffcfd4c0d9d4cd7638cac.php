<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh khóa học khóa học</h4>
            </div>
            <div class="iq-search-bar" style="margin-left: 30%;">
                <form class="searchbox" style="width: 150%;">
                    <input type="text" class="text search-input" placeholder="Tìm kiếm khóa học..."
                        wire:model.live.debounce.10ms="search">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a href="<?php echo e(route('admin.khoa-hoc.create')); ?>" class="btn btn-primary">Thêm khóa học</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 3%;">STT</th>
                            <th style="width: 10%;">Hình ảnh</th>
                            <th style="width: 15%;">Tên khóa học</th>
                            <th style="width: 6%;">Số bài giảng</th>
                            <th style="width: 6%;">Giá</th>
                            <th style="width: 10%;">Người tạo</th>
                            <th style="width: 7%;">Hoạt động</th>
                        </tr>
                    </thead>
                    <!--[if BLOCK]><![endif]--><?php if(sizeof($Course) > 0): ?>
                        <tbody class="text-center">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $Course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->id); ?></td>
                                    <td>
                                        <?php
                                            $firstImage = $item->images->first();
                                        ?>

                                        <!--[if BLOCK]><![endif]--><?php if($firstImage): ?>
                                            <img src="<?php echo e($firstImage->image_url); ?>" alt="Image"
                                                class="img-fluid rounded zoom-img" style="width: 190px; height: 112px; border: 1px solid #dee2e6;"/>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/images/book/user/course.jpg')); ?>" alt="No Image"
                                                class="img-fluid rounded" style="width: 190px; height: 112px; border: 1px solid #dee2e6;"/>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>
                                    <td><?php echo e(strlen($item->name) > 100 ? substr($item->name, 0, 100) . '...' : $item->name); ?>

                                    </td>
                                    <td><?php echo e($item->lectures_count); ?></td>
                                    <td>
                                        <!--[if BLOCK]><![endif]--><?php if($item->discount > 0): ?>
                                            <span class="fw-bold text-danger">
                                                <?php echo e(number_format($item->price - $item->discount, 0, ',', '.')); ?> đ
                                            </span>
                                            <br>
                                            <span class="text-muted"
                                                style="text-decoration: line-through; margin-left: 8px;">
                                                <?php echo e(number_format($item->price, 0, ',', '.')); ?> đ
                                            </span>
                                            <br>
                                            <?php
                                                $discountPercent = round(($item->discount / $item->price) * 100, 2);
                                            ?>
                                            <div
                                                style="background-color: #f44336; color: white; padding: 3px 8px; border-radius: 5px; display: inline-block; margin-top: 5px;">
                                                -<?php echo e($discountPercent); ?>%
                                            </div>
                                        <?php else: ?>
                                            <span class="fw-bold"><?php echo e(number_format($item->price, 0, ',', '.')); ?>

                                                đ</span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>
                                    <?php
                                        $user = $item->user;
                                    ?>
                                    <td><?php echo e($user ? optional($item->user)->name : 'Không có người tạo'); ?></td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a class="bg-primary" data-toggle="tooltip" title="Xem chi tiết"
                                                href="#"><i class="ri-eye-line"></i></a>
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Chỉnh sửa"
                                                href="<?php echo e(route('admin.khoa-hoc.edit', $item->id)); ?>">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Xóa"
                                                wire:click="openPopup('delete', <?php echo e($item->id); ?>)">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    <?php else: ?>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">Không tìm thấy khóa học nào.</td>
                            </tr>
                        </tbody>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </table>
            </div>
            <div class="text-end">
                <?php echo e($Course->links()); ?>

            </div>
        </div>
    </div>

    <!-- Popup xóa danh mục -->
    <div class="modal <?php echo e($isDeletePopupOpen ? 'is-open' : ''); ?>" id="deletedCourseModal" wire:click="closePopup()">
        <div class="modal-overlay"></div>
        <div class="modal-content" style="width: 30%;" wire:click.stop>
            <div class="col-12 text-center p-0">
                <div class="col-sm-12 p-0">
                    <div class="iq-card mb-0">
                        <div class="iq-card-header p-0">
                            <div class="iq-header-title">
                                <h4 class="card-title">Bạn có chắc chắn xóa khóa học này hay không?</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form wire:submit.prevent="deleted" style="padding: 25px;">
                                <button type="submit" class="btn btn-primary"
                                    style="width: 100px; height: 40px;">Xác Nhận</button>
                                <button type="reset" class="btn btn-danger" wire:click="closePopup()"
                                    style="width: 100px; height: 40px;">Hủy</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/livewire/admin/course/course-index.blade.php ENDPATH**/ ?>