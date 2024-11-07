@extends('layouts.admin.admin')

@section('title', 'Sửa Tài khoản')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Sửa tài khoản</h4>
                </div>
             </div>
             <div class="iq-card-body">
                <form action="admin-author.html">
                   <div class="form-group">
                      <label>Tên tài khoản:</label>
                      <input type="text" class="form-control" placeholder="Nhập tên tài khoản...">
                   </div>
                   <div class="form-group">
                      <label>Ảnh tài khoản:</label>
                      <div class="custom-file">
                         <input type="file" class="custom-file-input" id="customFile">
                         <label class="custom-file-label" for="customFile" style="z-index: 0;">Chọn tập tin</label>
                      </div>
                   </div>
                   <div class="form-group">
                     <label>Phone:</label>
                     <input type="phone" class="form-control" placeholder="Nhập phone...">
                  </div>
                   <div class="form-group">
                      <label>Email:</label>
                      <input type="email" class="form-control" placeholder="Nhập email...">
                   </div>
                   <div class="form-group">
                      <label>Vai trò:</label>
                      <select class="form-control">
                        <option value="1">Admin</option>
                        <option value="2">Giáo viên</option>
                        <option value="3">Học sinh</option>
                    </select>
                   </div>
                   <div class="form-group">
                    <label>Trạng thái:</label>
                    <select class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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
<style>
@endsection