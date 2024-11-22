@extends('layouts.admin.admin')

@section('title', 'Thêm đề thi')

@section('content')

    <div class="container-fluid">
        <div class="row">
            @livewire('admin.exam.create-exam')
        </div>
    </div>
@endsection
