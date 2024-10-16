@extends('layouts.admin.admin')

@section('title', 'Danh sách bài giảng')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Danh sách bài giảng</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                   <a href="{{route('addLecture')}}" class="btn btn-primary">Thêm bài giảng</a>
                </div>
             </div>
             <div class="iq-card-body">
                <div class="table-responsive">
                   <table class="data-tables table table-striped table-bordered" style="width:100%">
                      <thead class="text-center">
                         <tr>
                            <th style="width: 5%;">STT</th>
                            <th style="width: 10%;">Ảnh</th>
                            <th style="width: 22.5%;">Tên bài giảng</th>
                            <th style="width: 22.5%;">Vai trò</th>
                            <th style="width: 20%;">Trạng thái</th>
                            <th style="width: 11%;">Hoạt động</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                            <td>1</td>
                            <td class="text-center">
                               <img src="{{ asset('assets/images/book/user/1.jpg') }}" class="img-fluid avatar-50 rounded" alt="">
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
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="{{route('detailLecture')}}"><i class="ri-eye-line"></i></a>
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Sửa" href="{{route('updateLecture')}}"><i class="ri-pencil-line"></i></a>
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xóa" href="#"><i class="ri-delete-bin-line"></i></a>
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