@extends('layouts.admin.admin')

@section('title', 'Sửa bài tập')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                   <h4 class="card-title">Sửa bài tập</h4>
                </div>
             </div>
             <div class="iq-card-body">
                <form action="admin-books.html">
                   <div class="form-group">
                      <label>Tên bài tập:</label>
                      <input type="text" class="form-control" placeholder="Nhập tên bài tập...">
                   </div>
                   <div class="form-group">
                      <label>Tên khóa học:</label>
                      <select class="form-control" id="exampleFormControlSelect1">
                         <option selected="" disabled="">Khóa học</option>
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
                      <label>Tác gải bài tập:</label>
                      <select class="form-control" id="exampleFormControlSelect2">
                         <option selected="" disabled="">Tác giả bài tập</option>
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
                      <label>bài tập excel:</label>
                      <div class="custom-file">
                         <input type="file" class="custom-file-input" accept="application/excel, application/vnd.ms-excel">
                         <label class="custom-file-label">Chọn file</label>
                      </div>
                   </div>
                   <form action="#">
                    <!-- Other form fields -->
                    <div class="form-group">
                       <label for="question">Câu hỏi:</label>
                       <input type="text" class="form-control" id="question" placeholder="Nhập câu hỏi...">
                    </div>
                    <div id="answerSection" style="display: none; padding-left: 5%;">
                       <div class="form-group">
                          <label for="answer1">Đáp án A:</label>
                          <input type="text" class="form-control" id="answer1" placeholder="Nhập đáp án 1">
                       </div>
                       <button type="submit" class="btn btn-primary">Thêm đáp án</button>
                    </div>
                 </form>
                   <div class="form-group">
                      <label>Nội dung:</label>
                      <textarea class="form-control" rows="4" placeholder="Nhập nội dung..."></textarea>
                   </div>
                   <button type="submit" class="btn btn-primary">Gửi</button>
                   <button type="reset" class="btn btn-danger">Trở lại</button>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>
 <script>
    document.getElementById('question').addEventListener('input', function() {
        const answerSection = document.getElementById('answerSection');
        if (this.value.trim() !== '') {
            answerSection.style.display = 'block';
        } else {
            answerSection.style.display = 'none';
        }
    });
 </script>
@endsection