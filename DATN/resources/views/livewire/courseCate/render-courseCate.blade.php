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
                   <input type="text" class="text search-input" placeholder="Tìm kiếm sản phẩm..." wire:model.live.debounce.100ms="search">
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
                    @if (sizeof($courseCate)>0)
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
                                        <a class="bg-primary" data-toggle="tooltip" title="Xem chi tiết"
                                            href="#"><i class="ri-eye-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" title="Chỉnh sửa"
                                            wire:click="openPopup('edit', {{ $item->id }})">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                        <a class="bg-primary text-white" href="javascript:void(0);"
                                            data-toggle="tooltip" title="Xóa"
                                            wire:click="delete({{ $item->id }})"
                                            wire:click="confirmDelete({{ $item->id }})">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
                                    <span class="text-danger">{{ $message }}<br/></span>
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
                                    <span class="text-danger">{{ $message }}<br/></span>
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
</div>
