@extends('layouts.admin.admin')

@section('title', 'Danh sách các cuốn sách')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Danh sách các cuốn sách</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                   <a href="{{route('addBook')}}" class="btn btn-primary">Thêm sách</a>
                </div>
             </div>
             <div class="iq-card-body">
                <div class="table-responsive">
                   <table class="data-tables table table-striped table-bordered" style="width:100%">
                     <thead>
                         <tr>
                             <th style="width: 3%;">STT</th>
                             <th style="width: 10%;">Hình ảnh</th>
                             <th style="width: 15%;">Tên sách</th>
                             <th style="width: 15%;">Thể loại sách</th>
                             <th style="width: 15%;">Tác giả sách</th>
                             <th style="width: 15%;">Mô tả sách</th>
                             <th style="width: 10%;">Giá</th>
                             <th style="width: 5%;">PDF</th>
                             <th style="width: 20%;">Hoạt động</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td>1</td>
                             <td><img class="img-fluid rounded" src="{{ asset('assets/images/book/book/01.jpg') }}" alt=""></td>
                             <td>Reading on the Worlds</td>
                             <td>General Books</td>
                             <td>Jhone Steben</td>
                             <td>
                               <p class="mb-0">Cuốn sách đầu tiên của tôi, 'Reading the World' hay 'The World between Two Covers', được biết đến ở Hoa Kỳ, được lấy cảm hứng từ cuộc hành trình kéo dài một năm của tôi thông qua một cuốn sách từ mọi quốc gia trên thế giới mà tôi đã ghi lại </p>
                             </td>
                             <td>$89</td>
                             <td><a href="book-pdf.html"><i class="ri-file-fill text-secondary font-size-18"></i></a></td>                                        
                             <td>
                                <div class="flex align-items-center list-user-action">
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                  <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa" href="{{route('updateBook')}}"><i class="ri-pencil-line"></i></a>
                                  <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xoá" href="#"><i class="ri-delete-bin-line"></i></a>
                               </div>
                             </td>
                         </tr>
                         <tr>
                             <td>2</td>
                             <td><img class="img-fluid rounded" src="{{ asset('assets/images/book/book/02.jpg') }}" alt=""></td>
                             <td>The Catcher in the Rye</td>
                             <td>History Books</td>
                             <td>Fritz Wold</td>
                             <td>
                               <p class="mb-0">Cuốn sách đầu tiên của tôi, 'Reading the World' hay 'The World between Two Covers', được biết đến ở Hoa Kỳ, được lấy cảm hứng từ cuộc hành trình kéo dài một năm của tôi thông qua một cuốn sách từ mọi quốc gia trên thế giới mà tôi đã ghi lại </p>
                             </td>
                             <td>$89</td>
                             <td><a href="book-pdf.html"><i class="ri-file-fill text-secondary font-size-18"></i></a></td>                                        
                             <td>
                                <div class="flex align-items-center list-user-action">
                                    <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="#"><i class="ri-eye-line"></i></a>
                                  <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa" href="{{route('updateBook')}}"><i class="ri-pencil-line"></i></a>
                                  <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa" href="#"><i class="ri-delete-bin-line"></i></a>
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