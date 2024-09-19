@extends('layouts.client.client')

@section('title', '404')

@section('content')

    <div class="container-fluid d-flex justify-content-center align-items-center" style="padding-top: 10%;">
        <img src="{{ asset('assets/images/book/error/404.png') }}" alt="" style="width: 50%;">
    </div>
    <p></p>
    <h4 class="d-flex justify-content-center align-items-center">Not found - không tìm thấy...</p>
        
@endsection
