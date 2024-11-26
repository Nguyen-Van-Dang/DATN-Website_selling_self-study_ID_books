<div class="iq-card text-left m-0">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Sửa danh mục sách</h4>
        </div>
    </div>
    <div class="iq-card-body">
        <form id="editCategoryForm" action="<?php echo e(route('admin.danh-muc-sach.update', $findCategory->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label>Tên danh mục sách:</label>
                <input type="text" class="form-control" placeholder="Nhập tên danh mục sách..." name="category_name"
                    id="category_name" value="<?php echo e(old('category_name', $findCategory->name)); ?>">
                <?php $__errorArgs = ['category_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?><br /></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <textarea cols="30" rows="3" class="form-control" placeholder="Mô tả..." name="category_description"
                    id="category_description"><?php echo e(old('category_description', $findCategory->description)); ?>"</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-danger" data-dismiss="modal">Trở lại</button>
        </form>
    </div>
    <script>
        document.getElementById('editCategoryForm').addEventListener('submit', function(event) {
            // Kiểm tra lỗi validate, nếu có lỗi thì không gửi form
            const errorMessages = document.querySelectorAll('.text-danger');

            // Nếu có lỗi, ngăn không cho form submit và hiển thị thông báo
            if (errorMessages.length > 0) {
                event.preventDefault(); // Ngừng gửi form
                alert('Vui lòng sửa các lỗi trước khi gửi form.');
            }
        });
    </script>

</div>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/admin/categoryBook/updateCategoryBook.blade.php ENDPATH**/ ?>