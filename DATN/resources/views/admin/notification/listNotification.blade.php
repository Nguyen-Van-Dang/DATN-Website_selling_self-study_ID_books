@extends('layouts.admin.admin')

@section('title', 'Danh sách thông báo')
@section('content')
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-sm-12">
               <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                  <div class="iq-card-header d-flex justify-content-between">
                     <div class="iq-header-title">
                        <h4 class="card-title">Danh sách thông báo</h4>
                     </div>
                     <div class="iq-card-header-toolbar d-flex align-items-center">
                        <a href="{{route('addNotification')}}" class="btn btn-primary">Gửi thông báo</a>
                     </div>
                  </div>
                  <div class="iq-card-body">
                     <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                           <thead>
                              <tr>
                                 <th scope="col">Tên</th>
                                 <th scope="col">Ngày</th>
                                 <th scope="col">Nội dung</th>
                                 <th scope="col" class="text-center">Hoạt động</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Ông Trần Thuận</td>
                                 <td>18/10/2019</td>
                                 <td>Đây là nội dung</td>
                                 <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
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
    