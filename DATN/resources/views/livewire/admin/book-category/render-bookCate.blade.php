<div class="col-sm-12">
    <div class="iq-card  mb-0">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh mục sách</h4>
            </div>
            <div class="iq-search-bar" style="margin-left: 30%;">
                <form class="searchbox" style="width: 150%;">
                    <input type="text" class="text search-input" placeholder="Tìm kiếm danh mục sách..."
                        wire:model.live.debounce.10ms="search">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a href="{{ route('admin.danh-muc-sach.create') }}" class="btn btn-primary">Thêm danh mục sách</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 22.5%;">Tên danh mục</th>
                            <th style="width: 11%;">Trạng thái</th>
                            <th style="width: 11%;">Sách thuộc danh mục</th>
                            <th style="width: 11%;">Hoạt động</th>
                        </tr>
                    </thead>
                    @if (sizeof($bookCate) > 0)
                        <tbody class="text-center">
                            @foreach ($bookCate as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="mb-0">{{ $item->name }}</td>

                                    <td>
                                        <span class="badge {{ $item->status == 0 ? 'badge-primary' : 'badge-danger' }}">
                                            {{ $item->status == 0 ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                    <td class="mb-0">{{ $item->books->count() }}</td>
                                    <td>
                                        <div class="flex align-items-center text-center list-user-action">
                                            <a class="bg-primary" data-toggle="tooltip" data-placement="top"
                                                title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                            <a class="bg-primary edit-category" data-toggle="tooltip"
                                                data-placement="top" title="Sửa"
                                                data-url="{{ route('admin.danh-muc-sach.edit', $item->id) }}"
                                                href="javascript:void(0);">
                                                <i class="ri-pencil-line"></i>
                                            </a>

                                            <a class="bg-primary" data-toggle="tooltip" data-placement="top"
                                                title="Xóa"
                                                onclick="confirmDelete(this, {{ $item->id }}, '{{ $item->name }}')"
                                                href="#"
                                                data-url="{{ route('admin.danh-muc-sach.destroy', ':id') }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal" tabindex="-1"
                                            role="dialog"aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg d-flex align-items-center justify-content-center "
                                                role="document">
                                                <div class="modal-content" style="width:700px">
                                                    <div class="modal-body" style="width:100%">
                                                        <!-- Nội dung form chỉnh sửa sẽ được load ở đây -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deleteModal" tabindex="-1"
                                            role="dialog"aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered d-flex align-items-center justify-content-center "
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="iq-card mb-0">
                                                            <div class="iq-card-header">
                                                                <div class="iq-header-title">
                                                                    <h5>Xác nhận xoá danh mục
                                                                        <b id="itemName"></b> ?
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="iq-card-body">
                                                                <form id="deleteForm" method="POST" action="">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-primary"
                                                                        style="width: 100px; height: 40px;">Xác
                                                                        nhận</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal"
                                                                        style="width: 100px; height: 40px;">Hủy</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">Không tìm thấy danh mục sách nào.</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>

            <div class="text-end">
                {{ $bookCate->links() }}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-category').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    let url = this.getAttribute('data-url');

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            document.querySelector('#editModal .modal-body').innerHTML = html;

                            $('#editModal').modal('show');
                        })
                        .catch(error => {
                            console.error('Có lỗi xảy ra:', error);
                        });
                });
            });
        });


        function confirmDelete(element, id, name) {
            const url = element.getAttribute('data-url').replace(':id', id);
            document.getElementById('deleteForm').action = url;
            document.getElementById('itemName').textContent = name;
            $('#deleteModal').modal('show');
        }
    </script>

</div>
