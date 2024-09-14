@extends('layouts.admin.admin')

@section('title', 'Thêm khóa học')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Thêm khóa học</h4>
                </div>
             </div>
             <div class="iq-card-body">
                <form action="admin-books.html">
                   <div class="form-group">
                      <label>Tên khóa học:</label>
                      <input type="text" class="form-control">
                   </div>
                   <div class="form-group">
                      <label>Danh mục khóa học:</label>
                      <select class="form-control" id="exampleFormControlSelect1">
                         <option selected="" disabled="">Danh mục khóa học</option>
                         <option>General Books</option>
                         <option>History Books</option>
                         <option>Horror Story</option>
                         <option>Arts Books</option>
                         <option>Film & Photography</option>
                         <option>Business & Economics</option>
                         <option>Comics & Mangas</option>
                         <option>Computers & Internet</option>
                         <option> Sports</option>
                         <option> Travel & Tourism</option>
                      </select>
                   </div>
                   <div class="form-group">
                      <label>Tác gải khóa học:</label>
                      <select class="form-control" id="exampleFormControlSelect2">
                         <option selected="" disabled="">Tác giả khóa học</option>
                         <option>Jhone Steben</option>
                         <option>John Klok</option>
                         <option>Ichae Semos</option>
                         <option>Jules Boutin</option>
                         <option>Kusti Franti</option>
                         <option>David King</option>
                         <option>Henry Jurk</option>
                         <option>Attilio Marzi</option>
                         <option>Argele Intili</option>
                         <option>Attilio Marzi</option>
                      </select>
                   </div>
                   <div class="form-group">
                      <label>Hình ảnh:</label>
                      <div class="custom-file">
                         <input type="file" class="custom-file-input" accept="image/png, image/jpeg">
                         <label class="custom-file-label">Choose file</label>
                      </div>
                   </div>
                   <div class="form-group">
                      <label>khóa học pdf:</label>
                      <div class="custom-file">
                         <input type="file" class="custom-file-input" accept="application/pdf, application/vnd.ms-excel">
                         <label class="custom-file-label">Chọn file</label>
                      </div>
                   </div>
                   <div class="form-group">
                      <label>Giá khóa học:</label>
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