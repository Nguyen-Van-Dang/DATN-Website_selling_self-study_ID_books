@extends('layouts.client.client')

@section('title', 'Danh sách khóa học')

@section('content')
    @livewireStyles
    @livewire('client.course.carousel-image-upload')

    @livewire('client.course.courseIndex')
    @livewireScripts
@endsection
