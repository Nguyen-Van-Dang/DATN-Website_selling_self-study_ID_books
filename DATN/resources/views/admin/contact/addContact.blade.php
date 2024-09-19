@extends('layouts.admin.admin')

@section('title', 'Gửi liên hệ')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Gửi liên hệ</h4>
                </div>
             </div>
             <div class="iq-card-body">
                <form action="admin-books.html">
                   <div class="form-group">
                      <label>Tên tài khoản:</label>
                      <input type="text" class="form-control">
                   </div>
                   <div class="form-group">
                      <label>Nội dung:</label>
                      <textarea class="form-control" rows="4"></textarea>
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