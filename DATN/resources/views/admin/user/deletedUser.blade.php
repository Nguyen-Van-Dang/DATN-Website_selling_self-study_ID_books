@extends('layouts.admin.admin')

@section('title', 'Danh sách tài khoản đã xóa')

@section('content')

    <div class="container-fluid">
        <div class="row">
            
            <livewire:user.deleted-user/>
            
        </div>
    </div>

@endsection