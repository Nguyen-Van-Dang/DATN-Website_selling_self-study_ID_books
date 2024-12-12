<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .imgg>img {
            position: absolute;
            width: 1000px;
            height: 550px;
            left: 90px;
            top: 160px;
        }

        input {
            outline: none;
        }

        .wave {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 100%;
            z-index: -1;
        }

        * {
            overflow: auto;
            scrollbar-width: none;
        }

        body {
            color: #333;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1.5s ease-out, transform 1.5s ease-out;
            height: 100vh;
        }

        body.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            margin-top: 10%;
            position: absolute;
            width: 100%;
            right: 20%;
            border: none;
        }

        .card-header {
            background: #0DD6B8;
            text-align: center;
            position: relative;
            color: white;
        }

        .card-header h4 {
            font-weight: bold;
            margin: 0;
        }

        img {
            display: block;
            margin: 10px auto 0;
            width: 160px;
            height: 120px;
        }

        .anh {
            width: 70px;
            height: 50px;
        }

        .card-body {
            padding: 10px 10px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 10px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #0DD6B8;
        }

        .btn {
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-primary,
        .btn-success {
            background: #0DD6B8;
            border: none;
        }

        .btn-primary:hover,
        .btn-success:hover {
            transform: scale(1);
        }

        .step-form {
            display: none;
        }

        .step-form.active {
            display: block;
        }

        .header-bar {
            background-color: #0DD6B8;
            padding: 10px 20px;
        }

        .left {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .anh {
            width: 40px;
            height: 40px;
        }

        .right {
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .btn-primary {
            border-radius: 30px;
            font-size: 20px;
            padding: 15px;
        }

        .btn-primary:hover {
            background-color: #0aa18b;
            transform: scale(1);
        }

        .nav-button {
            margin-left: auto;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            text-decoration: none;
            color: #333;
        }

        .back-button:hover {
            color: #0aa18b;
        }

        .form-control {
            padding: .800rem .75rem;
        }
    </style>
</head>

<body>
    <div class="right d-flex align-items-center p-4">
        <a href="{{ route('homeClient') }}" class="float-end back-button"><i class="ri-arrow-left-line"></i> <b>Trở
                về</b></a>
    </div>
    <img class="wave" src="{{ asset('assets/images/book/wave.png') }}" style="width: 730px;">
    <div class="container">
        <div class="imgg">
            <img src="{{ asset('assets/images/book/bg.svg') }}">
        </div>
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <img width="150px" src="{{ asset('assets/images/book/icon/big_logo.png') }}" alt="Logo">
                <!-- Form 1: Gửi email -->
                <form id="form-email" action="{{ route('send-otp') }}" method="POST" class="step-form active">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Nhập email của bạn" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Gửi mã OTP</button>
                </form>

                <!-- Form 2: Nhập OTP -->
                <form id="form-otp" action="{{ route('verify-otp') }}" method="POST" class="step-form">
                    @csrf
                    <div class="mb-3">
                        <label for="otp" class="form-label">Mã OTP</label>
                        <input type="text" class="form-control @error('otp') is-invalid @enderror" id="otp"
                            name="otp" placeholder="Nhập mã OTP" required>
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        @error('otp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100"
                        style="    border-radius: 30px;
    font-size: 20px;
    padding: 15px;">Xác minh OTP</button>
                </form>

                <!-- Form 3: Nhập mật khẩu mới -->
                <form id="form-password" action="{{ route('change-password') }}" method="POST" class="step-form">
                    @csrf
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Mật khẩu mới:</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                            id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" required>
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu:</label>
                        <input type="password" class="form-control" id="new_password_confirmation"
                            name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"
                        style="    border-radius: 30px;
    font-size: 20px;
    padding: 15px;">Đặt lại mật
                        khẩu</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hiệu ứng từ từ hiện ra
            document.body.classList.add('loaded');

            // Điều hướng giữa các bước form
            const forms = {
                email: document.getElementById("form-email"),
                otp: document.getElementById("form-otp"),
                password: document.getElementById("form-password"),
            };

            @if (session('step') === 'otp')
                forms.email.classList.remove("active");
                forms.otp.classList.add("active");
            @elseif (session('step') === 'password')
                forms.email.classList.remove("active");
                forms.otp.classList.remove("active");
                forms.password.classList.add("active");
            @endif
        });
    </script>
</body>

</html>
