@extends('layouts.client.client')

@section('title', 'Tin nhắn')

@section('content')

    <div class="container-fluid d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/images/book/error/groupchat.png') }}" alt="">
        <div class="text-center mt-5">
            <h4>Bạn chưa tham gia nhóm chat nào!</h4>
            <p>Truy cập khoá học của bạn để tham gia.</p>
            <a href="{{ route('hoc-tap') }}">
                <button class="btn btn-success mt-3"><b>Tham gia ngay !</b></button>
            </a>
        </div>
    </div>

@endsection
