@extends('layouts.admin.admin')

@section('title', 'Danh sách các cuốn sách')

@section('content')

    <div class="container-fluid">
        <div class="row">
            
            <livewire:book.render-book />

        </div>
    </div>

@endsection
