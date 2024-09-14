<div class="iq-sidebar-logo d-flex justify-content-between">
    <a href="{{route('homeAdmin')}}" class="header-logo">
       <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
       <div class="logo-title">
          <span class="text-primary text-uppercase">Dashboard</span>
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
         <li class="{{ request()->routeIs('homeAdmin') ? 'active' : '' }}">
            <a href="{{route('homeAdmin')}}"><i class="ri-dashboard-line"></i> Bảng Điều Khiển</a>
         </li>
         <li class="{{ request()->routeIs('listUser') ? 'active' : '' }}">
            <a href="{{route('listUser')}}"><i class="ri-user-line"></i> Tài Khoản</a>
         </li>
         <li class="{{ request()->routeIs('listCaterogyCourse') ? 'active' : '' }}">
            <a href="{{route('listCaterogyCourse')}}"><i class="ri-folders-line"></i> Danh Mục Khóa Học</a>
         </li>
         <li class="{{ request()->routeIs('listCourse') ? 'active' : '' }}">
            <a href="{{route('listCourse')}}"><i class="ri-book-line"></i> Khóa Học</a>
         </li>
         <li class="{{ request()->routeIs('listCaterogyBook') ? 'active' : '' }}">
            <a href="{{route('listCaterogyBook')}}"><i class="ri-bookmark-line"></i> Danh Mục Sách</a>
         </li>
         <li class="{{ request()->routeIs('listBook') ? 'active' : '' }}">
            <a href="{{route('listBook')}}"><i class="ri-book-2-line"></i> Sách</a>
         </li>
         <li>
            <a href="#"><i class="ri-file-list-line"></i> Bài Tập</a>
         </li>
         <li class="{{ request()->routeIs('listOrder') ? 'active' : '' }}">
            <a href="{{route('listOrder')}}"><i class="ri-shopping-cart-line"></i> Đơn Hàng</a>
         </li>
         <li>
            <a href="#"><i class="ri-notification-3-line"></i> Thông Báo</a>
         </li>
         <li>
            <a href="#"><i class="ri-mail-line"></i> Liên Hệ</a>
         </li>
      </ul>
    </nav>
    <div id="sidebar-bottom" class="p-3 position-relative">
             <div class="sidebarbottom-content">
               <a href="{{route('homeClient')}}"><button type="submit" class="btn w-100 btn-primary mt-4 view-more">Trở về Website</button></a>
             </div>
    </div>
 </div>
 <style>
   .iq-sidebar-logo .header-logo{
     display: ruby; 
     margin-top: 5px;
   }
</style>
