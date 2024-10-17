@extends('layouts.admin.admin')

@section('title', 'Danh sách tài khoản')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <livewire:user.render-user />

        </div>
    </div>

@endsection
