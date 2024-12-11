@extends('layouts.client.client')

@section('title', 'Thông Tin Tài khoản')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
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
                                <li class="col-md-6 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="col-md-6 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                            @else
                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang1-pwd">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                                <li class="col-md-4 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal1-information">
                                        Thông tin cá nhân
                                    </a>
                                </li>

                                <li class="col-md-4 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#manage1-contact">
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
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
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

                                            <input type="password" class="form-control" id="cpass" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass" name="new_password">
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
                        {{-- thông tin người dùng --}}
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <livewire:client.user.profile-user />
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
                        <div class="tab-pane fade " id="personal1-information" role="tabpanel">
                            <livewire:client.user.profile-user />
                        </div>
                        {{-- đổi mật khẩu người dùng --}}
                        <div class="tab-pane fade active show" id="chang1-pwd" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Đổi mật khẩu</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body ">

                                    <form action="{{ route('userInfo') }}" method="POST">
                                        @csrf
                                        {{-- Mật khẩu hiện tại --}}
                                        <div class="form-group">
                                            <label for="cpass">Mật khẩu hiện tại:</label>
                                            <input type="password" class="form-control" id="cpass" name="password">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Mật khẩu mới --}}
                                        <div class="form-group">
                                            <label for="npass">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="npass" name="new_password">
                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Xác nhận mật khẩu mới --}}
                                        <div class="form-group">
                                            <label for="vpass">Xác nhận mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="vpass"
                                                name="new_password_confirmation">
                                            @error('new_password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Nút gửi và hủy --}}
                                        <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                                        <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        {{-- lịch sử đơn hàng --}}
                        <div class="tab-pane fade" id="manage1-contact" role="tabpanel">
                            <div class="container-fluid">
                                <livewire:client.order.PaidOrders />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
