@extends('layouts.admin.admin')

@section('title', 'Danh sách bài giảng')

@section('content')

<div class="container-fluid">
    <div class="row">
       
      <livewire:lecture.render-lecture />

    </div>
 </div>

@endsection