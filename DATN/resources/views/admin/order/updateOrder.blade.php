@extends('layouts.admin.admin')

@section('title', 'Trạng thái đơn hàng')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Trạng thái đơn hàng</h4>
                </div>
             </div>
             <div class="iq-card-body">
                <form action="admin-books.html">
                   <div class="form-group">
                      <label>Tên khách hàng:</label>
                      <input type="text" class="form-control">
                   </div>
                   <div class="form-group">
                    <label>Ngày:</label>
                    <input type="text" class="form-control">
                 </div>
                 <div class="form-group">
                    <label>Hóa đơn:</label>
                    <input type="text" class="form-control">
                 </div>
                 <div class="form-group">
                    <label>Số tiền:</label>
                    <input type="text" class="form-control">
                 </div>
                   <div class="form-group">
                      <label>Tình trạng đơn hàng:</label>
                      <select class="form-control" id="exampleFormControlSelect1">
                         <option selected="" disabled="">Tình trạng đơn hàng</option>
                         <option>Đang chuẩn bị hàng</option>
                         <option>Đang giao</option>
                         <option>Giao thành công</option>
                      </select>
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