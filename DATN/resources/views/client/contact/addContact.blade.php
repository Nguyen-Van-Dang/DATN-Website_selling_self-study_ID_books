@extends('layouts.client.client')

@section('title', 'Gửi liên hệ')

@section('content')

    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div class="iq-card-header" style="background-image: url('{{ asset('assets/images/book/contact.jpg') }}'); background-size: cover; height: 200px;">
                            <h4 class="card-title text-center text-white d-flex justify-content-center align-items-center" style="height: 20%; padding-top: 4%">Liên hệ</h4>
                            {{-- <p class="text-center text-white">Trang chủ > <span class="text-primary">Liên hệ</span></p> --}}
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-5">
                                <form method="POST" action="{{ route('storeContact') }}" class="pt-2">
                                    <div class="iq-card-header">
                                        <div class="row mb-2 align-items-center">
                                            <div class="col-auto">
                                                <i class="ri-map-pin-line"></i>
                                            </div>
                                            <div class="col">
                                                <span>Toà nhà FPT Polytechnic, Đ. Số 22, Cái Răng, Cần Thơ</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <div class="col-auto">
                                                <i class="ri-phone-line"></i>
                                            </div>
                                            <div class="col">
                                                <span>+84 123 456 789</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                            <div class="col">
                                                <span>infobookstorefpt@gmail.com</span>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="pt-4">
                                        <h4 class="card-title">Liên hệ với chúng tôi</h4>
                                    </div>
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}"
                                            placeholder="Nhập tên của bạn" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                            placeholder="Nhập email của bạn" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" rows="3" placeholder="Nhập nội dung..." required>{{ old('message') }}</textarea>
                                    </div>
                                    <button type="submit" class="btnn uppercase-text">Gửi liên hệ</button>

                                </form>
                            </div>
                            <div class="col-7 d-flex justify-content-center align-items-center">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1652.116479708264!2d105.75866936439999!3d9.98234243243272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08906415c355f%3A0x416815a99ebd841e!2sFPT%20Polytechnic%20College!5e0!3m2!1sen!2s!4v1732861415732!5m2!1sen!2s"
                                    width="800" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .form-control {
            height: 55px;
            border-radius: 25px;
        }
    </style>
@endsection
