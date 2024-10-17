@extends('layouts.admin.admin')

@section('title', 'Danh sách danh mục khóa học')

@section('content')

    <div class="container-fluid">
        <div class="row">
            
            <livewire:courseCate.render-courseCate />

        </div>
    </div>

@endsection
