@extends('layouts.client.client')

@section('title', 'Gửi liên hệ')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header ">
                        <div class="iq-header-title">
                            <h4 class="card-title">Gửi liên hệ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <!-- Hiển thị thông báo nếu có -->
                        {{-- @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif --}}
                        @auth
                            <form method="POST" action="{{ route('storeContact') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Tên tài khoản:</label>
                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="Nhập nội dung..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                                <button type="reset" class="btn btn-danger">Trở lại</button>
                            </form>
                        @else
                            <div class="alert alert-warning">
                                <strong>Vui lòng <a href="{{ route('handleLogin') }}">đăng nhập</a> để gửi liên hệ.</strong>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
