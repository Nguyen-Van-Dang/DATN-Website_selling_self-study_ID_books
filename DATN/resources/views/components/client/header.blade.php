{{-- {{dd(Auth::id());}} --}}
<div class="iq-navbar-custom">
    <nav class="navbar navbar-expand-lg navbar-light p-0 ">
        <div class="iq-menu-bt d-flex align-items-center">
            <div class="wrapper-menu">
                <div class="main-circle"><i class="las la-bars"></i></div>
            </div>
            <div class="iq-navbar-logo d-flex justify-content-between">
                <a href="{{ route('homeClient') }}" class="header-logo">
                    <div class="logo-title">
                        <span class="text-primary text-uppercase">
                            <img src="{{ asset('assets/images/book/icon/big_logo.png') }}" alt="">
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <div class="d-flex nav-menu">
            <div class="navbar-breadcrumb px-3 {{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ route('homeClient') }}" class="iq-waves-effect text-gray rounded">
                    <h6 class="mb-0">Trang Chủ</h6>
                </a>
            </div>
            <div class="navbar-breadcrumb px-3 {{ Request::is('book-list') ? 'active' : '' }}">
                <a href="{{ route('bookList') }}" class="iq-waves-effect rounded">
                    <h6 class="mb-0">Sách</h6>
                </a>
            </div>
            <div class="navbar-breadcrumb px-3 {{ Request::is('khoa-hoc') ? 'active' : '' }}">
                <a href="{{ route('khoa-hoc.index') }}" class="iq-waves-effect rounded">
                    <h6 class="mb-0">Khóa học</h6>
                </a>
            </div>
            <div class="navbar-breadcrumb px-3 {{ Request::is('hoc-tap') ? 'active' : '' }}">
                <a href="{{ route('hoc-tap') }}" class="iq-waves-effect  rounded">
                    <h6 class="mb-0">Học tập</h6>
                </a>
            </div>
            <div class="navbar-breadcrumb px-3 {{ Request::is('chat') ? 'active' : '' }}">
                <a href="{{ route('chat') }}" class="iq-waves-effect  rounded">
                    <h6 class="mb-0">Tin nhắn</h6>
                </a>
            </div>
            <div class="navbar-breadcrumb px-3 {{ Request::is('reels') ? 'active' : '' }}">
                <a href="{{ route('reals') }}" class="iq-waves-effect  rounded">
                    <h6 class="mb-0">Reels</h6>
                </a>
            </div>
            <div class="navbar-breadcrumb px-3">
                <a href="#" class="iq-waves-effect  rounded">
                    <h6 class="mb-0">Đề thi</h6>
                </a>
            </div>
        </div>
        <div class="nav-button" style="margin-left: auto">
            <a href="{{ route('kich-hoat-sach') }}" class="btn btn-primary float-end"> <b>Kích hoạt ID Sách
                    !</b></a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list">
                {{-- <li class="nav-item nav-icon search-content">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-search-line"></i>
                    </a>
                    <form action="#" class="search-box p-0">
                        <input type="text" class="text search-input" placeholder="Type here to search...">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                    </form>
                </li> --}}

                {{-- notification --}}
                <li class="nav-item nav-icon">
                    <a href="notification-list" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-notification-2-line"></i>
                        <span class="bg-primary dots"></span>
                    </a>
                    <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">Thông Báo<small
                                            class="badge  badge-light float-right pt-1">4</small></h5>
                                </div>
                                <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                        <div class="">
                                            <img class="avatar-40 rounded"
                                                src="{{ asset('assets/images/book/user/3.jpg') }}" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0">Đơn hàng giao thành công</h6>
                                            <small class="float-right font-size-12">Ngay bây giờ</small>
                                            <p class="mb-0">95.000đ</p>

                                        </div>

                                    </div>
                                </a>
                                <div class="text-center ">
                                    <p>
                                        <a href="{{ route('notificationList') }}">Tất cả thông báo</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
                {{-- mess --}}
                <li class="nav-item nav-icon dropdown">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-mail-line"></i>
                        <span class="bg-primary dots"></span>
                    </a>
                    <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">Tin Nhắn<small
                                            class="badge  badge-light float-right pt-1">5</small></h5>
                                </div>
                                <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                        <div class="">
                                            <img class="avatar-40 rounded"
                                                src="{{ asset('assets/images/book/user/4.jpg') }}" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">QT Shop</h6>
                                            <small class="float-left font-size-12">9/9/2024</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-center ">
                                    <p>
                                        {{-- <a href="{{ route('messageList') }}">Tất cả tin nhắn</a> --}}
                                        <a href="">Tất cả tin nhắn</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- cart --}}
                <li class="nav-item nav-icon dropdown">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span class="badge badge-danger count-cart rounded-circle">{{ $cartCount }}</span>
                    </a>
                    <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 toggle-cart-info">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">Giỏ Hàng<small
                                            class="badge badge-light float-right pt-1">{{ $cartCount }}</small>
                                    </h5>
                                </div>
                                @foreach ($cartItems as $item)
                                    <a href="" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div>
                                                <img class="rounded"
                                                    src="{{ asset('assets/images/book/book/02.jpg') }}"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">Tên: {{ $item->book->name }}</h6>
                                                <p class="mb-0">Giá: ${{ $item->book->price * $item->quantity }}</p>
                                                <p class="mb-0">Số Lượng: {{ $item->quantity }}</p>
                                            </div>
                                            <div class="float-right font-size-24 text-danger">
                                                <i class="ri-close-fill"
                                                    onclick="removeFromCart({{ $item->id }})"
                                                    style="cursor: pointer;"></i>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="align-items-center text-center p-3">
                                    <a class="btn btn-primary iq-sign-btn" href="{{ route('shoppingCart') }}"
                                        role="button">Giỏ Hàng</a>
                                    <a class="btn btn-primary iq-sign-btn" href="{{ route('shoppingCart') }}"
                                        role="button">Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- reels --}}
                @if (auth()->check() && in_array(Auth::user()->role_id, [1, 2]))
                    <li class="nav-item nav-icon dropdown">
                        <a href="{{ route('reelsUpload') }}" class="text-gray rounded">
                            <i class="ri-upload-cloud-line"></i>
                            {{-- <span class="badge badge-danger count-cart rounded-circle">2</span> --}}
                        </a>
                    </li>
                @endif
                {{-- user --}}
                @if (auth()->check())
                    <li class="line-height pt-3">
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                            <img src="{{ asset('assets/images/book/user/1.jpg') }}"
                                class="img-fluid rounded-circle mr-3" alt="user">
                            <div class="caption"
                                @php
$userName = Auth::user()->name;
                                    $displayName = Str::limit($userName, 10, '...'); @endphp>
                                <h6 class="mb-1 line-height">{{ $displayName }}!</h6>
                                <p class="mb-0 text-primary">Tài Khoản</p>
                            </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white line-height">Xin Chào {{ auth()->user()->name }}
                                        </h5>
                                    </div>
                                    @if (Auth::user()->role_id == 1)
                                        <a href="{{ route('userDetail') }}" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Tài khoản của tôi</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="{{ route('homeAdmin') }}" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-shield-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Vào trang quản trị</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif (Auth::user()->role_id == 2)
                                        <a href="{{ route('userDetail') }}" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Tài khoản của tôi</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="{{ route('userInformation') }}"
                                            class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-profile-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Sửa thông tin</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="{{ route('homeAdmin') }}" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-shield-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Vào trang quản trị</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-account-box-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Đơn hàng của tôi</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{ route('userDetail') }}" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Tài khoản của tôi</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="{{ route('userInformation') }}"
                                            class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-profile-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Sửa thông tin</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="{{ route('kich-hoat-sach') }}"
                                            class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-key-2-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Kích hoạt sách ID</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-account-box-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Đơn hàng của tôi</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-heart-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0">Yêu Thích</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    <div class="d-inline-block w-100 text-center p-3">
                                        <a class="bg-primary iq-sign-btn" href="{{ route('logout') }}"
                                            role="button">
                                            Sign out<i class="ri-login-box-line ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    <li class="line-height pt-2">
                        <button id="open-popup-btn" class="btnn">Đăng Nhập</button>
                        <div class="popup-overlay"></div>
                        <div id="popup" class="popup" style="margin-top:10%">
                            <div class="popup-content">
                                <a id="close-popup-btn" class="close-btn">x</a>
                                <div class="container">
                                    <div class="forms-container">
                                        <div class="signin-signup">
                                            {{-- Đăng nhập --}}
                                            <form method="post" action="{{ route('handleLogin') }}"
                                                class="sign-in-form">
                                                @csrf
                                                @if ($errors->has('login'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('login') }}
                                                    </div>
                                                @endif
                                                <h2 class="title" style="margin-left: 50px">Đăng nhập</h2>
                                                <div class="input-field">
                                                    <i class="fas fa-phone"></i>
                                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                                        placeholder="Số điện thoại" />
                                                    @error('phone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="input-field">
                                                    <i class="fas fa-lock"></i>
                                                    <input type="password" name="password"
                                                        value="{{ old('password') }}" placeholder="Mật khẩu" />
                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="">
                                                    <center>
                                                        <button class="btnn" type="submit">Đăng Nhập</button>
                                                    </center>
                                                </div>
                                                <p class="social-text" style="margin-left: 50px">Hoặc các mạng xã hội
                                                    khác</p>
                                                <div class="social-media">
                                                    <a href="{{ route('login-by-facebook') }}" class="social-icon">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                    <a href="#" class="social-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                            width="100" height="30px" viewBox="0 0 50 50">
                                                            <path
                                                                d="M 9 4 C 6.2504839 4 4 6.2504839 4 9 L 4 41 C 4 43.749516 6.2504839 46 9 46 L 41 46 C 43.749516 46 46 43.749516 46 41 L 46 9 C 46 6.2504839 43.749516 4 41 4 L 9 4 z M 9 6 L 15.580078 6 C 12.00899 9.7156859 10 14.518083 10 19.5 C 10 24.66 12.110156 29.599844 15.910156 33.339844 C 16.030156 33.549844 16.129922 34.579531 15.669922 35.769531 C 15.379922 36.519531 14.799687 37.499141 13.679688 37.869141 C 13.249688 38.009141 12.97 38.430859 13 38.880859 C 13.03 39.330859 13.360781 39.710781 13.800781 39.800781 C 16.670781 40.370781 18.529297 39.510078 20.029297 38.830078 C 21.379297 38.210078 22.270625 37.789609 23.640625 38.349609 C 26.440625 39.439609 29.42 40 32.5 40 C 36.593685 40 40.531459 39.000731 44 37.113281 L 44 41 C 44 42.668484 42.668484 44 41 44 L 9 44 C 7.3315161 44 6 42.668484 6 41 L 6 9 C 6 7.3315161 7.3315161 6 9 6 z M 33 15 C 33.55 15 34 15.45 34 16 L 34 25 C 34 25.55 33.55 26 33 26 C 32.45 26 32 25.55 32 25 L 32 16 C 32 15.45 32.45 15 33 15 z M 18 16 L 23 16 C 23.36 16 23.700859 16.199531 23.880859 16.519531 C 24.050859 16.829531 24.039609 17.219297 23.849609 17.529297 L 19.800781 24 L 23 24 C 23.55 24 24 24.45 24 25 C 24 25.55 23.55 26 23 26 L 18 26 C 17.64 26 17.299141 25.800469 17.119141 25.480469 C 16.949141 25.170469 16.960391 24.780703 17.150391 24.470703 L 21.199219 18 L 18 18 C 17.45 18 17 17.55 17 17 C 17 16.45 17.45 16 18 16 z M 27.5 19 C 28.11 19 28.679453 19.169219 29.189453 19.449219 C 29.369453 19.189219 29.65 19 30 19 C 30.55 19 31 19.45 31 20 L 31 25 C 31 25.55 30.55 26 30 26 C 29.65 26 29.369453 25.810781 29.189453 25.550781 C 28.679453 25.830781 28.11 26 27.5 26 C 25.57 26 24 24.43 24 22.5 C 24 20.57 25.57 19 27.5 19 z M 38.5 19 C 40.43 19 42 20.57 42 22.5 C 42 24.43 40.43 26 38.5 26 C 36.57 26 35 24.43 35 22.5 C 35 20.57 36.57 19 38.5 19 z M 27.5 21 C 27.39625 21 27.29502 21.011309 27.197266 21.03125 C 27.001758 21.071133 26.819727 21.148164 26.660156 21.255859 C 26.500586 21.363555 26.363555 21.500586 26.255859 21.660156 C 26.148164 21.819727 26.071133 22.001758 26.03125 22.197266 C 26.011309 22.29502 26 22.39625 26 22.5 C 26 22.60375 26.011309 22.70498 26.03125 22.802734 C 26.051191 22.900488 26.079297 22.994219 26.117188 23.083984 C 26.155078 23.17375 26.202012 23.260059 26.255859 23.339844 C 26.309707 23.419629 26.371641 23.492734 26.439453 23.560547 C 26.507266 23.628359 26.580371 23.690293 26.660156 23.744141 C 26.819727 23.851836 27.001758 23.928867 27.197266 23.96875 C 27.29502 23.988691 27.39625 24 27.5 24 C 27.60375 24 27.70498 23.988691 27.802734 23.96875 C 28.487012 23.82916 29 23.22625 29 22.5 C 29 21.67 28.33 21 27.5 21 z M 38.5 21 C 38.39625 21 38.29502 21.011309 38.197266 21.03125 C 38.099512 21.051191 38.005781 21.079297 37.916016 21.117188 C 37.82625 21.155078 37.739941 21.202012 37.660156 21.255859 C 37.580371 21.309707 37.507266 21.371641 37.439453 21.439453 C 37.303828 21.575078 37.192969 21.736484 37.117188 21.916016 C 37.079297 22.005781 37.051191 22.099512 37.03125 22.197266 C 37.011309 22.29502 37 22.39625 37 22.5 C 37 22.60375 37.011309 22.70498 37.03125 22.802734 C 37.051191 22.900488 37.079297 22.994219 37.117188 23.083984 C 37.155078 23.17375 37.202012 23.260059 37.255859 23.339844 C 37.309707 23.419629 37.371641 23.492734 37.439453 23.560547 C 37.507266 23.628359 37.580371 23.690293 37.660156 23.744141 C 37.739941 23.797988 37.82625 23.844922 37.916016 23.882812 C 38.005781 23.920703 38.099512 23.948809 38.197266 23.96875 C 38.29502 23.988691 38.39625 24 38.5 24 C 38.60375 24 38.70498 23.988691 38.802734 23.96875 C 39.487012 23.82916 40 23.22625 40 22.5 C 40 21.67 39.33 21 38.5 21 z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('login-by-google') }}" title="Google"
                                                        class="social-icon">
                                                        <i class="fab fa-google"></i>
                                                    </a>
                                                </div>
                                            </form>
                                            {{-- Đăng ký --}}
                                            <form action="#" class="sign-up-form">
                                                <h2 class="title" style="margin-left: 75px">Đăng ký</h2>
                                                <div class="input-field">
                                                    <i class="fas fa-user"></i>
                                                    <input type="text" placeholder="Họ và tên" />
                                                </div>
                                                <div class="input-field">
                                                    <i class="fas fa-phone"></i>
                                                    <input type="phone" placeholder="Số điện thoại" />
                                                </div>
                                                <div class="input-field">
                                                    <i class="fas fa-lock"></i>
                                                    <input type="password" placeholder="Mật khẩu" />
                                                </div>
                                                <div class="input-field">
                                                    <i class="fas fa-lock"></i>
                                                    <input type="password" placeholder="Nhập lại mật khẩu" />
                                                </div>
                                                <div class="">
                                                    <center>
                                                        <button class="btnn" type="submit">Đăng Nhập</button>
                                                    </center>
                                                </div>
                                                <p class="social-text"style="margin-left: 50px">Hoặc các mạng xã hội
                                                    khác</p>
                                                <div class="social-media">
                                                    <a href="#" class="social-icon">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                    <a href="#" class="social-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                            width="100" height="30px" viewBox="0 0 50 50">
                                                            <path
                                                                d="M 9 4 C 6.2504839 4 4 6.2504839 4 9 L 4 41 C 4 43.749516 6.2504839 46 9 46 L 41 46 C 43.749516 46 46 43.749516 46 41 L 46 9 C 46 6.2504839 43.749516 4 41 4 L 9 4 z M 9 6 L 15.580078 6 C 12.00899 9.7156859 10 14.518083 10 19.5 C 10 24.66 12.110156 29.599844 15.910156 33.339844 C 16.030156 33.549844 16.129922 34.579531 15.669922 35.769531 C 15.379922 36.519531 14.799687 37.499141 13.679688 37.869141 C 13.249688 38.009141 12.97 38.430859 13 38.880859 C 13.03 39.330859 13.360781 39.710781 13.800781 39.800781 C 16.670781 40.370781 18.529297 39.510078 20.029297 38.830078 C 21.379297 38.210078 22.270625 37.789609 23.640625 38.349609 C 26.440625 39.439609 29.42 40 32.5 40 C 36.593685 40 40.531459 39.000731 44 37.113281 L 44 41 C 44 42.668484 42.668484 44 41 44 L 9 44 C 7.3315161 44 6 42.668484 6 41 L 6 9 C 6 7.3315161 7.3315161 6 9 6 z M 33 15 C 33.55 15 34 15.45 34 16 L 34 25 C 34 25.55 33.55 26 33 26 C 32.45 26 32 25.55 32 25 L 32 16 C 32 15.45 32.45 15 33 15 z M 18 16 L 23 16 C 23.36 16 23.700859 16.199531 23.880859 16.519531 C 24.050859 16.829531 24.039609 17.219297 23.849609 17.529297 L 19.800781 24 L 23 24 C 23.55 24 24 24.45 24 25 C 24 25.55 23.55 26 23 26 L 18 26 C 17.64 26 17.299141 25.800469 17.119141 25.480469 C 16.949141 25.170469 16.960391 24.780703 17.150391 24.470703 L 21.199219 18 L 18 18 C 17.45 18 17 17.55 17 17 C 17 16.45 17.45 16 18 16 z M 27.5 19 C 28.11 19 28.679453 19.169219 29.189453 19.449219 C 29.369453 19.189219 29.65 19 30 19 C 30.55 19 31 19.45 31 20 L 31 25 C 31 25.55 30.55 26 30 26 C 29.65 26 29.369453 25.810781 29.189453 25.550781 C 28.679453 25.830781 28.11 26 27.5 26 C 25.57 26 24 24.43 24 22.5 C 24 20.57 25.57 19 27.5 19 z M 38.5 19 C 40.43 19 42 20.57 42 22.5 C 42 24.43 40.43 26 38.5 26 C 36.57 26 35 24.43 35 22.5 C 35 20.57 36.57 19 38.5 19 z M 27.5 21 C 27.39625 21 27.29502 21.011309 27.197266 21.03125 C 27.001758 21.071133 26.819727 21.148164 26.660156 21.255859 C 26.500586 21.363555 26.363555 21.500586 26.255859 21.660156 C 26.148164 21.819727 26.071133 22.001758 26.03125 22.197266 C 26.011309 22.29502 26 22.39625 26 22.5 C 26 22.60375 26.011309 22.70498 26.03125 22.802734 C 26.051191 22.900488 26.079297 22.994219 26.117188 23.083984 C 26.155078 23.17375 26.202012 23.260059 26.255859 23.339844 C 26.309707 23.419629 26.371641 23.492734 26.439453 23.560547 C 26.507266 23.628359 26.580371 23.690293 26.660156 23.744141 C 26.819727 23.851836 27.001758 23.928867 27.197266 23.96875 C 27.29502 23.988691 27.39625 24 27.5 24 C 27.60375 24 27.70498 23.988691 27.802734 23.96875 C 28.487012 23.82916 29 23.22625 29 22.5 C 29 21.67 28.33 21 27.5 21 z M 38.5 21 C 38.39625 21 38.29502 21.011309 38.197266 21.03125 C 38.099512 21.051191 38.005781 21.079297 37.916016 21.117188 C 37.82625 21.155078 37.739941 21.202012 37.660156 21.255859 C 37.580371 21.309707 37.507266 21.371641 37.439453 21.439453 C 37.303828 21.575078 37.192969 21.736484 37.117188 21.916016 C 37.079297 22.005781 37.051191 22.099512 37.03125 22.197266 C 37.011309 22.29502 37 22.39625 37 22.5 C 37 22.60375 37.011309 22.70498 37.03125 22.802734 C 37.051191 22.900488 37.079297 22.994219 37.117188 23.083984 C 37.155078 23.17375 37.202012 23.260059 37.255859 23.339844 C 37.309707 23.419629 37.371641 23.492734 37.439453 23.560547 C 37.507266 23.628359 37.580371 23.690293 37.660156 23.744141 C 37.739941 23.797988 37.82625 23.844922 37.916016 23.882812 C 38.005781 23.920703 38.099512 23.948809 38.197266 23.96875 C 38.29502 23.988691 38.39625 24 38.5 24 C 38.60375 24 38.70498 23.988691 38.802734 23.96875 C 39.487012 23.82916 40 23.22625 40 22.5 C 40 21.67 39.33 21 38.5 21 z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('login-by-google') }}" title="Google"
                                                        class="social-icon">
                                                        <i class="fab fa-google"></i>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="panels-container">
                                        <div class="panel left-panel">
                                            <div class="content">
                                                <h3>Bạn chưa có tài khoản ?</h3>
                                                <p>
                                                    Tạo tài khoản ngay để trải nghiệm tất cả các tính năng tuyệt vời của
                                                    chúng tôi.
                                                    Đăng ký miễn phí, dễ dàng nhanh chóng chỉ trong vài bước!
                                                </p>
                                                <button class="btn transparent" id="sign-up-btn">
                                                    Đăng ký
                                                </button>
                                            </div>
                                            <img src="{{ asset('assets/images/log.svg') }}" class="image"
                                                alt="" />
                                        </div>
                                        <div class="panel right-panel">
                                            <div class="content">
                                                <h3>Bạn đã có tài khoản ?</h3>
                                                <p>
                                                    Đăng nhập ngay để tiếp tục khám phá, sử dụng các dịch vụ tuyệt vời
                                                    mà chúng tôi cung cấp.
                                                    Chúng tôi rất vui được chào đón bạn quay lại!
                                                </p>
                                                <button class="btn transparent" id="sign-in-btn">
                                                    Đăng nhập
                                                </button>
                                            </div>
                                            <img src="{{ asset('assets/images/register.svg') }}" class="image"
                                                alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
<!-- color-customizer -->
<div class="iq-colorbox color-fix">
    <div class="buy-button"> <a class="color-full" href="#"><i class="fa fa-spinner fa-spin"></i></a> </div>
    <div class="clearfix color-picker text-center">
        <h3 class="iq-font-black">Màu sắc tuyệt vời</h3>
        <p>Combo màu này có sẵn bên trong toàn bộ mẫu. Bạn có thể thay đổi theo mong muốn của mình, Thậm chí bạn có thể
            tự tạo ra khả năng vô hạn!</p>
        <ul class="iq-colorselect clearfix">
            <li class="color-1 iq-colormark" data-style="color-1"></li>
            <li class="color-2" data-style="iq-color-2"></li>
            <li class="color-3" data-style="iq-color-3"></li>
            <li class="color-4" data-style="iq-color-4"></li>
            <li class="color-5" data-style="iq-color-5"></li>
            <li class="color-6" data-style="iq-color-6"></li>
            <li class="color-7" data-style="iq-color-7"></li>
            <li class="color-8" data-style="iq-color-8"></li>
            <li class="color-9" data-style="iq-color-9"></li>
            <li class="color-10" data-style="iq-color-10"></li>
            <li class="color-11" data-style="iq-color-11"></li>
            <li class="color-12" data-style="iq-color-12"></li>
            <li class="color-13" data-style="iq-color-13"></li>
            <li class="color-14" data-style="iq-color-14"></li>
            <li class="color-15" data-style="iq-color-15"></li>
            <li class="color-16" data-style="iq-color-16"></li>
            <li class="color-17" data-style="iq-color-17"></li>
            <li class="color-18" data-style="iq-color-18"></li>
            <li class="color-19" data-style="iq-color-19"></li>
            <li class="color-20" data-style="iq-color-20"></li>
        </ul>
        <a class="btn btn-primary d-block mt-3" href="">Mua Ngay</a>
    </div>
</div>
<style>
    a {
        text-decoration: none
    }

    #sign-up-btn:hover {
        border-radius: 20px;
        transition: 1s;
        background: white;
    }

    #sign-in-btn:hover {
        border-radius: 20px;
        transition: 1s;
        background: white;
    }

    .navbar-breadcrumb a h6 {
        color: var(--iq-body-text);
    }

    .navbar-breadcrumb a h6:hover {
        color: var(--iq-primary);
        transition: 1s;
        text-decoration: none;
    }

    .iq-top-navbar .iq-navbar-custom .active h6 {
        color: #49f0d3;
        font-weight: bold
    }

    .nav-button .btn {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: scale(1);
        }

        40% {
            transform: scale(1.05);
        }

        60% {
            transform: scale(1.03);
        }
    }

    .nav-button .btn {
        animation: bounce 2s infinite;
        transition: box-shadow 0.3s ease;
    }

    .nav-button .btn:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    function removeFromCart(cartId) {
        console.log("Removing cart item with ID:", cartId);
        fetch(`/cart/remove/${cartId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
