<div class="iq-sidebar-logo d-flex justify-content-between">
    <a href="<?php echo e(route('homeAdmin')); ?>" class="header-logo">
        <img src="<?php echo e(asset('assets/images/book/icon/big_logo.png')); ?>" class="img-fluid rounded-normal" alt="">
        <div class="logo-title">
            <span class="text-primary text-uppercase">Trang quản trị</span>
        </div>
    </a>
    <div class="iq-menu-bt-sidebar">
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
            <li class="<?php echo e(request()->routeIs('homeAdmin') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('homeAdmin')); ?>"><i class="ri-dashboard-line"></i> <span>Bảng Điều Khiển</span></a>
            </li>
            <?php if(auth()->check() && Auth::user()->role_id == 1): ?>
                <li class="<?php echo e(request()->routeIs('listUser') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('listUser')); ?>"><i class="ri-user-line"></i> <span>Tài Khoản</span></a>
                </li>
            <?php endif; ?>
            <li class="<?php echo e(request()->routeIs('admin.khoa-hoc.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.khoa-hoc.index')); ?>"><i class="ri-book-line"></i> <span>Khóa Học</span></a>
            </li>
            <?php if(auth()->check() && Auth::user()->role_id == 1): ?>
                <li class="<?php echo e(request()->routeIs('admin.danh-muc-sach.index') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.danh-muc-sach.index')); ?>"><i class="ri-bookmark-line"></i> <span>Danh Mục
                            Sách</span></a>
                </li>
            <?php endif; ?>
            <li class="<?php echo e(request()->routeIs('admin.sach*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.sach.index')); ?>"><i class="ri-book-2-line"></i> <span>Sách</span></a>
            </li>
            <?php if(auth()->check() && Auth::user()->role_id == 1): ?>
                <li class="<?php echo e(request()->routeIs('admin.kich-hoat-sach*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.kich-hoat-sach.index')); ?>"><i class="ri-key-2-line"></i> <span>Mã kích
                            hoạt</span></a>
                </li>
            <?php endif; ?>
            <li class="<?php echo e(request()->routeIs('admin.de-thi*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.de-thi.index')); ?>"><i class="ri-file-list-line"></i> <span>Đề thi</span></a>
            </li>
            <li class="<?php echo e(request()->routeIs('listOrder') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('listOrder')); ?>"><i class="ri-shopping-cart-line"></i> <span>Đơn Hàng</span></a>
            </li>
            <?php if(auth()->check() && Auth::user()->role_id == 1): ?>
                <li class="<?php echo e(request()->routeIs('listContact') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('listContact')); ?>"><i class="ri-mail-line"></i> <span>Liên Hệ</span></a>
                </li>
            <?php endif; ?>
            <?php if(auth()->check() && (Auth::user()->role_id == 1)): ?>
                <li class="<?php echo e(request()->routeIs('approve') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('approve')); ?>"><i class="ri-checkbox-circle-line"></i><span>Phê duyệt</span></a>
                </li>
            <?php endif; ?>
            <li class="<?php echo e(request()->routeIs('bin') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('bin')); ?>"><i class="ri-delete-bin-5-line"></i> <span>Thùng
                        Rác</span></a>
            </li>
        </ul>
    </nav>
    <div id="sidebar-bottom" class="p-3 position-relative">
        <div class="sidebarbottom-content">
            <a href="<?php echo e(route('homeClient')); ?>"><button type="submit" class="btn w-100 btn-primary mt-4 view-more">Trở
                    về Website</button></a>
        </div>
    </div>
</div>
<style>
    .iq-sidebar-logo .header-logo {
        display: ruby;
        margin-top: 5px;
    }
</style>
<script>
    document.querySelector('.main-circle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar-scrollbar');
        sidebar.classList.toggle('collapsed');

        // Thay đổi nội dung của biểu tượng khi sidebar được mở hoặc thu nhỏ
        const icon = this.querySelector('i');
        if (sidebar.classList.contains('collapsed')) {
            icon.classList.remove('las', 'la-bars');
            icon.classList.add('las', 'la-angle-double-right'); // Chỉnh biểu tượng thành mũi tên khi thu nhỏ
        } else {
            icon.classList.remove('las', 'la-angle-double-right');
            icon.classList.add('las', 'la-bars'); // Chỉnh biểu tượng về trạng thái ban đầu
        }
    });
</script>
<?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/components/admin/sidebar.blade.php ENDPATH**/ ?>