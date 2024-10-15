@extends('layouts.admin.admin')

@section('title', 'Thêm Test')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Thêm test</h4>
                </div>
             </div>
             <div class="iq-card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('handleImage')}}">
                    @csrf
                   <div class="form-group">
                      <label>Ảnh test:</label>
                      <div class="custom-file">
                         <input type="file" class="custom-file-input" id="customFile" name="thumbnail" required>
                         <label class="custom-file-label" for="customFile" >Chọn tập tin</label>
                      </div>
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