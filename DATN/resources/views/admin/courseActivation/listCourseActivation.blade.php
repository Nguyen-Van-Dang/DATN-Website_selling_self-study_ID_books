@extends('layouts.admin.admin')

@section('title', 'Kích hoạt khoá học')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <livewire:admin.courseActivation.render-course-activation />

        </div>
    </div>

@endsection
