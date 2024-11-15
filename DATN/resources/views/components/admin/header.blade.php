<div class="iq-navbar-custom">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <div class="navbar-breadcrumb">
            <h5 class="mb-0">Dashboard</h5>
        </div>
        {{-- <div class="iq-search-bar">
            <form action="#" class="searchbox">
                <input type="text" class="text search-input" placeholder="Tìm kiếm sản phẩm...">
                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
            </form>
        </div> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list">
                <li class="nav-item nav-icon search-content">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-search-line"></i>
                    </a>
                    <form action="#" class="search-box p-0">
                        <input type="text" class="text search-input" placeholder="Type here to search...">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                    </form>
                </li>
                <li class="nav-item nav-icon">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
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
                                                src="{{ asset('assets/images/book/user/01.jpg') }}" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Đơn hàng giao thành công</h6>
                                            <small class="float-right font-size-12">Just Now</small>
                                            <p class="mb-0">95.000đ</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
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
                                                src="{{ asset('assets/images/book/user/01.jpg') }}" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">QT Shop</h6>
                                            <small class="float-left font-size-12">13 Jun</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="line-height pt-3">
                    <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <img src="{{ asset('assets/images/book/user/1.jpg') }}" class="img-fluid rounded-circle mr-3"
                            alt="user">
                        <div class="caption">
                            @php
                                $userName = Auth::user()->name;
                                $displayName = Str::limit($userName, 10, '...');
                            @endphp
                            <h6 class="mb-1 line-height">{{ $displayName }}!</h6>
                            <p class="mb-0 text-primary">Tài Khoản</p>
                        </div>
                    </a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Xin Chào <br> {{ auth()->user()->name }}
                                    </h5>
                                </div>
                                @if (Auth::user()->role_id == 1)
                                    <a href="{{ route('userInfo') }}" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Tài khoản của tôi</h6>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ route('userInfo') }}" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Tài khoản của tôi</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-account-box-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Đơn hàng của tôi</h6>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="{{ route('logout') }}"
                                        role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- color-customizer -->
<div class="iq-colorbox color-fix">
    <div class="buy-button"> <a class="color-full" href="#" style="z-index: 1;"><i
                class="fa fa-spinner fa-spin"></i></a> </div>
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
