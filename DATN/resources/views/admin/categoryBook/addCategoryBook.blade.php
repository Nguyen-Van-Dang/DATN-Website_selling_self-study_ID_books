@extends('layouts.admin.admin')

@section('title', 'Thêm danh mục sách')

@section('content')

    <div class="container-fluid">
        <div class="row mx-0 justify-content-center">
            <div class="col-sm-6">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Thêm danh mục sách</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form action="{{ route('admin.danh-muc-sach.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" class="form-control" placeholder="Nhập tên danh mục sách..."
                                    name="category_name">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả:</label>
                                <textarea class="form-control" name="category_description" id="" cols="30" rows="3"
                                    placeholder="Nhập mô tả"></textarea>
                                @error('category_description')
                                    <span class="text-danger">{{ $message }}<br /></span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                            <a href="{{ route('admin.danh-muc-sach.index') }}"><button class="btn btn-danger">Trở
                                    lại</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
