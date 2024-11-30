<div>
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
                <div class="navbar-breadcrumb px-3 {{ Request::is('khoa-hoc*') ? 'active' : '' }}">
                    <a href="{{ route('khoa-hoc.index') }}" class="iq-waves-effect rounded">
                        <h6 class="mb-0">Khóa học</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 {{ Request::is('hoc-tap') ? 'active' : '' }}">
                    <a href="{{ route('hoc-tap') }}" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Học tập</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 {{ Request::is('chat*') ? 'active' : '' }}">
                    <a href="{{ route('chat') }}" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Tin nhắn</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 {{ Request::is('reels') ? 'active' : '' }}">
                    <a href="{{ route('reals') }}" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Reels</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 {{ Request::is('de-thi*') ? 'active' : '' }}">
                    <a href="{{ route('de-thi.index') }}" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Đề thi</h6>
                    </a>
                </div>
                <div class="navbar-breadcrumb px-3 {{ Request::is('addContact*') ? 'active' : '' }}">
                    <a href="{{ route('addContact') }}" class="iq-waves-effect  rounded">
                        <h6 class="mb-0">Liên hệ</h6>
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
                    {{-- <li class="nav-item nav-icon">
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
                    </li> --}}
                    {{-- mess --}}
                    {{-- <li class="nav-item nav-icon dropdown">
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
                                                    src="{{ asset('assets/images/book/user/4.jpg') }}"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">QT Shop</h6>
                                                <small class="float-left font-size-12">9/9/2024</small>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="text-center ">
                                        <p>
                                            <a href="">Tất cả tin nhắn</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> --}}
                    {{-- cart --}}
                    <li class="nav-item nav-icon dropdown">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-shopping-cart-2-line"></i>
                            <span class="badge badge-danger count-cart rounded-circle">
                                {{ auth()->check() ? $cartCount : 0 }}
                            </span>
                        </a>
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 toggle-cart-info">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">
                                            Giỏ Hàng
                                            <small
                                                class="badge badge-light float-right pt-1">{{ auth()->check() ? $cartCount : 0 }}</small>
                                        </h5>
                                    </div>
                                    @if (auth()->check() && $cartCount > 0)
                                        <div class="custom-scrollbar">
                                            @foreach ($cartItems as $item)
                                                <div class="row">
                                                    <div class="col-10">
                                                        <a class="iq-sub-card">
                                                            <div class="media align-items-center">
                                                                <div>@php
                                                                    $thumbnail = $item->book
                                                                        ->images()
                                                                        ->where('image_name', 'thumbnail')
                                                                        ->first();
                                                                @endphp
                                                                    <img class="rounded"
                                                                        src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/02.jpg') }}">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0">Tên: {{ $item->book->name }}
                                                                    </h6>
                                                                    <p class="mb-0">Giá:
                                                                        {{ $item->book->price * $item->quantity }} đ
                                                                    </p>
                                                                    <p class="mb-0">Số Lượng: {{ $item->quantity }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                                        <a style="padding-right: 20px">
                                                            <div class="font-size-24 text-danger"
                                                                style="cursor: pointer;">
                                                                <i class="ri-close-fill"
                                                                    wire:click="removeFromCart({{ $item->id }})"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-center p-3">Giỏ hàng trống</p>
                                    @endif
                                </div>
                                <div class="align-items-center text-center p-3">
                                    <a class="btn btn-primary iq-sign-btn" href="{{ route('shoppingCart') }}"
                                        role="button">Giỏ Hàng</a>
                                    <a class="btn btn-primary iq-sign-btn" href="{{ route('shoppingCart') }}"
                                        role="button">Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- reels --}}
                    @if (auth()->check() && in_array(Auth::user()->role_id, [1, 2]))
                        <li class="nav-item nav-icon dropdown">
                            <a href="{{ route('tai-video.index') }}" class="text-gray rounded">
                                <i class="ri-upload-cloud-line"></i>
                            </a>
                        </li>
                    @endif
                    {{-- user --}}
                    @if (auth()->check())
                        <li class="line-height pt-3">
                            <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                @php
                                    $avatar = auth()->user()->images()->where('image_name', 'thumbnail')->first();
                                @endphp
                                <img class="img-fluid rounded-circle mr-3"
                                    src="{{ $avatar ? $avatar->image_url : asset('assets/images/book/user/1.jpg') }}">

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
                                            <h5 class="mb-0 text-white line-height">Xin Chào
                                                {{ auth()->user()->name }}
                                            </h5>
                                        </div>
                                        @if (Auth::user()->role_id == 1)
                                            <a href="{{ route('userInformation') }}"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-file-user-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Sửa thông tin</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="{{ route('homeAdmin') }}"
                                                class="iq-sub-card iq-bg-primary-hover">
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
                                            <a href="{{ route('userDetail') }}"
                                                class="iq-sub-card iq-bg-primary-hover">
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
                                            <a href="{{ route('homeAdmin') }}"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-shield-user-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Vào trang quản trị</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            {{-- <a href="{{ route('userDetail') }}"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-file-user-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Tài khoản của tôi</h6>
                                                    </div>
                                                </div>
                                            </a> --}}
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
                                            <a href="{{ route('orderList') }}"
                                                class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                    <div class="rounded iq-card-icon iq-bg-primary">
                                                        <i class="ri-account-box-line"></i>
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-0">Đơn hàng của tôi</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="{{ route('getAllBookFavorite') }}"
                                                class="iq-sub-card iq-bg-primary-hover">
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
                                                <livewire:client.user.login-user />
                                                {{-- Đăng ký --}}
                                                <livewire:client.user.register-user />
                                            </div>
                                        </div>
                                        <div class="panels-container">
                                            <div class="panel left-panel">
                                                <div class="content">
                                                    <h3>Bạn chưa có tài khoản ?</h3>
                                                    <p>
                                                        Tạo tài khoản ngay để trải nghiệm tất cả các tính năng tuyệt vời
                                                        của
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
                                                        Đăng nhập ngay để tiếp tục khám phá, sử dụng các dịch vụ tuyệt
                                                        vời
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

        .custom-scrollbar {
            overflow-x: hidden;
            overflow-y: auto;
            max-height: 350px;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #20c997;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #108562;
        }
    </style>
</div>
