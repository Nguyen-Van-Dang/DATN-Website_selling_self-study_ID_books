@extends('layouts.admin.admin')

@section('title', 'Đơn hàng')
@section('content')
    <div class="container-fluid">
        <div class="row">
            
            <livewire:order.render-order />

         </div>
    </div>
@endsection