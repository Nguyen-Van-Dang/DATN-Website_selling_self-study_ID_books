@extends('layouts.admin.admin')

@section('title', 'Danh mục Sách')

@section('content')

<div class="container-fluid">
    <div class="row">
       
      <livewire:bookCate.render-bookCate />
      
    </div>
 </div>

@endsection