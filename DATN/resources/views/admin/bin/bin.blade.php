@extends('layouts.admin.admin')

@section('title', 'Thùng Rác')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Thùng Rác</h4>
                        </div>
                    </div>
                    <div class="iq-card-body p-0">
                        <div class="iq-edit-list">
                            <ul class="iq-edit-profile d-flex nav nav-pills w-100">
                                @if ($role_id == 1)
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link active" data-toggle="pill" href="#User">
                                            Tài Khoản
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Course">
                                            Khóa Học
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#CourseCate">
                                            Danh Mục Sách
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Book">
                                            Sách
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Contact">
                                            Liên Hệ
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Test">
                                            Đơn hàng
                                        </a>
                                    </li>
                                @elseif ($role_id == 2)
                                    <li class="col-md-4 p-0">
                                        <a class="nav-link active" data-toggle="pill" href="#Course">
                                            Khóa Học
                                        </a>
                                    </li>
                                    <li class="col-md-4 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#CateBook">
                                            Danh Mục Sách
                                        </a>
                                    </li>
                                    <li class="col-md-4 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Book">
                                            Sách
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        @if ($role_id == 1)
                            {{-- tk --}}
                            <div class="tab-pane fade active show" id="User" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Tài khoản đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input"
                                                    placeholder="Tìm kiếm tài khoản..." wire:model.live.debounce.100ms="">
                                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="table-responsive">
                                            <table class="data-tables table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 1%;">STT</th>
                                                        <th style="width: 5%;">Ảnh tài khoản</th>
                                                        <th style="width: 10%;">Tên</th>
                                                        <th style="width: 10%;">Email</th>
                                                        <th style="width: 3%;">Vai trò</th>
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 8%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @livewire('admin.user.user-deleted')
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- kh --}}
                            <div class="tab-pane fade" id="Course" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">khóa học đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input"
                                                    placeholder="Tìm khóa học..."
                                                    wire:model.live.debounce.100ms="searchCourse">
                                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="table-responsive">
                                            <table class="data-tables table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 1%;">STT</th>
                                                        <th style="width: 5%;">Ảnh</th>
                                                        <th style="width: 10%;">Tên khóa học</th>
                                                        <th style="width: 7%;">Giá</th>
                                                        <th style="width: 7%;">Người tạo</th>
                                                        <th style="width: 7%;">Ngày xóa</th>
                                                        <th style="width: 8%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @livewire('admin.course.course-deleted')
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- dms --}}
                            <div class="tab-pane fade" id="CourseCate" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Danh mục sách đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input"
                                                    placeholder="Tìm danh mục sách..."
                                                    wire:model.live.debounce.100ms="searchBookCate">
                                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="table-responsive">
                                            <table class="data-tables table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 5%;">STT</th>
                                                        <th style="width: 20%;">Tên danh mục sách</th>
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @livewire('admin.book-category.delete-bookcate')
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- s --}}
                            <div class="tab-pane fade" id="Book" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Sách đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input" placeholder="Tìm sách..."
                                                    wire:model.live.debounce.100ms="searchBooks">
                                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="table-responsive">
                                            <table class="data-tables table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 1%;">STT</th>
                                                        <th style="width: 5%;">Ảnh sách</th>
                                                        <th style="width: 15%;">Tên sách</th>
                                                        <th style="width: 10%;">Giá sách</th>
                                                        <th style="width: 10%;">Danh mục</th>
                                                        <th style="width: 7%;">Ngày xóa</th>
                                                        <th style="width: 10%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @livewire('admin.book.delete-book')
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- lh --}}
                            <div class="tab-pane fade" id="Contact" role="tabpanel">
                                <div class="iq-card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Liên hệ đã xóa</h4>
                                    <div class="iq-search-bar">
                                        <form class="searchbox">
                                            <input type="text" class="text search-input" placeholder="Tìm liên hệ..."
                                                wire:model.live.debounce.100ms="searchContacts">
                                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                        </form>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="table-responsive">
                                        <table class="data-tables table table-striped table-bordered" style="width:100%">
                                            <thead class="text-center">
                                                <tr>
                                                    <th style="width: 5%;">STT</th>
                                                    <th style="width: 10%;">Tên người gửi</th>
                                                    <th style="width: 40%;">Nội dung</th>
                                                    <th style="width: 10%;">Ngày xóa</th>
                                                    <th style="width: 7%;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @livewire('contact.delete-contact')
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Test" role="tabpanel">
                                <div class="iq-card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Đơn hàng đã xóa</h4>
                                    <div class="iq-search-bar">
                                        <form class="searchbox">
                                            <input type="text" class="text search-input"
                                                placeholder="Tìm bài kiểm tra..."
                                                wire:model.live.debounce.100ms="searchTests">
                                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                        </form>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="table-responsive">
                                        <table class="data-tables table table-striped table-bordered" style="width:100%">
                                            <thead class="text-center">
                                                <tr>
                                                    <th style="width: 5%;">STT</th>
                                                    <th style="width: 20%;">Mã số đơn hàng</th>
                                                    <th style="width: 20%;">số lượng sản phẩm</th>
                                                    <th style="width: 10%;">Ngày xóa</th>
                                                    <th style="width: 7%;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @livewire('order.delete-order')
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @elseif ($role_id == 2)
                            <div class="tab-pane fade active show" id="Course" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">khóa học đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input"
                                                    placeholder="Tìm khóa học..."
                                                    wire:model.live.debounce.100ms="searchCourse">
                                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="table-responsive">
                                            <table class="data-tables table table-striped table-bordered"
                                                style="width:100%">
                                                <table class="data-tables table table-striped table-bordered"
                                                    style="width:100%">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th style="width: 1%;">STT</th>
                                                            <th style="width: 5%;">Ảnh</th>
                                                            <th style="width: 10%;">Tên khóa học</th>
                                                            <th style="width: 7%;">Giá</th>
                                                            <th style="width: 7%;">Người tạo</th>
                                                            <th style="width: 7%;">Ngày xóa</th>
                                                            <th style="width: 8%;">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        @livewire('admin.course.course-deleted')
                                                    </tbody>
                                                </table>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="CateBook" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Danh mục sách đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input"
                                                    placeholder="Tìm danh mục sách..."
                                                    wire:model.live.debounce.100ms="searchBookCate">
                                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="table-responsive">
                                            <table class="data-tables table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 5%;">STT</th>
                                                        <th style="width: 20%;">Tên danh mục sách</th>
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Book" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Sách đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input" placeholder="Tìm sách..."
                                                    wire:model.live.debounce.100ms="searchBooks">
                                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="table-responsive">
                                            <table class="data-tables table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 1%;">STT</th>
                                                        <th style="width: 5%;">Ảnh sách</th>
                                                        <th style="width: 15%;">Tên sách</th>
                                                        <th style="width: 10%;">Giá sách</th>
                                                        <th style="width: 10%;">Danh mục</th>
                                                        <th style="width: 7%;">Ngày xóa</th>
                                                        <th style="width: 10%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @livewire('admin.book.delete-book')
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
