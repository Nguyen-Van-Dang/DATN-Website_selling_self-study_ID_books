@extends('layouts.client.client')

@section('title', 'Làm bài')

@section('content')
    @livewire('client.exam.do-exam', ['examCheck' => $examCheck])
@endsection
