@extends('layouts.admin.admin')

@section('title', 'Đơn hàng')
@section('content')
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-sm-12">
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-header d-flex justify-content-between">
                     <div class="iq-header-title">
                        <h4 class="card-title">Danh sách đơn hàng</h4>
                     </div>
                     <div class="iq-card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                           <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                           <i class="ri-more-fill"></i>
                           </span>
                           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                              <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>Xem</a>
                              <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Xoá</a>
                              <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Sửa</a>
                              <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>In</a>
                              <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Tải xuống</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="iq-card-body">
                     <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                           <thead>
                              <tr>
                                 <th scope="col">Khách hàng</th>
                                 <th scope="col">Ngày</th>
                                 <th scope="col">Hóa đơn</th>
                                 <th scope="col">Số tiền</th>
                                 <th scope="col">Tình trạng</th>
                                 <th scope="col" class="text-center">Hoạt động</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Ông Trần Thuận</td>
                                 <td>18/10/2019</td>
                                 <td>20156</td>
                                 <td>150.000đ</td>
                                 <td><div class="badge badge-pill badge-success">Đã thanh toán</div></td>
                                 <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{route('updateOrder')}}"><i class="ri-pencil-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xoá" href="#"><i class="ri-delete-bin-line"></i></a>
                                   </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>QT shop</td>
                                 <td>18/11/2019</td>
                                 <td>6396</td>
                                 <td>250.000đ</td>
                                 <td><div class="badge badge-pill badge-danger">Chưa thanh toán</div></td>
                                 <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{route('updateOrder')}}"><i class="ri-pencil-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xoá" href="#"><i class="ri-delete-bin-line"></i></a>
                                   </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </div>
@endsection
