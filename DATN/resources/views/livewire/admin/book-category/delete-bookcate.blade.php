<div>
    @forelse ($bookcateUsers as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td class="mb-0">{{ $item->name }}</td>
            <td class="mb-0">{{ $item->deleted_at }}</td>
            <td>
                <a href="" class="btn btn-success">Khôi phục</a>
                <a href="" class="btn btn-danger">Xóa vĩnh viễn</a>
                {{-- <div class="flex align-items-center text-center list-user-action">
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
            </div> --}}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Không có danh mục sách nào bị xóa</td>
        </tr>
    @endforelse
</div>
