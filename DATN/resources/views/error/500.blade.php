@extends('layouts.client.client')

@section('title', '500')

@section('content')

    <div class="container-fluid d-flex justify-content-center align-items-center" style="padding-top: 10%;">
        <img src="{{ asset('assets/images/book/error/500.png') }}" alt="" style="width: 50%;">
    </div>
    <p></p>
    <h4 class="d-flex justify-content-center align-items-center">Internal Server Error...</p>
        
@endsection
