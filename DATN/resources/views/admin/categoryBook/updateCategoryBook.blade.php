<div class="iq-card text-left m-0">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Sửa danh mục sách</h4>
        </div>
    </div>
    <div class="iq-card-body">
        <form id="editCategoryForm" action="{{ route('admin.danh-muc-sach.update', $findCategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Tên danh mục sách:</label>
                <input type="text" class="form-control" placeholder="Nhập tên danh mục sách..." name="category_name"
                    id="category_name" value="{{ old('category_name', $findCategory->name) }}">
                @error('category_name')
                    <span class="text-danger">{{ $message }}<br /></span>
                @enderror
            </div>
            <div class="form-group">
                <label>Mô tả:</label>
                <textarea cols="30" rows="3" class="form-control" placeholder="Mô tả..." name="category_description"
                    id="category_description">{{ old('category_description', $findCategory->description) }}"</textarea>
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
