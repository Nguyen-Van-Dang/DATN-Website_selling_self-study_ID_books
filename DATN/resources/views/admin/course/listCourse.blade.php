@extends('layouts.admin.admin')

@section('title', 'Danh sách khóa học')

@section('content')

    <div class="container-fluid">
        <div class="row">
            
            <livewire:course.render-course />

        </div>
    </div>

@endsection
