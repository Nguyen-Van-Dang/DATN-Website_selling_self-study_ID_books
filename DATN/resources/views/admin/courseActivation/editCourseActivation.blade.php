@extends('layouts.admin.admin')

@section('title', 'Kích hoạt khoá học')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Xem liên kết kích hoạt</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form action="{{ route('admin.kich-hoat-sach.update', $courseActivation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 d-flex">
                                    <label>Tác giả</label>
                                    <div class="icon iq-icon-box mr-3">
                                        <a href="javascript:void();">
                                            <img class="img-fluid avatar-60 rounded-circle"
                                                src="{{ $courseActivation->course->user->images()->where('image_name', 'avatar')->first() ? $courseActivation->course->user->images()->where('image_name', 'avatar')->first()->image_url : asset('assets/images/book/user_thumbnail.png') }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="mt-1">
                                        <h6> {{ $courseActivation->course->user->name }}</h6>
                                        <p class="mb-0 text-primary">Số lượng sách:
                                            {{ count($courseActivation->course->user->courses) }}</p>
                                        <p class="mb-0 text-primary">Số lượng khóa học:
                                            {{ count($courseActivation->course->user->books) }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label>Sách kích hoạt</label>
                                        <select class="form-control" name="selectedBook">
                                            <option selected="" disabled>{{ $courseActivation->book->name }}</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group d-flex justify-content-center">
                                                @if ($courseActivation->book->images()->where('image_name', 'thumbnail')->first())
                                                    <img src="{{ $courseActivation->book->images()->where('image_name', 'thumbnail')->first()->image_url }}"
                                                        alt="Ảnh sách" class="img-thumbnail"
                                                        style="height: 200px !important;">
                                                @else
                                                    <img src="{{ asset('assets/images/book/book_placeholder.png') }}"
                                                        alt="Click to choose image" class="img-thumbnail"
                                                        style="height: 200px !important;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Thông tin sách</label>
                                                <div>
                                                    <h6 class="mb-1">
                                                        {{ $courseActivation->book->name }}
                                                    </h6>
                                                    <p>{{ $courseActivation->book->description }}</p>
                                                    <span class="d-block">
                                                        <i class="ri-calendar-fill"></i>Ngày đăng:
                                                        {{ \Carbon\Carbon::parse($courseActivation->book->created_at)->format('d-m-Y') }}</span>

                                                    <span class="d-block">
                                                        <i class="ri-pages-fill"></i>Số trang:
                                                        {{ $courseActivation->book->page_number }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label>Khoá học kích hoạt</label>
                                        <select class="form-control" name="selectedCourse">
                                            <option selected="" disabled>{{ $courseActivation->course->name }}</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6 col-sm-12">
                                            <div class="form-group d-flex justify-content-center">
                                                @if ($courseActivation->course->images()->where('image_name', 'thumbnail')->first())
                                                    <img src="{{ $courseActivation->course->images()->where('image_name', 'thumbnail')->first()->image_url }}"
                                                        alt="Click to choose image" class="img-thumbnail">
                                                @else
                                                    <img src="{{ asset('assets/images/book/course_thumbnail.png') }}"
                                                        alt="Click to choose image" class="img-thumbnail">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Thông tin khoá học</label>
                                                <div>
                                                    <h6 class="mb-1">
                                                        {{ $courseActivation->course->name }}
                                                    </h6>
                                                    <p>{{ $courseActivation->course->description }}</p>
                                                    <span class="d-block">
                                                        <i class="ri-calendar-fill"></i>Ngày đăng:
                                                        {{ \Carbon\Carbon::parse($courseActivation->course->created_at)->format('d-m-Y') }}</span>

                                                    <span class="d-block">
                                                        <i class="ri-play-circle-fill"></i>Số bài giảng:
                                                        {{ $courseActivation->course->lectures->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Tạo mã kích hoạt</label>
                                        <div class="custom-file">
                                            <input type="number" class="form-control" value="{{ count($codes) }}"
                                                readonly>
                                        </div>
                                        <p class="text-muted small mt-3">
                                            Số lượng mã = số lượng sách tồn kho
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Người dùng đã kích hoạt:</label>
                                        <div class="iq-card-body px-0" style="max-height:200px; overflow-y: auto;">
                                            @if ($codes && $codes->count() > 0)
                                                @foreach ($codes as $code)
                                                    <div class="iq-sub-card">
                                                        <div class="media align-items-center mb-1">
                                                            <div>
                                                                <img src="{{ $courseActivation->course->user->images()->where('image_name', 'avatar')->first() ? $courseActivation->course->user->images()->where('image_name', 'avatar')->first()->image_url : asset('assets/images/book/user_thumbnail.png') }}"
                                                                    alt="avatar" class="d-flex align-self-center me-3"
                                                                    style="width: 40px">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0">
                                                                    {{ $code->user->name }}
                                                                </h6>
                                                                <small class="float-right font-size-12 pr-1">
                                                                    {{ $code->activation_date ? \Carbon\Carbon::parse($code->activation_date)->format('d-m-Y') : 'Chưa kích hoạt' }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>Chưa có người kích hoạt</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái hoạt động:</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="emailnotification"
                                        value="1" {{ $courseActivation->status == 0 ? 'checked' : '' }}
                                        name="status">
                                    <label class="custom-control-label" for="emailnotification"></label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Lưu thông tin
                            </button>

                            <a href="{{ route('admin.kich-hoat-sach.index') }}" class="btn btn-danger">Trở lại</a>

                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>

@endsection
