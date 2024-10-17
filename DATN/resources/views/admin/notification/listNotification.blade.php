@extends('layouts.admin.admin')

@section('title', 'Danh sách thông báo')
@section('content')
    <div class="container-fluid">
        <div class="row">
            
            <livewire:notification.render-notification />
            
         </div>
    </div>
@endsection
    