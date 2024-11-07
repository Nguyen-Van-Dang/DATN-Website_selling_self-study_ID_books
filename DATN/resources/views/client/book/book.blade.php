@extends('layouts.client.client')

@section('title', 'Sách')

@section('content')

    <div class="container-fluid">

        <livewire:book.render-book-client />

    </div>

@endsection
