@extends('layouts.client.master')

@section('title', 'Trang Chủ')
@section('content')
    <div class="container-fluid">
        <div>
            <h1>Trang chủ</h1>
        </div>
    </div>
    <ul class="notifications"></ul>
    <div class="buttons">
        <button class="btn" id="success">Success</button>
        <button class="btn" id="error">Error</button>
        <button class="btn" id="warning">Warning</button>
        <button class="btn" id="info">Info</button>
    </div>
@endsection
