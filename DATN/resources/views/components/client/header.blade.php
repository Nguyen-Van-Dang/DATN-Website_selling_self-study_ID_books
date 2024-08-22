<div class="iq-navbar-custom">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <div class="iq-menu-bt d-flex align-items-center">
            <div class="wrapper-menu">
                <div class="main-circle"><i class="las la-bars"></i></div>
            </div>
            <div class="iq-navbar-logo d-flex justify-content-between">
                <a href="index.html" class="header-logo">
                    <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
                    <div class="logo-title">
                        <span class="text-primary text-uppercase">img01</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="navbar-breadcrumb">
            <h5 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path
                        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
                </svg> Trang Chủ</h5>
        </div>
        <div class="navbar-breadcrumb">
            <h5 class="mb-0">Sách</h5>
        </div>
        <div class="navbar-breadcrumb">
            <h5 class="mb-0">Khóa học</h5>
        </div>
        <div class="navbar-breadcrumb">
            <h5 class="mb-0">Học tập</h5>
        </div>
        <div class="navbar-breadcrumb">
            <h5 class="mb-0">Tin nhắn</h5>
        </div>
        <div class="iq-search-bar">
            <form action="#" class="searchbox">
                <input type="text" class="text search-input" placeholder="Tìm kiếm sản phẩm...">
                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
            </form>
        </div>
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
                {{-- notification --}}
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
                                            <img class="avatar-40 rounded" src="images/user/1.jpg" alt="">
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
                                            <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">
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
                {{-- cart --}}
                <li class="nav-item nav-icon dropdown">
                    <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span class="badge badge-danger count-cart rounded-circle">2</span>
                    </a>
                    <div class="iq-sub-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 toggle-cart-info">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">Giỏ Hàng<small
                                            class="badge  badge-light float-right pt-1">2</small></h5>
                                </div>
                                <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                        <div class="">
                                            <img class="rounded" src="images/cart/01.jpg" alt="">
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Night People book</h6>
                                            <p class="mb-0">$32</p>
                                        </div>
                                        <div class="float-right font-size-24 text-danger"><i
                                                class="ri-close-fill"></i></div>
                                    </div>
                                </a>
                                <div class="d-flex align-items-center text-center p-3">
                                    <a class="btn btn-primary mr-2 iq-sign-btn" href="checkout.html"
                                        role="button">Giỏ Hàng</a>
                                    <a class="btn btn-primary iq-sign-btn" href="checkout.html" role="button">Thanh
                                        Toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- user --}}
                <li class="line-height pt-3">
                    <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <img src="{{ asset('assets/images/user/1.jpg') }}" class="img-fluid rounded-circle mr-3"
                            alt="user">
                        <div class="caption">
                            <h6 class="mb-1 line-height">Ông Trần Thuận</h6>
                            <p class="mb-0 text-primary">Tài Khoản</p>
                        </div>
                    </a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Xin Chào Ông Trần Thuận</h5>
                                </div>
                                <a href="{{ route('userInformation') }}" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-file-user-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Tài khoản của tôi</h6>
                                        </div>
                                    </div>
                                </a>
                                <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-profile-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Sổ địa chỉ</h6>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-account-box-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Đơn hàng của tôi</h6>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-heart-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Yêu Thích</h6>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="sign-in.html" role="button">Sign out<i
                                            class="ri-login-box-line ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
