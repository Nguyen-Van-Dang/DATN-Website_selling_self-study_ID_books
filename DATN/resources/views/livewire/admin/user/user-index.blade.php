<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh sách tài khoản</h4>
            </div>
            <div class="iq-search-bar" style="margin-left: 30%;">
                <form class="searchbox" style="width: 150%;">
                    <input type="text" class="text search-input" placeholder="Tìm kiếm tài khoản..."
                        wire:model.live.debounce.10ms="search">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a wire:click="openPopup('add')" class="btn btn-primary text-white">Thêm tài khoản</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên người dùng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng Thái</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    @if (sizeof($users) > 0)
                        <tbody class="text-center">
                            @foreach ($users as $item)
                                <tr>
                                    <td style="width: 3%;">{{ $item->id }}</td>
                                    {{-- <td style="width: 10%;">
                                        @php
                                            $firstImage = $item->images->first();
                                        @endphp

                                        @if ($firstImage)
                                            <img src="{{ $firstImage->image_url }}" alt="Image"
                                                class="img-fluid avatar-100 rounded" />
                                        @else
                                            <img src="{{ asset('assets/images/book/user/thub.jpg') }}" alt="No Image"
                                                class="img-fluid avatar-100 rounded" />
                                        @endif
                                    </td> --}}
                                    <td style="width: 10%;">
                                        @php
                                            $firstImage = $item->images->first();
                                        @endphp
                                    
                                        @if ($firstImage)
                                            <img src="{{ $firstImage->image_url }}" alt="Image" class="img-fluid avatar-100 rounded zoom-img" />
                                        @else
                                            <img src="{{ asset('assets/images/book/user/thub.jpg') }}" alt="No Image" class="img-fluid avatar-100 rounded" />
                                        @endif
                                    </td>                                 
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="window.open('https://mail.google.com/mail/u/0/?view=cm&fs=1&to={{ $item->email }}', '_blank');" title="Gửi email" class="text-black">
                                            {{ $item->email }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($item->role_id == 1)
                                            <span
                                                style="background-color: #f44336; color: white; padding: 5px; border-radius: 5px;">Admin</span>
                                        @elseif ($item->role_id == 2)
                                            <span
                                                style="background-color: #2196F3; color: white; padding: 5px; border-radius: 5px;">Giáo
                                                viên</span>
                                        @elseif ($item->role_id == 3)
                                            <span
                                                style="background-color: #4CAF50; color: white; padding: 5px; border-radius: 5px;">Học
                                                sinh</span>
                                        @else
                                            <span
                                                style="background-color: #9E9E9E; color: white; padding: 5px; border-radius: 5px;">Không
                                                xác định</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->status == 0)
                                            <span
                                                style="background-color: #4CAF50; color: white; padding: 5px; border-radius: 5px;">Hoạt
                                                động</span>
                                        @elseif ($item->status == 1)
                                            <span
                                                style="background-color: #f44336; color: white; padding: 5px; border-radius: 5px;">Ngừng
                                                hoạt động</span>
                                        @else
                                            <span
                                                style="background-color: #9E9E9E; color: white; padding: 5px; border-radius: 5px;">Không
                                                xác định</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Xem chi tiết">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Chỉnh sửa"
                                                wire:click="openPopup('edit', {{ $item->id }})">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            @if ($item->role->id == 1)
                                                <a class="bg-primary text-white" data-toggle="tooltip"
                                                    title="Không thể xóa người quản trị">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            @else
                                                <a class="bg-primary text-white" data-toggle="tooltip" title="Xóa"
                                                    wire:click.prevent="openPopup('delete', {{ $item->id }})">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">Không tìm thấy tài khoản người dùng nào.</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            <div class="text-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- them nguoi dung --}}
    <div class="modal {{ $isAddPopupOpen ? 'is-open' : '' }}" id="addCourseCateModal" wire:click="closePopup()">
        <div class="modal-overlay"></div>
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
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Tên tài khoản:</label>
                                        <input wire:model="name" type="text" class="form-control"
                                            placeholder="Nhập tên tài khoản...">
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu:</label>
                                        <input wire:model="password" type="password" class="form-control"
                                            placeholder="Nhập mật khẩu...">
                                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Giới tính:
                                            <a data-toggle="tooltip"
                                                title="Nếu là tài khoản học sinh thì không cần chọn giới tính">
                                                <i class="ri-information-line"></i>
                                            </a>
                                        </label>
                                        <select class="form-control" wire:model="sex">
                                            <option value="">Chọn giới tính</option>
                                            <option value="1">Thầy</option>
                                            <option value="2">Cô</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Ảnh tài khoản:</label>
                                        <br>
                                        <div class="custom-file" style="display: contents">
                                            @if ($image_url)
                                                <img id="image-placeholder" src="{{ $image_url->temporaryUrl() }}"
                                                    alt="Click to choose image" class="img-thumbnail"
                                                    style="cursor: pointer; width: 100%;"
                                                    name="image_url">
                                            @else
                                                <img id="image-placeholder"
                                                    src="{{ asset('assets/images/book/user/thub.jpg') }}"
                                                    alt="Click to choose image" class="img-thumbnail"
                                                    style="cursor: pointer; width: 100%;">
                                            @endif
                                            <input type="file" class="custom-file-input"
                                                accept="image/png, image/jpeg, image/jpg" wire:model="image_url"
                                                id="image-input" style="display: none;">
                                        </div>
                                        @error('image_url') <span class="text-danger">{{ $message }}</span> @enderror
                                        <script>
                                            document.getElementById('image-placeholder').addEventListener('click', function() {
                                                document.getElementById('image-input').click();
                                            });
                                        </script>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Phone:</label>
                                        <input wire:model="phone" type="number" class="form-control"
                                            placeholder="Nhập số điện thoại...">
                                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input wire:model="email" type="text" class="form-control"
                                            placeholder="Nhập email...">
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Vai trò:</label>
                                        <select class="form-control" wire:model="role_id">
                                            <option value="1">Admin</option>
                                            <option value="2">Giáo viên</option>
                                            <option value="3">Học sinh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Trạng thái:</label>
                                        <select class="form-control" wire:model="status">
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
                            <button type="reset" class="btn btn-danger">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- sua nguoi dung --}}
    <div class="modal {{ $isEditPopupOpen ? 'is-open' : '' }}" id="isEditPopupOpen" wire:click="closePopup()">
        <div class="modal-overlay"></div>
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
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Tên tài khoản:</label>
                                        <input wire:model="nameAdd" type="text" class="form-control"
                                            placeholder="Nhập tên tài khoản...">
                                            @error('nameAdd') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Ảnh tài khoản:</label>
                                        <div class="row p-0 m-0">
                                            <div class="{{ $image_urlAdd || $newImg ? 'col-12' : 'col-12' }}">
                                                <input wire:model="newImg" type="file" class="custom-file-input"
                                                    id="customFile" accept="image/*" onchange="updateFileName()">
                                                <label class="custom-file-label" for="customFile">
                                                    @if ($newImg)
                                                        {{ $newImg->getClientOriginalName() }}
                                                    @else
                                                        Chọn tập tin
                                                    @endif
                                                </label>
                                                <p></p>
                                                @error('newImg') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Hình ảnh:</label>
                                        <div class="{{ $image_urlAdd || $newImg ? 'col-12' : 'col-12' }}">
                                            @if ($newImg)
                                                <img src="{{ $newImg->temporaryUrl() }}" alt="Ảnh đại diện"
                                                    style="max-height: 150px;" class="img-fluid">
                                            @elseif ($image_urlAdd && is_string($image_urlAdd))
                                                <img src="{{ $image_urlAdd }}" alt="Ảnh đại diện"
                                                    style="max-height: 150px;" class="img-fluid">
                                            @else
                                                <img src="{{ asset('assets/images/book/user/thub.jpg') }}"
                                                    alt="Ảnh mặc định" style="max-height: 150px;" class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Mật khẩu:</label>
                                        <input wire:model="passwordAdd" type="password" class="form-control"
                                            placeholder="Nhập mật khẩu...">
                                            @error('passwordAdd') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Giới tính:
                                            <a data-toggle="tooltip"
                                                title="Nếu là tài khoản học sinh thì không cần chọn giới tính">
                                                <i class="ri-information-line"></i>
                                            </a>
                                        </label>
                                        <select class="form-control" wire:model="sexAdd">
                                            <option value="">Chọn giới tính</option>
                                            <option value="1">Thầy</option>
                                            <option value="2">Cô</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input wire:model="emailAdd" type="text" class="form-control"
                                            placeholder="Nhập email...">
                                            @error('emailAdd') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Phone:</label>
                                        <input wire:model="phoneAdd" type="number" class="form-control"
                                            placeholder="Nhập sdt...">
                                            @error('phoneAdd') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Vai trò:</label>
                                        <select wire:model="role_idAdd" class="form-control"
                                            @if ($role_idAdd == 1) disabled @endif>
                                            <option value="">Chọn vai trò</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Giáo viên</option>
                                            <option value="3">Học sinh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Trạng thái:</label>
                                        <select wire:model="statusAdd" class="form-control"
                                            @if ($role_idAdd == 1) disabled @endif>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="reset" class="btn btn-danger">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup xóa danh mục -->
    <div class="modal {{ $isDeletePopupOpen ? 'is-open' : '' }}" id="deletedCourseCateModal"
        wire:click="closePopup()">
        <div class="modal-overlay"></div>
        <div class="modal-content" style="width: 30%;" wire:click.stop>
            <div class="col-12 text-center p-0">
                <div class="col-sm-12 p-0">
                    <div class="iq-card mb-0">
                        <div class="iq-card-header p-0">
                            <div class="iq-header-title">
                                <h4 class="card-title">Bạn có chắc chắn xóa tài khoản này hay không?</h4>
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
