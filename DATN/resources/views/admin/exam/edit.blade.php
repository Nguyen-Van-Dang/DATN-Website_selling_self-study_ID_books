@extends('layouts.admin.admin')

@section('title', 'Sửa đề thi')

@section('content')

    <div class="container-fluid">
        <div class="row">
            @livewire('admin.exam.edit-exam', ['examId' => $examId])
        </div>
    </div>
@endsection
