@extends('layouts.admin.admin')

@section('title', 'Thông Tin Tài khoản')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-body p-0">
                    <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                            @if (Auth::user()->role_id == 1)
                                <li class="col-md-6 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-6 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                        Lịch sử đơn hàng
                                    </a>
                                </li>
                            @else
                                <li class="col-md-4 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                        Lịch sử đơn hàng
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    @if (Auth::user()->role_id == 1)
                        {{-- đổi mật khẩu --}}
                        <div class="tab-pane fade active show" id="chang-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Đổi mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <form action="{{ route('userInfo') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cpass">Mật khẩu hiện tại:</label>
                                            <a href="javascript:void(0);" class="float-right">Quên mật khẩu</a>
                                            <input type="password" class="form-control" id="cpass" name="password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass" name="new_password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="vpass">Xác nhận lại mật khẩu:</label>
                                            <input type="password" class="form-control" id="vpass"
                                                name="new_password_confirmation" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- lịch sử đơn hàng --}}
                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Lịch Sử Đơn Hàng</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">

                                </div>
                            </div>
                        </div>
                    @else
                        {{-- thông tin người dùng --}}
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Thông tin cá nhân</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <form>
                                        <div class="form-group row align-items-center">
                                            <div class="col-md-12">
                                                <div class="profile-img-edit">
                                                    <img class="profile-pic"
                                                        src="{{ asset('assets/images/book/user/1.jpg') }}"
                                                        alt="profile-pic">
                                                    <div class="p-image">
                                                        <i class="ri-pencil-line upload-button"></i>
                                                        <input class="file-upload" type="file" accept="image/*" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row align-items-center">
                                            <div class="form-group col-sm-6">
                                                <label for="fname">Họ và tên:</label>
                                                <input type="text" class="form-control" id="fname" value="Ông">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="lname">Số điện thoại:</label>
                                                <input type="text" class="form-control" id="lname"
                                                    value="Trần Thuận">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="uname">Email:</label>
                                                <input type="text" class="form-control" id="uname"
                                                    value="Thuangiaosu">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cname">Ngày sinh:</label>
                                                <input type="date" class="form-control" id="cname"
                                                    value="TV Team">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Tỉnh thành:</label>
                                                <input class="form-control" id="dob" value="1984-01-24">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Quận:</label>
                                                <input class="form-control" id="dob" value="1984-01-24">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Huyện:</label>
                                                <input class="form-control" id="dob" value="1984-01-24">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Xã:</label>
                                                <input class="form-control" id="dob" value="1984-01-24">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label>Ghi chú thêm địa chỉ:</label>
                                                <textarea class="form-control" name="address" rows="5" style="line-height: 22px;">06 Nam Thành Đà Nãng, VA 23803 Viet Nam Zip Code: 40001
                                       </textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Xác nhận</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- đổi mật khẩu --}}
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Đổi mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="cpass">Mật khẩu hiện tại:</label>
                                            <a href="javascripe:void();" class="float-right">Quên mật khẩu</a>
                                            <input type="Password" class="form-control" id="cpass" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="Password" class="form-control" id="npass" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="vpass">Xác nhận lại mật khẩu:</label>
                                            <input type="Password" class="form-control" id="vpass" value="">
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- lịch sử đơn hàng --}}
                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Lịch Sử Đơn Hàng</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
