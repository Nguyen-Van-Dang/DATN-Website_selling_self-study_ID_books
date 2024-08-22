<style>
    .custom-hide {
        display: none;
    }

    @media (max-width: 1023px) {
        .custom-hide {
            display: block;
        }
    }
</style>
<div class="iq-sidebar-logo d-flex justify-content-between">
    <a href="{{ route('homeClient') }}" class="header-logo">
        <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
        <div class="logo-title">
            <span class="text-primary text-uppercase">NHASACHTV</span>
        </div>
    </a>
    <div class="custom-hide">
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="main-circle"><i class="las la-bars"></i></div>
            </div>
        </div>
    </div>
</div>
<div id="sidebar-scrollbar">
    <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
            <li class="active active-menu">
                <a href="homeClient" class="iq-waves-effect" data-toggle="collapse" aria-expanded="true"><span
                        class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Trang
                        Chủ</span></a>
                <ul id="dashboard" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                </ul>
            </li>
            <li>
                <a href="#ui-elements" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                        class="lab la-elementor iq-arrow-left"></i><span>Danh mục sản phẩm</span><i
                        class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                    <li class="elements">
                        <a href="#sub-menu" class="iq-waves-effect collapsed" data-toggle="collapse"
                            aria-expanded="false"><i class="ri-play-circle-line"></i><span>Sách Trong Nước</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    </li>
                    <li class="elements">
                        <a href="#sub-menu" class="iq-waves-effect collapsed" data-toggle="collapse"
                            aria-expanded="false"><i class="ri-play-circle-line"></i><span>Sách Kinh Tế</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    </li>
                    <li class="elements">
                        <a href="#sub-menu" class="iq-waves-effect collapsed" data-toggle="collapse"
                            aria-expanded="false"><i class="ri-play-circle-line"></i><span>Sách Ngoại Ngữ</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    </li>
                    <li class="elements">
                        <a href="#sub-menu" class="iq-waves-effect collapsed" data-toggle="collapse"
                            aria-expanded="false"><i class="ri-play-circle-line"></i><span>Sách Văn Học</span><i
                                class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
<hr>
