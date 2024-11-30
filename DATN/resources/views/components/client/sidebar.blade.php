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
    @livewire('component.rendersidebar');
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
    .BookImage {
        width: 30px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        background-color: rgb(127, 130, 227);
        color: white;
        font-size: 20px;
        text-decoration: none;
        object-fit: cover;
    }
</style>
