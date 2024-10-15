@extends('layouts.admin.admin')

@section('title', 'Chi tiết bài tập')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Chi tiết bài tập</h4>
                </div>
                {{-- <div class="iq-card-header-toolbar d-flex align-items-center">
                   <a href="{{route('addExercise')}}" class="btn btn-primary">Thêm bài tập</a>  
                </div> --}}
             </div>
             <div class="iq-card-body">
                <div class="table-responsive">
                   <table class="data-tables table table-striped table-bordered" style="width:100%">
                     <thead>
                         <tr>
                             <th style="width: 3%;">STT</th>
                             <th style="width: 15%;">Tên bài tập</th>
                             <th style="width: 15%;">Tên khóa học</th>
                             <th style="width: 15%;">Tác giả bài tập</th>
                             <th style="width: 10%;">Xem trước</th>
                             <th style="width: 20%;">Mô tả</th>
                             <th style="width: 15%; text-align: center;">Hoạt động</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td>1</td>
                             <td>Reading on the Worlds</td>
                             <td>General Books</td>
                             <td>Jhone Steben</td>
                             <td><a href="{{asset('assets/book/book-pdf/hieu-ve-trai-tim.pdf.html')}}"><i class="ri-file-fill text-secondary font-size-18"></i></a></td>
                             <td>
                               <p class="mb-0">Cuốn bài tập đầu tiên của tôi, 'Reading the World' hay 'The World between Two Covers', được biết đến ở Hoa Kỳ, được lấy cảm hứng từ cuộc hành trình kéo dài một năm của tôi thông qua một cuốn bài tập từ mọi quốc gia trên thế giới mà tôi đã ghi lại </p>
                             </td>
                             <td>
                                <div class="flex align-items-center list-user-action text-center">
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="{{route('detailExercise')}}"><i class="ri-eye-line"></i></a>
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Cập nhật" href="{{route('updateExercise')}}"><i class="ri-pencil-line"></i></a>
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