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
          <li><a href="{{route('homeAdmin')}}"><i class="las la-home iq-arrow-left"></i>Bảng Điều Khiển</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Tài Khoản</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Danh Mục Khóa Học</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Khóa Học</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Danh Mục Sách</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Sách</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Đề Thi</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Đơn Hàng</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Thông Báo</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Liên Hệ</a></li>
          <li><a href="#"><i class="ri-record-circle-line"></i>Đăng Xuất</a></li>
       </ul>
    </nav>
    <div id="sidebar-bottom" class="p-3 position-relative">
       <div class="iq-card">
          <div class="iq-card-body">
             <div class="sidebarbottom-content">
               <a href="{{route('homeClient')}}"><button type="submit" class="btn w-100 btn-primary mt-4 view-more">Trở về Website</button></a>
             </div>
          </div>
       </div>
    </div>
 </div>