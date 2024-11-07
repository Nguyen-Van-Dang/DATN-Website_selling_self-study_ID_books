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
                                    <li class="col-md-1 p-0">
                                        <a class="nav-link active" data-toggle="pill" href="#User">
                                            Tài Khoản
                                        </a>
                                    </li>
                                    <li class="col-md-1 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Reels">
                                            Reels
                                        </a>
                                    </li>
                                    <li class="col-md-1 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Book">
                                            Sách
                                        </a>
                                    </li>
                                    <li class="col-md-1 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Course">
                                            Khóa Học
                                        </a>
                                    </li>
                                    <li class="col-md-1 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Notification">
                                            Thông Báo
                                        </a>
                                    </li>
                                    <li class="col-md-1 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Contact">
                                            Liên Hệ
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#CourseCate">
                                            Danh Mục Sách
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Test">
                                            Bài Kiểm Tra
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Bin">
                                            Nhóm Chat
                                        </a>
                                    </li>
                                @elseif ($role_id == 2)
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Reels">
                                            Reels
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Course">
                                            Khóa Học
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Book">
                                            Sách
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#CourseCate">
                                            Danh Mục Sách
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Test">
                                            Bài Kiểm Tra
                                        </a>
                                    </li>
                                    <li class="col-md-2 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#Bin">
                                            Nhóm Chat
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
                            {{-- admin --}}
                            <div class="tab-pane fade active show" id="User" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Tài Khoản đã xóa</h4>
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
                                                        <th style="width: 5%;">STT</th>
                                                        <th style="width: 10%;">Tên</th>
                                                        <th style="width: 10%;">Email</th>
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    {{-- @foreach ($deletedUsers as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('user.restore', $user->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('user.forceDelete', $user->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Reels" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Reels đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input"
                                                    placeholder="Tìm reels..."
                                                    wire:model.live.debounce.100ms="searchUser">
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
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    {{-- @foreach ($deletedReels as $reel)
                                                <tr>
                                                    <td>{{ $reel->id }}</td>
                                                    <td>{{ $reel->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('reel.restore', $reel->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('reel.forceDelete', $reel->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                        <th style="width: 5%;">STT</th>
                                                        <th style="width: 20;">Tên danh mục khóa học</th>
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    {{-- @foreach ($deletedCourses as $course)
                                                <tr>
                                                    <td>{{ $course->id }}</td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('course.restore', $course->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('course.forceDelete', $course->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                    {{-- @foreach ($deletedCategories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('category.restore', $category->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('category.forceDelete', $category->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
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
                                                        <th style="width: 5%;">STT</th>
                                                        <th style="width: 20%;">Tên sách</th>
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    {{-- @foreach ($deletedBooks as $book)
                                                <tr>
                                                    <td>{{ $book->id }}</td>
                                                    <td>{{ $book->name }}</td>
                                                    <td>{{ $book->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('book.restore', $book->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('book.forceDelete', $book->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Notification" role="tabpanel">
                                <div class="iq-card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Thông báo đã xóa</h4>
                                    <div class="iq-search-bar">
                                        <form class="searchbox">
                                            <input type="text" class="text search-input"
                                                placeholder="Tìm thông báo..."
                                                wire:model.live.debounce.100ms="searchNotification">
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
                                                    <th style="width: 40%;">Nội dung</th>
                                                    <th style="width: 10%;">Ngày xóa</th>
                                                    <th style="width: 7%;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                {{-- @foreach ($deletedNotifications as $notification)
                                                <tr>
                                                    <td>{{ $notification->id }}</td>
                                                    <td>{{ $notification->content }}</td>
                                                    <td>{{ $notification->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('notification.restore', $notification->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('notification.forceDelete', $notification->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

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
                                                {{-- @foreach ($deletedNotifications as $notification)
                                                <tr>
                                                    <td>{{ $notification->id }}</td>
                                                    <td>{{ $notification->user->name }}</td>
                                                    <td>{{ $notification->content }}</td>
                                                    <td>{{ $notification->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('notification.restore', $notification->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('notification.forceDelete', $notification->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Test" role="tabpanel">
                                <div class="iq-card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Bài kiểm tra đã xóa</h4>
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
                                                    <th style="width: 20%;">Tên bài kiểm tra</th>
                                                    <th style="width: 20%;">Tên khóa học</th>
                                                    <th style="width: 10%;">Ngày xóa</th>
                                                    <th style="width: 7%;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                {{-- @foreach ($deletedTests as $test)
                                                <tr>
                                                    <td>{{ $test->id }}</td>
                                                    <td>{{ $test->name }}</td>
                                                    <td>{{ $test->course->name }}</td>
                                                    <td>{{ $test->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('test.restore', $test->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('test.forceDelete', $test->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Bin" role="tabpanel">
                                <div class="iq-card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Nhóm chat đã xóa</h4>
                                    <div class="iq-search-bar">
                                        <form class="searchbox">
                                            <input type="text" class="text search-input"
                                                placeholder="Tìm nhóm chat..."
                                                wire:model.live.debounce.100ms="searchChats">
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
                                                    <th style="width: 20%;">Tên nhóm chat</th>
                                                    <th style="width: 10%;">Ngày xóa</th>
                                                    <th style="width: 7%;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                {{-- @foreach ($deletedTests as $test)
                                                <tr>
                                                    <td>{{ $test->id }}</td>
                                                    <td>{{ $test->name }}</td>
                                                    <td>{{ $test->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('test.restore', $test->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('test.forceDelete', $test->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @elseif ($role_id == 2)
                            {{-- giáo viên --}}
                            <div class="tab-pane fade active show" id="Reels" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Reels đã xóa</h4>
                                        <div class="iq-search-bar">
                                            <form class="searchbox">
                                                <input type="text" class="text search-input"
                                                    placeholder="Tìm reels..."
                                                    wire:model.live.debounce.100ms="searchUser">
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
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    {{-- @foreach ($deletedReels as $reel)
                                                <tr>
                                                    <td>{{ $reel->id }}</td>
                                                    <td>{{ $reel->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('reel.restore', $reel->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('reel.forceDelete', $reel->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                        <th style="width: 5%;">STT</th>
                                                        <th style="width: 20;">Tên danh mục khóa học</th>
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    {{-- @foreach ($deletedCourses as $course)
                                                <tr>
                                                    <td>{{ $course->id }}</td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('course.restore', $course->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('course.forceDelete', $course->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                    {{-- @foreach ($deletedCategories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('category.restore', $category->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('category.forceDelete', $category->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
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
                                                        <th style="width: 5%;">STT</th>
                                                        <th style="width: 20%;">Tên sách</th>
                                                        <th style="width: 10%;">Ngày xóa</th>
                                                        <th style="width: 7%;">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    {{-- @foreach ($deletedBooks as $book)
                                                <tr>
                                                    <td>{{ $book->id }}</td>
                                                    <td>{{ $book->name }}</td>
                                                    <td>{{ $book->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('book.restore', $book->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('book.forceDelete', $book->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Test" role="tabpanel">
                                <div class="iq-card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Bài kiểm tra đã xóa</h4>
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
                                                    <th style="width: 20%;">Tên bài kiểm tra</th>
                                                    <th style="width: 20%;">Tên khóa học</th>
                                                    <th style="width: 10%;">Ngày xóa</th>
                                                    <th style="width: 7%;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                {{-- @foreach ($deletedTests as $test)
                                                <tr>
                                                    <td>{{ $test->id }}</td>
                                                    <td>{{ $test->name }}</td>
                                                    <td>{{ $test->course->name }}</td>
                                                    <td>{{ $test->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('test.restore', $test->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('test.forceDelete', $test->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Bin" role="tabpanel">
                                <div class="iq-card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Nhóm chat đã xóa</h4>
                                    <div class="iq-search-bar">
                                        <form class="searchbox">
                                            <input type="text" class="text search-input"
                                                placeholder="Tìm nhóm chat..."
                                                wire:model.live.debounce.100ms="searchChats">
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
                                                    <th style="width: 20%;">Tên nhóm chat</th>
                                                    <th style="width: 10%;">Ngày xóa</th>
                                                    <th style="width: 7%;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                {{-- @foreach ($deletedTests as $test)
                                                <tr>
                                                    <td>{{ $test->id }}</td>
                                                    <td>{{ $test->name }}</td>
                                                    <td>{{ $test->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('test.restore', $test->id) }}"
                                                            class="btn btn-success">Khôi phục</a>
                                                        <a href="{{ route('test.forceDelete', $test->id) }}"
                                                            class="btn btn-danger">Xóa vĩnh viễn</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            </tbody>
                                        </table>
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
