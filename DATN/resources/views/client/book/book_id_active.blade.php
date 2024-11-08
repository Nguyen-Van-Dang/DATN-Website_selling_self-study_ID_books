@extends('layouts.client.clientBook')

@section('title', 'Kích hoạt ID sách')

@section('content')

    <div class="col-md-4">

        <img src="{{ asset('assets/images/book/user/123.jpg') }}" alt="" style="width:150px" class="d-block mx-auto">
        <div class="row mt-3 mb-3">
            <div class="col-6">
                <img src="{{ asset('assets/images/book/book/01.jpg') }}" alt="" style="width:250px" class="float-end">
            </div>
            <div class="col-6">
                <div class="float-start">
                    <h5 class="mb-3">{{ $book->name }}</h6>
                        <span class="text-dark mb-4 d-block">{{ $book->description }}</span>
                        <div class="text-primary mb-4 iq-border-bottom">Tác giả: <span
                                class="text-body">{{ $book->user->name }}</span></div>
                        <div class="mb-2">
                            <span class="avatar-30 rounded-circle bg-primary d-inline-block mr-2 text-center"><i
                                    class="ri-video-fill"></i></span><span>Khoá học đi kèm</span>
                        </div>
                        <div class="iq-social d-flex align-items-center">
                            <h5 class="mr-2"><a
                                    href="{{ route('khoa-hoc.show', ['id' => $book->courseActivations->first()?->course->id]) }}">
                                    {{ $book->courseActivations->first()?->course->name }}
                                </a></h5>
                        </div>
                        <span class="d-block"><i class="ri-folder-fill"></i> Số bài: 88</span>
                </div>
            </div>
        </div>
        <form action="{{ route('kich-hoat-sach.activate') }}" method="POST" class="px-0">
            @csrf
            <div class="mb-3">
                <p class="text-center mb-0">
                    Nhập mã kích hoạt gồm 16 ký tự ở mặt trong bìa sách
                </p>
                {{-- <label for="book_id" class="form-label"><b>Mã kích hoạt</b></label> --}}
                <input style="font-size: 25px; text-align:center" type="text" name="activation_code" id="activation-code"
                    class="form-control" placeholder="XXXX - XXXX - XXXX - XXXX" maxlength="25" oninput="formatCode(this)">
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                @if (session('error'))
                    <div class="alert alert-danger mt-1">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="text-danger">{{ $error }}<br /></span>
                    @endforeach
                @endif
            </div>
            <div class="form-group submit-btn buttons">
                <input type="submit" value="Kích hoạt" class="btn m-0" style="background: #1BB295; width:100%">
            </div>
            <p>
                Bạn chưa biết cách kích hoạt? <a href="#" class="ex"> Xem hướng đẫn</a>
            </p>
        </form>
    </div>

    <script>
        function formatCode(input) {
            // Remove any non-alphanumeric characters and make uppercase
            let cleaned = input.value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();

            // Limit to 16 characters (without dashes)
            cleaned = cleaned.slice(0, 16);

            // Format the string into groups of 4 characters with a dash
            let formatted = '';
            for (let i = 0; i < cleaned.length; i += 4) {
                if (i + 4 < cleaned.length) {
                    formatted += cleaned.slice(i, i + 4) + ' - ';
                } else {
                    formatted += cleaned.slice(i, i + 4);
                }
            }

            // Set the value to the formatted string
            input.value = formatted;
        }
    </script>



@endsection
