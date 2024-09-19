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
</style>
