<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Thông tin cá nhân</h4>
        </div>
    </div>
    <div class="iq-card-body">
        <form wire:submit.prevent="updateProfile">
            <div class="form-group row align-items-center">
                <div class="col-md-12">
                    <div class="profile-img-edit">
                        @if ($image && is_string($image))
                            <img class="rounded-circle img-thumbnail"
                                style="width:150px; height:150px"src="{{ $image }}" alt="profile-pic">
                        @elseif ($image != '')
                            <img class="rounded-circle img-thumbnail"
                                style="width:150px; height:150px"src="{{ $image->temporaryUrl() }}" alt="profile-pic">
                        @else
                            <img class="rounded-circle img-thumbnail" style="width:150px; height:150px"
                                src="{{ asset('assets/images/book/user_thumbnail.png') }}" alt="profile-pic">
                        @endif
                        <div class="p-image">
                            <i class="ri-pencil-line upload-button"></i>
                            <input wire:model="image" class="file-upload" type="file" accept="image/*" />
                        </div>
                    </div>
                </div>
            </div>
            <div class=" row align-items-center">
                <div class="form-group col-sm-6">
                    <label for="fname">Họ và tên:</label>
                    <input wire:model="name" type="text" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    <label for="lname">Số điện thoại:</label>
                    <input wire:model="phone" type="text" class="form-control">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    <label for="uname">Email:</label>
                    <input wire:model="email" type="text" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    <label>Giới tính:</label>
                    <div>
                        <input wire:model="gender" type="radio" id="male" value="0">
                        <label for="male">Nam</label>
                    </div>
                    <div>
                        <input wire:model="gender" type="radio" id="female" value="1">
                        <label for="female">Nữ</label>
                    </div>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Xác nhận</button>
            <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
        </form>
    </div>
</div>
