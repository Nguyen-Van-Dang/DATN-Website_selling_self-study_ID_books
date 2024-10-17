<div class="col-sm-12">
    <div class="iq-card">
       <div class="iq-card-header d-flex justify-content-between">
          <div class="iq-header-title">
             <h4 class="card-title">Danh mục sách</h4>
          </div>
          <div class="iq-card-header-toolbar d-flex align-items-center">
             <a href="{{route('addCategoryBook')}}" class="btn btn-primary">Thêm danh mục sách</a>
          </div>
       </div>
       <div class="iq-card-body">
          <div class="table-responsive">
             <table class="data-tables table table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                   <tr>
                      <th style="width: 5%;">STT</th>
                      <th style="width: 22.5%;">Tên danh mục</th>
                      <th style="width: 11%;">Hoạt động</th>
                   </tr>
                </thead>
                <tbody class="text-center">
                  @foreach ($bookCate as $item)
                   <tr>
                     <td>{{$item->id}}</td>
                     <td class="mb-0" >{{$item->name}}</td>
                      <td>
                         <div class="flex align-items-center text-center list-user-action">
                              <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                              <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Sửa" data-original-title="Sửa" href="{{route('updateCategoryBook')}}"><i class="ri-pencil-line"></i></a>
                              <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xóa" data-original-title="Xoá" href="#"><i class="ri-delete-bin-line"></i></a>
                         </div>
                      </td>
                   </tr>
                  @endforeach
                </tbody>
             </table>
          </div>
          
          <div class="text-end">
            {{ $bookCate->links() }}
        </div>
       </div>
    </div>
 </div>
 
<script>
    document.querySelectorAll('[id^=deleteButton-]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            // Lấy ID tài khoản từ nút xóa
            const notificationId = this.id.split('-')[1];
            // Hiển thị popup và màn che
            document.getElementById('confirmPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            // Gán sự kiện cho nút Xác nhận
            document.getElementById('yesButton').onclick = function() {
                // Gửi form xóa tài khoản
                document.getElementById(`delete-form-${notificationId}`).submit();
            };
        });
    });
    // Ẩn popup khi nhấn nút "Trở về"
    document.getElementById('noButton').addEventListener('click', function() {
        document.getElementById('confirmPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    });
</script>