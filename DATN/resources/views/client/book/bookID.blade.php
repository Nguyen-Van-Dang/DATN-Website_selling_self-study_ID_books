@extends('layouts.client.clientBook')

@section('title', 'Kích hoạt ID sách')

@section('content')


<div class="couser" style="  padding: 20px;
  background: #0dd6b8;
  font-size: 20px;
  font-weight: bold;
  color: #444444;"><a href="{{ route('homeClient') }}" style="text-decoration:none">Trở về</a></div>
<ul class="notifications"
    style="background: white; box-shadow: 0px 5px 20px 0px rgb(52 70 84 / 10%); padding-bottom: 10px; border-radius: 10px;">
</ul>
<div class="book">
    <form action="#">
      <h2><img src="{{ asset('assets/images/book/user/123.jpg') }}" alt=""></h2>
      <div class="form-group fullname">
        <label for="fullname">ID Sách</label>
        <input type="text" id="fullname" style="font-weight: bold; border-radius: 10px;" placeholder="Điền số ID từ bìa trước sách">
      </div>
      <div class="form-group email">
        <label for="text">Mã cào kích hoạt</label>
        <input type="text" id="text" style="font-weight: bold; border-radius: 10px;" placeholder="Điền mã kích hoạt từ bìa phụ sách (5 kí tự)">
      </div>

            {{-- <div class="form-group submit-btn">
        <input type="submit" value="Kích hoạt">
      </div> --}}

            <div class="form-group submit-btn buttons">
                <input type="submit" value="Kích hoạt" class="btn" id="success" style="background: #1BB295;">
            </div>

            <div class="form-group">
                <div class="col-md-8">
                    Bạn chưa biết cách kích hoạt? <a href="#" class="ex"> Xem hướng đẫn</a>
                </div>
            </div>
        </form>
    </div>
@endsection
