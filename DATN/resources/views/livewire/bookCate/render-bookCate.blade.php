<div class="col-sm-12">
    <div class="iq-card">
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
                <a href="{{ route('addCategoryBook') }}" class="btn btn-primary">Thêm danh mục sách</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th style="width: 22.5%;">Tên danh mục</th>
                            <th style="width: 22.5%;">Người Tạo</th>
                            <th style="width: 11%;">Hoạt động</th>
                        </tr>
                    </thead>
                    @if (sizeof($bookCate) > 0)
                    <tbody class="text-center">
                        @foreach ($bookCate as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="mb-0">{{ $item->name }}</td>
                                @php
                                    $user = $item->user;
                                @endphp
                                <td>{{ $user ? optional($item->user)->name : 'Không có người tạo' }}</td>
                                <td>
                                    <div class="flex align-items-center text-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top"
                                            title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Sửa"
                                            data-original-title="Sửa" href="{{ route('updateCategoryBook') }}"><i
                                                class="ri-pencil-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xóa"
                                            data-original-title="Xoá" href="#"><i
                                                class="ri-delete-bin-line"></i></a>
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
</div>
