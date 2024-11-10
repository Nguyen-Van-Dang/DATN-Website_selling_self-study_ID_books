<div class="col-sm-12">
    @if (session()->has('message'))
        <div class="">{{ session('message') }}</div>
    @endif
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh sách tài khoản</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a wire:click="openPopup('add')" class="btn btn-primary">Thêm tài khoản</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>Mã Số</th>
                            <th>Ảnh</th>
                            <th>Tên người dùng</th> 
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng Thái</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="{{ $item->image_url }}" class="img-fluid avatar-50 rounded"
                                        alt="">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role_id }}</td>
                                <td>{{ $item->status }}</td>
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
                </table>
            </div>
            <div class="text-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- Thêm người dùng --}}
    <div class="modal {{ $isAddPopupOpen ? 'is-open' : '' }}" id="addCourseCateModal" wire:click="closePopup()">
        <div class="modal-content" wire:click.stop>
            <span class="close" wire:click="closePopup()">&times;</span>
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Thêm người dùng</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form wire:submit.prevent="createUser">
                            <div class="form-group">
                                <label>Tên tài khoản:</label>
                                <input wire:model="name" type="text" class="form-control"
                                    placeholder="Nhập tên tài khoản...">
                                @error('name')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ảnh tài khoản:</label>
                                <div class="custom-file">
                                    <input wire:model="image_url" type="file" class="custom-file-input"
                                        id="image_url">
                                    <label class="custom-file-label" for="image_url" style="z-index: 0;">Chọn tập
                                        tin</label>
                                </div>
                                @error('image_url')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone:</label>
                                <input wire:model="phone" type="phone" class="form-control"
                                    placeholder="Nhập phone...">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input wire:model="email" type="email" class="form-control"
                                    placeholder="Nhập email...">
                                @error('email')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Vai trò:</label>
                                <select class="form-control" wire:model="role_id">
                                    <option value="1">Admin</option>
                                    <option value="2">Giáo viên</option>
                                    <option value="3">Học sinh</option>
                                </select>
                                @error('role_id')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select class="form-control" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}<br /></span>
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

    {{-- Sửa người dùng --}}
    <div class="modal {{ $isEditPopupOpen ? 'is-open' : '' }}" id="isEditPopupOpen" wire:click="closePopup()">
        <div class="modal-content" wire:click.stop>
            <span class="close" wire:click="closePopup()">&times;</span>
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Sửa người dùng</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form wire:submit.prevent="updateUser">
                            <div class="form-group">
                                <label>Tên tài khoản:</label>
                                <input wire:model="nameAdd" type="text" class="form-control"
                                    placeholder="Nhập tên tài khoản...">
                                @error('nameAdd')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ảnh tài khoản:</label>
                                <div class="custom-file">
                                    <input wire:model="image_urlAdd" type="file" class="custom-file-input"
                                        id="image_urlAdd">
                                    <label class="custom-file-label" for="image_urlAdd" style="z-index: 0;">Chọn tập
                                        tin</label>
                                    @error('image_urlAdd')
                                        <span class="text-danger">{{ $message }}<br /></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input wire:model="emailAdd" type="email" class="form-control"
                                    placeholder="Nhập email...">
                                @error('emailAdd')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone:</label>
                                <input wire:model="phoneAdd" type="phone" class="form-control"
                                    placeholder="Nhập sdt...">
                                @error('phoneAdd')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Vai trò:</label>
                                <select wire:model="role_idAdd" class="form-control">
                                    <option value="">Chọn vai trò</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Giáo viên</option>
                                    <option value="3">Học sinh</option>
                                </select>
                                @error('role_idAdd')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select wire:model="statusAdd" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('statusAdd')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-danger" wire:click="closePopup()">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Xóa người dùng --}}

    <div class="modal {{ $isDeletePopupOpen ? 'is-open' : '' }}" id="editCourseCateModal" wire:click="closePopup()">
        <div class="modal-content" wire:click.stop>
            <span class="close" wire:click="closePopup()">&times;</span>
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Xóa người dùng</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form wire:submit.prevent="deleted" style="padding: 25px;">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-danger">Xóa</button>
                         
                            <button class="btn btn-secondary" wire:click="closePopup()">Hủy</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
