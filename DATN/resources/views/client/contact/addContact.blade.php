@extends('layouts.client.client')

@section('title', 'Gửi liên hệ')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header">
                        <div class="iq-header-title">
                            <h4 class="card-title">Gửi liên hệ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <!-- Hiển thị thông báo nếu có -->
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('storeContact') }}">
                            @csrf
                            <div class="form-group">
                                <label>Tên của bạn:</label>
                                <input type="text" name="name" class="form-control" 
                                    value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" 
                                    placeholder="Nhập tên của bạn" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" 
                                    value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" 
                                    placeholder="Nhập email của bạn" required>
                            </div>
                            <div class="form-group">
                                <label>Nội dung:</label>
                                <textarea name="message" class="form-control" rows="4" 
                                    placeholder="Nhập nội dung..." required>{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                            <button type="reset" class="btn btn-danger">Xóa</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
