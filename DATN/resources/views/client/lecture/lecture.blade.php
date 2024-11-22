@extends('layouts.client.clientLecture')

@section('title', 'Học khóa học')

@section('content')

    {{-- <div>
        <div class="course" style="padding: 20px; background: #0dd6b8; font-size: 20px; font-weight: bold; color: #444444;">
            <a href="{{ route('homeClient') }}" style="text-decoration:none">Trở về</a>
        </div>

        <div class="row" style="height: 90vh; width: 100%;">
            <div class="col-lg-9" style="padding: 0; height: 90vh; background: black">
                <source src="{{ $lecture->video_url }}" type="video/mp4">
                <div class="d-flex align-items-center osahan-post-header p-10"
                    style=" background: black; margin-left: 10%; margin-top: 3%">
                    <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                        style="width: 5%;" />
                    <div class="p-2"></div>
                    <div class="font-weight-bold mr-3">
                        <div class="text-truncate" style="font-weight: bolder; color: white">Thầy Nguyễn Văn A</div>
                    </div>
                    <button id="yesButton" type="submit"
                        style="background-color: #ff4d6d; color: white; border: none; padding: 10px 45px; font-size: 14px; border-radius: 5px; cursor: pointer; font-weight: bolder;">Theo
                        dõi</button>
                </div>
            </div>
            <div class="col-lg-3" style="height: 90vh;">
                <div id="accordion">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex align-items-center bg-light osahan-post-header">
                                    <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                        alt="" style="width: 15%;" />
                                    <div class="pe-2"></div>
                                    <div class="font-weight-bold mr-3">
                                        <div class="text-truncate" style="font-weight: bolder;">Thầy Nguyễn Văn A</div>
                                    </div>
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="false" aria-controls="collapseOne">
                                    <div class="d-flex align-items-center bg-light osahan-post-header">
                                        <div class="font-weight-bold mr-3">
                                            <div class="text-truncate" style="font-weight: bolder;">Bình luận</div>
                                        </div>
                                    </div>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="box shadow-sm rounded bg-white"
                                    style="height: calc(90vh - 80px); overflow: hidden;">
                                    <div class="box-body p-0" style="height: calc(100% - 50px); overflow-y: auto;">
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
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="d-flex align-items-center bg-light osahan-post-header">
                                        <div class="font-weight-bold mr-3">
                                            <div class="text-truncate" style="font-weight: bolder;">Bình luận</div>
                                        </div>
                                    </div>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="box shadow-sm rounded bg-white"
                                    style="height: calc(90vh - 80px); overflow: hidden;">
                                    <div class="box-body p-0" style="height: calc(100% - 50px); overflow-y: auto;">
                                        <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle"
                                                    src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                                                    style="width: 40%;" />
                                            </div>
                                            <div class="mr-3">
                                                <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div>
        <div class="course" style="padding: 20px; background: #0dd6b8; font-size: 20px; font-weight: bold; color: #444444;">
            <a href="{{ route('khoa-hoc.index') }}" style="text-decoration:none">Trở về</a>
        </div>

        <div class="row" style="height: 90vh; width: 100%;">
            <div class="col-lg-9" style="padding: 0; height: 90vh;">
                <div class="" style="margin-top: 3%">
                    {{-- @if (!empty($lecture['id']))
                        @php
                            $image = App\Models\Image::where('imageable_id', $lecture['id'])
                                ->where('imageable_type', 'App\Models\Lecture')
                                ->where('image_name', 'video')
                                ->first();
                        @endphp
                        @if ($image && filter_var($image->image_url, FILTER_VALIDATE_URL))
                            <video controls style="width: 100%; max-width: 600px; height: auto;">
                                <source src="{{ $image->image_url }}" type="video/mp4">
                                Trình duyệt của bạn không hỗ trợ thẻ video.
                            </video>
                        @else
                            <div data-toggle="tooltip" title="Không có video" style="margin-top: 10px;">
                                <i class="ri-eye-off-line" style="font-size: 25px;"></i>
                            </div>
                        @endif
                    @endif --}}

                    @php
                        $image = App\Models\Image::where('imageable_id', $lecture['id'])
                            ->where('imageable_type', 'App\Models\Lecture')
                            ->where('image_name', 'video')
                            ->first();
                        $videoUrl = null;
                        if ($image && filter_var($image->image_url, FILTER_VALIDATE_URL)) {
                            $convertedUrl = str_replace('/view', '/uc?export=download', $image->image_url);
                            $convertedUrl = str_replace('file/d/', 'uc?export=download&id=', $convertedUrl);
                            // Kiểm tra quyền truy cập liên kết
                            $headers = @get_headers($convertedUrl);
                            if ($headers && strpos($headers[0], '200 OK')) {
                                $videoUrl = $convertedUrl;
                            }
                        }
                    @endphp
                    @if ($videoUrl)
                        <video controls style="width: 100%; max-width: 600px; height: auto;">
                            <source src="{{ $videoUrl }}" type="video/mp4">
                            Trình duyệt của bạn không hỗ trợ video.
                        </video>
                    @else
                        <div data-toggle="tooltip" title="Không có video hoặc không thể truy cập" style="margin-top: 10px;">
                            <i class="ri-eye-off-line" style="font-size: 25px;"></i>
                        </div>
                    @endif
                </div>
                <div class="p-2 d-flex align-items-center" style="margin-left: 30px;">
                    <div class="font-weight-bold mr-3">
                        <div class="text-truncate" style="font-weight: bolder; color: rgb(0, 0, 0)">
                            {{ $course->user->name }}
                        </div>
                    </div>
                    <button id="yesButton" type="submit"
                        style="background-color: #ff4d6d; color: white; border: none; padding: 10px 45px; font-size: 14px; border-radius: 5px; cursor: pointer; font-weight: bolder;">
                        Theo dõi
                    </button>
                </div>

            </div>
            <div class="col-lg-3" style="height: 90vh;">
                <div id="accordion">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link">
                                <div class="d-flex align-items-center bg-light osahan-post-header">
                                    <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                        alt="" style="width: 15%;" />
                                    <div class="pe-2"></div>
                                    <div class="font-weight-bold mr-3">
                                        <div class="text-truncate" style="font-weight: bolder;">{{ $course->user->name }}
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </h5>
                    </div>
                    <!-- Danh mục bài giảng -->
                    <div class="card">
                        <div class="card-header" id="headingLectures">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" href="#collapseLectures"
                                    data-parent="#accordion">
                                    <div class="d-flex align-items-center bg-light osahan-post-header">
                                        <div class="font-weight-bold mr-3">
                                            <div class="text-truncate" style="font-weight: bolder;">Danh mục bài giảng</div>
                                        </div>
                                    </div>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseLectures" class="collapse show" aria-labelledby="headingLectures">
                            <div class="card-body">
                                <div class="box shadow-sm rounded bg-white"
                                    style="height: calc(90vh - 80px); overflow: hidden;">
                                    <div class="box-body p-0" style="height: calc(100% - 50px); overflow-y: auto;">
                                        @foreach ($course->lectures->groupBy('lecture_categories_id') as $categoryId => $lectures)
                                            <div class="course-panel panel-default">
                                                <div class="panel-heading" role="tab" id="heading{{ $categoryId }}"
                                                    style="padding-top: 5px">
                                                    <h6 class="panel-title">
                                                        <a role="button" data-toggle="collapse"
                                                            href="#collapse{{ $categoryId }}" aria-expanded="false"
                                                            aria-controls="collapse{{ $categoryId }}">
                                                            {{ $lectures->first()->lectureCategory->name ?? 'Chương ' . $categoryId }}
                                                        </a>
                                                        <span class="badge bg-danger rounded-pill position-absolute"
                                                            style="right: 0; top: 0;">
                                                            {{ $lecturesCountByCategory[$categoryId] ?? 0 }}
                                                        </span>
                                                    </h6>
                                                </div>
                                                <div id="collapse{{ $categoryId }}" class="panel-collapse collapse"
                                                    role="tabpanel" aria-labelledby="heading{{ $categoryId }}">
                                                    <div class="panel-body" style="padding-left: 0">
                                                        <ul class="list-group list-group-flush">
                                                            @foreach ($lectures as $lecture)
                                                                <li class="list-group-item py-0">
                                                                    <a
                                                                        href="{{ route('khoa-hoc.chitiet', ['course_id' => $course->id, 'lecture_id' => $lecture->id]) }}">
                                                                        {{ $lecture->name }}
                                                                    </a>
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
                    </div>
                    <!-- Bình luận -->
                    <div class="card">
                        <div class="card-header" id="headingComments">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" href="#collapseComments"
                                    data-parent="#accordion">
                                    <div class="d-flex align-items-center bg-light osahan-post-header">
                                        <div class="font-weight-bold mr-3">
                                            <div class="text-truncate" style="font-weight: bolder;">Bình luận</div>
                                        </div>
                                    </div>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseComments" class="collapse" aria-labelledby="headingComments">
                            <div class="card-body">
                                <div class="box shadow-sm rounded bg-white"
                                    style="height: calc(90vh - 80px); overflow: hidden;">
                                    <div class="box-body p-0" style="height: calc(100% - 50px); overflow-y: auto;">
                                        <!-- Phần bình luận mẫu -->
                                        <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle"
                                                    src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                    alt="" style="width: 40%;" />
                                            </div>
                                            <div class="mr-3">
                                                <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                            </div>
                                        </div>
                                        <!-- Kết thúc bình luận mẫu -->
                                    </div>
                                </div>
                            </div>
                        </div>
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
@endsection
