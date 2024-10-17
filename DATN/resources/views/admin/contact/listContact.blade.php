@extends('layouts.admin.admin')

@section('title', 'Danh sách liên hệ')
@section('content')
    <div class="container-fluid">
        <div class="row">
            
         <livewire:contact.render-contact />

         </div>
    </div>
@endsection
