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
               <a href="{{route('homeAdmin')}}"><i class="ri-dashboard-line"></i> <span>Bảng Điều Khiển</span></a>
           </li>
           @if (Auth::user()->role_id != 2)
           <li class="{{ request()->routeIs('listUser') ? 'active' : '' }}">
               <a href="{{route('listUser')}}"><i class="ri-user-line"></i> <span>Tài Khoản</span></a>
           </li>
           @endif
           <li class="{{ request()->routeIs('listCategoryCourse') ? 'active' : '' }}">
               <a href="{{route('listCategoryCourse')}}"><i class="ri-folders-line"></i> <span>Danh Mục Khóa Học</span></a>
           </li>
           <li class="{{ request()->routeIs('listCourse') ? 'active' : '' }}">
               <a href="{{route('listCourse')}}"><i class="ri-book-line"></i> <span>Khóa Học</span></a>
           </li>
           <li class="{{ request()->routeIs('') ? 'active' : '' }}">
               <a href="{{route('listLecture')}}"><i class="ri-slideshow-line"></i> <span>Bài Giảng</span></a>
           </li>
           <li class="{{ request()->routeIs('listCategoryBook') ? 'active' : '' }}">
               <a href="{{route('listCategoryBook')}}"><i class="ri-bookmark-line"></i> <span>Danh Mục Sách</span></a>
           </li>
           <li class="{{ request()->routeIs('listBook') ? 'active' : '' }}">
               <a href="{{route('listBook')}}"><i class="ri-book-2-line"></i> <span>Sách</span></a>
           </li>
           <li class="{{ request()->routeIs('listExercise') ? 'active' : '' }}">
               <a href="{{route('listExercise')}}"><i class="ri-file-list-line"></i> <span>Bài Tập</span></a>
           </li>
           <li class="{{ request()->routeIs('listOrder') ? 'active' : '' }}">
               <a href="{{route('listOrder')}}"><i class="ri-shopping-cart-line"></i> <span>Đơn Hàng</span></a>
           </li>
           <li class="{{ request()->routeIs('listNotificationUser') ? 'active' : '' }}">
               <a href="{{route('listNotificationUser')}}"><i class="ri-notification-3-line"></i> <span>Thông Báo</span></a>
           </li>
           @if (Auth::user()->role_id != 2)
           <li class="{{ request()->routeIs('listContact') ? 'active' : '' }}">
               <a href="{{route('listContact')}}"><i class="ri-mail-line"></i> <span>Liên Hệ</span></a>
           </li>
           @endif
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