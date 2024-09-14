@extends('layouts.admin.admin')

@section('title', 'Danh mục khóa học')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Danh mục khóa học</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                   <a href="{{route('addCaterogyCourse')}}" class="btn btn-primary">Thêm danh mục khóa học</a>
                </div>
             </div>
             <div class="iq-card-body">
                <div class="table-responsive">
                   <table class="data-tables table table-striped table-bordered" style="width:100%">
                      <thead class="text-center">
                         <tr>
                            <th style="width: 5%;">STT</th>
                            <th style="width: 22.5%;">Tên danh mục</th>
                            <th style="width: 22.5%;">Tổng số khóa học</th>
                            <th style="width: 11%;">Hoạt động</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                            <td class="text-center">1</td>
                            <td class="mb-0">Kinh dị</td>
                            <td>
                               <p class="mb-0 text-center">99</p>
                            </td>
                            <td>
                               <div class="flex align-items-center text-center list-user-action">
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href=""><i class="ri-pencil-line"></i></a>
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xoá" href="#"><i class="ri-delete-bin-line"></i></a>
                               </div>
                            </td>
                         </tr>
                         <tr>
                            <td class="text-center">2</td>
                            <td class="mb-0">Trinh thám</td>
                            <td>
                               <p class="mb-0 text-center">99</p>
                            </td>
                            <td>
                               <div class="flex align-items-center text-center list-user-action">
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href=""><i class="ri-pencil-line"></i></a>
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