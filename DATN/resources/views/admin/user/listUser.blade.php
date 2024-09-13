@extends('layouts.admin.admin')

@section('title', 'Danh sách tài khoản')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Danh sách tài khoản</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                   <a href="{{route('addUser')}}" class="btn btn-primary">Thêm tài khoản</a>
                </div>
             </div>
             <div class="iq-card-body">
                <div class="table-responsive">
                   <table class="data-tables table table-striped table-bordered" style="width:100%">
                      <thead class="text-center">
                         <tr>
                            <th style="width: 5%;">STT</th>
                            <th style="width: 10%;">Ảnh</th>
                            <th style="width: 22.5%;">Tên tài khoản</th>
                            <th style="width: 22.5%;">Vai trò</th>
                            <th style="width: 20%;">Trạng thái</th>
                            <th style="width: 11%;">Hoạt động</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                            <td>1</td>
                            <td class="text-center">
                               <img src="{{ asset('assets/images/user/1.jpg') }}" class="img-fluid avatar-50 rounded" alt="">
                            </td>
                            <td class="mb-0">Nam Cao</td>
                            <td>
                               <p class="mb-0 text-center">Học sinh</p>
                            </td>
                            <td>
                                <p class="mb-0 text-center">Đang hoạt động</p>
                             </td>
                            <td>
                               <div class="flex align-items-center list-user-action">
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="admin-add-category.html"><i class="ri-pencil-line"></i></a>
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