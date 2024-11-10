<div class="col-sm-12">
    @if (session()->has('message'))
        <div class="">{{ session('message') }}</div>
    @endif
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh mục khóa học</h4>
            </div>
            <div class="iq-search-bar" style="margin-left: 30%;">
                <form class="searchbox" style="width: 150%;">
                    <input type="text" class="text search-input" placeholder="Tìm kiếm danh mục khóa học..."
                        wire:model.live.debounce.100ms="search">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a class="btn btn-primary text-white" wire:click="openPopup('add')">
                    Thêm danh mục khóa học
                </a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th style="width: 22.5%;">Tên danh mục</th>
                            <th style="width: 22.5%;">Người tạo</th>
                            <th style="width: 11%;">Hoạt động</th>
                        </tr>
                    </thead>
                    @if (sizeof($courseCate) > 0)
                        <tbody class="text-center">
                            @foreach ($courseCate as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="mb-0">{{ $item->name }}</td>
                                    @php
                                        $user = $item->user;
                                    @endphp
                                    <td>{{ $user ? optional($item->user)->name : 'Không có người dùng' }}</td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Xem chi tiết">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Chỉnh sửa"
                                                wire:click="openPopup('edit', {{ $item->id }})">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Xóa"
                                                wire:click="openPopup('delete', {{ $item->id }})">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center">Không tìm thấy danh mục khóa học nào.</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            <div class="text-end">
                {{ $courseCate->links() }}
            </div>
        </div>
    </div>
    <!-- Popup thêm danh mục -->
    <div class="modal {{ $isAddPopupOpen ? 'is-open' : '' }}" id="addCourseCateModal" wire:click="closePopup()">
        <div class="modal-content" wire:click.stop>
            <span class="close" wire:click="closePopup()">&times;</span>
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Thêm danh mục khóa học</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form wire:submit.prevent="storeCourseCate">
                            <div class="form-group">
                                <label>Tên danh mục khóa học:</label>
                                <input wire:model="nameAdd" type="text" class="form-control"
                                    placeholder="Nhập tên danh mục khóa học...">
                                @error('nameAdd')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror

                                <label>Mô tả khóa học:</label>
                                <input wire:model="descriptionAdd" type="text" class="form-control"
                                    placeholder="Nhập mô tả danh mục khóa học...">
                                @error('descriptionAdd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="reset" class="btn btn-danger" wire:click="closePopup()">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup sửa danh mục -->
    <div class="modal {{ $isEditPopupOpen ? 'is-open' : '' }}" id="editCourseCateModal" wire:click="closePopup()">
        <div class="modal-content" wire:click.stop>
            <span class="close" wire:click="closePopup()">&times;</span>
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Sửa danh mục khóa học</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form wire:submit.prevent="updateCourseCate">
                            <div class="form-group">
                                <label>Tên danh mục khóa học:</label>
                                <input wire:model="name" type="text" class="form-control"
                                    placeholder="Nhập tên danh mục khóa học...">
                                @error('name')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror

                                <label>Mô tả khóa học:</label>
                                <input wire:model="description" type="text" class="form-control"
                                    placeholder="Nhập mô tả danh mục khóa học...">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-danger" wire:click="closePopup()">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup xóa danh mục -->
    <div class="modal {{ $isDeletePopupOpen ? 'is-open' : '' }}" id="deletedCourseCateModal"
        wire:click="closePopup()">
        <div class="modal-content" style="width: 30%;" wire:click.stop>
            <div class="col-12 text-center">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header">
                            <div class="iq-header-title">
                                <h4 class="card-title">Bạn có chắc chắn xóa hay không?</h4>
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
