@extends('layouts.client.clientBook')
@section('content')

    <div class="col-md-4">
        <img src="{{ asset('assets/images/book/user/123.jpg') }}" alt="" style="width:150px" class="d-block mx-auto">
        <form action="{{ route('kich-hoat-sach.redirect') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="book_id" class="form-label"><b>ID Sách</b></label>
                <input type="text" name="book_id" class="form-control" id="book_id" style="border-radius: 10px;"
                    placeholder="Điền số ID từ bìa trước sách">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="text-danger">{{ $error }}<br /></span>
                    @endforeach
                @endif
            </div>
            <div class="form-group submit-btn buttons">
                <input type="submit" value="Kích hoạt" class="btn m-0" style="background: #1BB295; width:100%">
            </div>
            <div class="image">
                <p>ID sách có thể tìm thấy ở góc bìa của quyển sách</p>
                <img src="{{ asset('assets/images/book/book_active_tutorial2.png') }}" alt="" style="height:303px;">
            </div>
            <p>
                Bạn chưa biết cách kích hoạt? <a href="#" class="ex"> Xem hướng đẫn</a>

            </p>


        </form>

    </div>
@endsection
