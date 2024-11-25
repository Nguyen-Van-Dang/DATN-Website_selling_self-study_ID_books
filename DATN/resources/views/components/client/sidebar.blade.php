<div class="iq-sidebar-logo d-flex justify-content-between">
    <a href="{{ route('homeClient') }}" class="header-logo">
        <img id="main-logo" src="{{ asset('assets/images/book/icon/big_logo.png') }}" class="img-fluid rounded-normal"
            alt="">
    </a>
    <div class="iq-menu-bt align-self-center">
        <div class="wrapper-menu">
            <i class="bi bi-list"></i>
        </div>
    </div>
</div>
<div id="sidebar-scrollbar">
    <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
            <li>
                <a href="{{ route('bookList') }}" class="iq-waves-effect" aria-expanded="false">
                    <span class="ripple rippleEffect"></span>
                    <img class="sidebar-icon me-2" src="{{ asset('assets/images/book/icon/book_icon.png') }}"
                        alt="">
                    <span class="px-2">Sách</span>
                </a>
                <ul id="dashboard" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                </ul>
            </li>
            <hr class="custom">
            <li>
                <a href="#ui-elements" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                    <span class="ripple rippleEffect"></span>
                    <img class="sidebar-icon me-2" src="{{ asset('assets/images/book/icon/play_icon.png') }}"
                        alt="">
                    <span class="px-2">Khoá học mới nhất</span>
                    <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                </a>
                @foreach ($courses as $course)
                    @php
                        $courseImage = $course->images()->where('image_name', 'course')->first();
                    @endphp
                    <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="elements">
                            <a href="{{ route('khoa-hoc.show', $course->id) }}" class="iq-waves-effect collapsed">
                                <div class="d-flex align-items-center">
                                    <img class="CourseImage"
                                        src="{{ $courseImage ? $courseImage->image_url : asset('assets/images/book/user/1.jpg') }}">
                                    <span class="px-2">{{ Str::limit($course->name, 20, '...') }}</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                @endforeach
            </li>
            <hr class="custom">
            <li>
                <a href="#ui-elements2" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                    <span class="ripple rippleEffect"></span>
                    <img class="sidebar-icon me-2" src="{{ asset('assets/images/book/icon/library_icon.png') }}"
                        alt="">
                    <span class="px-2">Thư viện của bạn</span>
                    <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                </a>
                <ul id="ui-elements2" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                    <li class="elements">
                        <a href="#sub-menu" class="iq-waves-effect collapsed" data-toggle="collapse"
                            aria-expanded="true">
                            <div class="d-flex align-items-center">
                                <div class="numberCircle">6</div>
                                <span class="px-2">Lớp 6</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <hr class="custom">
            <h6 class="px-4 mt-3 mb-0">Giáo viên</h6>
            @foreach ($teachers as $teacher)
                @php
                    $avatar = $teacher->images()->where('image_name', 'avatar')->first();
                @endphp
                <li>
                    <a href="" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
                        <span class="ripple rippleEffect"></span>
                        <img class="sidebar-icon me-2" style="border-radius: 50%"
                            src="{{ $avatar ? $avatar->image_url : asset('assets/images/book/user/6.jpg') }}">
                        <span class="px-2">{{ $teacher->name }}</span>
                    </a>
                    <ul id="dashboard" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                    </ul>
                </li>
            @endforeach

            <li>
                <a href="#" id="show-more-btn" class="iq-waves-class="px-2" data-toggle="collapse"
                    aria-expanded="true">
                    <i class="bi bi-arrow-down-circle"></i>
                    <span>Xem thêm</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<style>
    .iq-menu-bt {
        display: none;
    }

    @media (max-width: 768px) {
        .iq-menu-bt {
            display: block;
        }
    }

    .custom-hide {
        display: none;
    }

    @media (max-width: 1023px) {
        .custom-hide {
            display: block;
        }
    }

    .iq-sidebar.collapsed {
        width: 80px;
    }

    .CourseImage {
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        text-align: center;
        background-color: rgb(127, 130, 227);
        color: white;
        font-size: 20px;
        text-decoration: none;
        object-fit: cover;
    }
</style>
