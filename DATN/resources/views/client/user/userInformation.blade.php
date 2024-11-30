@extends('layouts.client.client')

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
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-body p-0">
                    <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                            @if (Auth::check() && Auth::user()->role_id == 1)
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
                                    <a class="nav-link" data-toggle="pill" href="#reset-pwd">
                                        Quên mật khẩu
                                    </a>
                                </li>
                            @else
                                <li class="col-md-3 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information1">
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang1-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#reset1-pwd">
                                        Quên mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-3 p-0">
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
                    @if (Auth::check() && Auth::user()->role_id == 1)
                        {{-- thông tin người dùng --}}
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <livewire:client.user.profile-user />
                        </div>
                        {{-- đổi mật khẩu --}}
                        <div class="tab-pane fade  show" id="chang-pwd" role="tabpanel">
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
                                            {{-- <a href="javascript:void(0);" class="float-right">Quên mật khẩu</a> --}}
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
                        <!-- Tab Reset mật khẩu -->
                        <div class="tab-pane fade" id="reset-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Quên mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <!-- Form gửi mã OTP -->
                                    <form action="{{ route('send-otp') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Nhập email của bạn" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi mã OTP</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>

                                    <form action="{{ route('verify-otp') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ isset($email) ? $email : '' }}">
                                        <div class="form-group">
                                            <label for="otp">Mã xác thực 6 số:</label>
                                            <input type="text" class="form-control" id="otp" name="otp"
                                                maxlength="6" placeholder="Nhập mã xác thực" required>
                                        </div>
                                    </form>

                                    {{-- mật khẩu mới --}}
                                    <form method="POST" action="{{ route('change-password') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password_confirmation">Nhập lại mật khẩu mới</label>
                                            <input type="password" name="new_password_confirmation"
                                                id="new_password_confirmation" class="form-control" required>
                                        </div>

                                        <input type="hidden" name="email" value="{{ session('email') }}">

                                        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                                    </form>

                                    <!-- Form thay đổi mật khẩu -->
                                    <form action="{{ route('change-password') }}" method="POST" style="display: none;">
                                        @csrf
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password" placeholder="Nhập mật khẩu mới" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password_confirmation">Xác nhận mật khẩu:</label>
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Đổi mật khẩu</button>
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
                        <div class="tab-pane fade active show" id="personal-information1" role="tabpanel">
                            <livewire:client.user.profile-user />
                        </div>
                        {{-- đổi mật khẩu người dùng --}}
                        <div class="tab-pane fade show" id="chang1-pwd" role="tabpanel">
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
                                            {{-- <a href="javascript:void(0);" class="float-right">Quên mật khẩu</a> --}}
                                            <input type="password" class="form-control" id="cpass" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass"
                                                name="new_password">
                                        </div>
                                        <div class="form-group">
                                            <label for="vpass">Xác nhận lại mật khẩu:</label>
                                            <input type="password" class="form-control" id="vpass"
                                                name="new_password_confirmation">
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Reset mật khẩu -->
                        <div class="tab-pane fade" id="reset1-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Quên mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <!-- Form gửi mã OTP -->
                                    <form action="{{ route('send-otp') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Nhập email của bạn" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Gửi mã OTP</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>

                                    <form action="{{ route('verify-otp') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ isset($email) ? $email : '' }}">
                                        <div class="form-group">
                                            <label for="otp">Mã xác thực 6 số:</label>
                                            <input type="text" class="form-control" id="otp" name="otp"
                                                maxlength="6" placeholder="Nhập mã xác thực" required>
                                        </div>
                                    </form>

                                    {{-- mật khẩu mới --}}
                                    <form method="POST" action="{{ route('change-password') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password_confirmation">Nhập lại mật khẩu mới</label>
                                            <input type="password" name="new_password_confirmation"
                                                id="new_password_confirmation" class="form-control" required>
                                        </div>

                                        <input type="hidden" name="email" value="{{ session('email') }}">

                                        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                                    </form>
                                    <!-- Form thay đổi mật khẩu -->
                                    <form action="{{ route('change-password') }}" method="POST" style="display: none;">
                                        @csrf
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password" placeholder="Nhập mật khẩu mới" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password_confirmation">Xác nhận mật khẩu:</label>
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Đổi mật khẩu</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- lịch sử đơn hàng --}}

                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                            <div class="container-fluid">
                                <livewire:client.order.PaidOrders />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
