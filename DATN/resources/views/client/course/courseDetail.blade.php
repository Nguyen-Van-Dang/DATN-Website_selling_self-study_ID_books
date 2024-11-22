@extends('layouts.client.client')

@section('title', 'Chi Tiết khóa học')

@section('content')

    <div class="container-fluid">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
            <div class="row">
                <div class="col-12 col-md-4 order-1 order-md-1">
                    <img src="{{ $course->image_url }}" class="img-fluid rounded" alt="Course Image"
                        style="object-fit: cover;aspect-ratio: 2/1; height: 250px;;">
                </div>
                <div class="col-12 col-md-8 order-2 order-md-2"style="border-right: 0.5px solid #8080804f;">
                    <h5 class="mb-0">{{ $course->name }}</h5>
                    <p class="text-muted mb-1">Thầy {{ $course->user->name }}</p>
                    <div class="d-flex justify-content-evenly mt-3 flex-nowrap">
                        <span class="text-danger font-weight-bold">{{ number_format($course->price) }}đ</span>
                        <span class="text-muted ml-3"
                            style="text-decoration:line-through">{{ number_format($course->discount) }}đ</span>
                    </div>
                    <p class="mb-2">
                        <span class="d-block"><i class="bi bi-collection-play"></i> Số bài:
                            {{ $course->amount_lecture }}</span>
                        <a href="#" class="text-primary d-block mt-1"><i class="bi bi-people"></i> Nhóm Mooners</a>
                    </p>
                    <div class="d-flex">
                        <button class="btn btn-danger btn-lg mr-2">Mua ngay</button>
                        <button class="btn btn-secondary btn-lg">Kích hoạt</button>
                    </div>
                </div>

                <div class="col-12 col-md-12 order-2 order-md-2">
                    <p class="mb-2 fw-bold">{{ $course->description }}</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item mr-2">
                            <button class="nav-link active" id="bai-giang-tab" data-bs-toggle="tab"
                                data-bs-target="#bai-giang" type="button" role="tab" aria-controls="bai-giang"
                                aria-selected="true">
                                Bài giảng
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="bai-kiem-tra-tab" data-bs-toggle="tab"
                                data-bs-target="#bai-kiem-tra" type="button" role="tab" aria-controls="bai-kiem-tra"
                                aria-selected="false">
                                Bài kiểm tra
                            </button>
                        </li>
                    </ul>

                    <div class="tab-pane fade show active" id="bai-giang" role="tabpanel" aria-labelledby="bai-giang-tab">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach ($course->lectures->groupBy('lecture_categories_id') as $categoryId => $lectures)
                                <div class="course-panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading{{ $categoryId }}">
                                        <h6 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapse{{ $categoryId }}" aria-expanded="false"
                                                aria-controls="collapse{{ $categoryId }}">
                                                {{ $lectures->first()->lectureCategory->name ?? 'Chương ' . $categoryId }}
                                                <!-- Tên chương -->
                                            </a>
                                            <span class="badge bg-danger rounded-pill position-absolute"
                                                style="right: 0; top: 0;">
                                                {{ $lecturesCountByCategory[$categoryId] ?? 0 }}
                                                <!-- Số lượng bài giảng trong danh mục -->
                                            </span>
                                        </h6>
                                    </div>
                                    <div id="collapse{{ $categoryId }}" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="heading{{ $categoryId }}">
                                        <div class="panel-body" style="margin-left: 45px">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($lectures as $lecture)
                                                    <li class="list-group-item py-0">   
                                                       
                                                        <a href="{{ route('khoa-hoc.chitiet', ['course_id' => $course->id, 'lecture_id' => $lecture->id]) }}">
                                                            {{ $lecture->name }}
                                                        </a>
                                                                                                             
                                                        <!-- Liên kết đến bài giảng -->
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
                    <div class="row">
                        <div class="col-3">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('assets/images/book/user/3.jpg') }}" alt="Giảng viên"
                                    class="rounded-circle me-3" style="width: 100px; height: 100px;">
                            </div>
                        </div>
                        <div class="col-9">
                            <div>
                                <h5 class="mb-0">Thầy {{ $course->user->name }} <i
                                        class="bi bi-check-circle-fill text-success"></i>
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-2 pb-3">
                                <div class="text-center">
                                    <h6 class="mb-0">162K</h6>
                                    <small class="text-muted">Views</small>
                                </div>
                                <div class="text-center">
                                    <h6 class="mb-0">672</h6>
                                    <small class="text-muted">Likes</small>
                                </div>
                                <div class="text-center">
                                    <h6 class="mb-0">594</h6>
                                    <small class="text-muted">Followers</small>
                                </div>
                                <div class="text-center border-left pl-3">
                                    <h6 class="mb-0">594 Thành viên</h6>
                                    <small class="text-muted"><a href="#">Truy cập nhóm chat</a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>
                            - Hơn 15 năm kinh nghiệm giảng dạy và luyện thi: 10 năm luyện thi THPT và 5 năm luyện thi ĐGNL
                            ĐHQG TP.HCM<br>
                            - Thạc sĩ ngành Di truyền học, Cử nhân ngành Công nghệ Sinh học, trường Đại học KHTN, ĐHQG
                            TP.HCM<br>
                            - Tham gia học văn bằng 2 ngành Ngôn ngữ Anh, trường Đại học KHXH&NV, ĐHQG TP.HCM
                        </p>
                    </div>
                    <div class="modal-content">
                        <h5 class="mb-0">Khóa học nổi bậc</h5>

                        <div class="iq-card-body pt-0 py-3 modal-body-scrollable">

                            @foreach ($user->courses as $userCourse)
                                <div class="row pb-2">
                                    <div class="col-3">
                                        <img src="https://cdn.mclass.vn/blog/uploads/2024/06/28134058/z5581767185476_8dde1beb2c61f7600912c0684e0a1435.jpg"
                                            class="card-img-top img-fluid rounded course-image" alt="Product 3"
                                            style="aspect-ratio: 1/1; object-fit: cover; transition: transform 0.3s ease;">
                                    </div>
                                    <div class="col-9">
                                        <a href="" class="card-title course-title">
                                            <h6 class="panel-title">
                                                {{ $userCourse->name }}
                                            </h6>
                                        </a>
                                        <div class="d-flex justify-content-evenly mt-1 flex-nowrap"
                                            style="font-size: 15px">
                                            <span class="text-danger font-weight-bold">{{ number_format($course->price) }}
                                                đ</span>
                                            <span class="text-muted ml-3"
                                                style="text-decoration:line-through">{{ number_format($course->discount) }}
                                                đ</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .modal-content {
                max-height: 50vh;
                overflow-y: auto;
                padding-right: 15px;
                border: none;
            }

            .modal-body-scrollable {
                max-height: calc(45vh - 100px);
                overflow-y: auto;
            }
        </style>
        <style>
            #accordion .course-panel {
                border: none;
                border-radius: 0;
                box-shadow: none;
                margin-bottom: 25px;
                position: relative;
            }

            #accordion .course-panel:before {
                content: "";
                width: 1px;
                height: 100%;
                border: 1px dashed #6e8898;
                position: absolute;
                top: 25px;
                left: 18px;
            }

            #accordion .course-panel:last-child:before {
                display: none;
            }

            #accordion .panel-heading {
                padding: 0;
                border: none;
                border-radius: 0;
                position: relative;
            }

            #accordion .panel-title a {
                padding: 10px 30px 10px 60px;
                margin: 3px;
                background: #fff;
                letter-spacing: 1px;
                color: #1d3557;
                border-radius: 0;
                position: relative;
            }

            #accordion .panel-title a:before,
            #accordion .panel-title a.collapsed:before {
                content: "\f107";
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                width: 40px;
                height: 100%;
                line-height: 40px;
                background: #8a8ac3;
                border: 1px solid #8a8ac3;
                border-radius: 3px;
                font-size: 17px;
                color: #fff;
                text-align: center;
                position: absolute;
                top: 0;
                left: 0;
                transition: all 0.3s ease 0s;
            }

            #accordion .panel-title a.collapsed:before {
                content: "\f105";
                background: #fff;
                border: 1px solid #6e8898;
                color: #000;
            }

            #accordion .panel-body {
                padding: 10px 30px 10px 30px;
                margin-left: 40px;
                background: #fff;
                border-top: none;
                font-size: 15px;
                color: #6f6f6f;
                line-height: 28px;
                letter-spacing: 1px;
            }
        </style>
    </div>
@endsection
