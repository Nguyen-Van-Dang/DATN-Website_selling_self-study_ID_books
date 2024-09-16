@extends('layouts.admin.admin')

@section('title', 'Sửa danh mục sách')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Sửa danh mục sách</h4>
                </div>
             </div>
             <div class="iq-card-body">
                <form action="admin-books.html">
                   <div class="form-group">
                      <label>Tên danh mục sách:</label>
                      <input type="text" class="form-control" placeholder="Nhập tên danh mục sách...">
                   </div>
                   <button type="submit" class="btn btn-primary">Gửi</button>
                   <button type="reset" class="btn btn-danger">Trở lại</button>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>

@endsection