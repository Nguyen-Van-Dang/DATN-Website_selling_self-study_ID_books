@extends('layouts.admin.admin')

@section('title', 'Kích hoạt khoá học')

@section('content')

    <div class="container-fluid">
        <div class="row">

            @livewire('admin.courseActivation.create-course-activation', ['teachers' => $teachers])


        </div>
    </div>

@endsection
