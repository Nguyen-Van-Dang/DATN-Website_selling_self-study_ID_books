@extends('layouts.client.clientLecture')

@section('title', 'Học khóa học')

@section('content')

    <div>
        <div class="course" style="padding: 20px; background: #0dd6b8; font-size: 20px; font-weight: bold; color: #444444;">
            <a href="{{ route('khoa-hoc.index') }}" style="text-decoration:none">Trở về</a>
        </div>
        <div class="row" style="height: 90vh; width: 100%;">
            <div class="col-lg-9" style="padding: 0; height: 90vh;">
                <div class="">
                    @if (!empty($lecture['id']))
                        @php
                            $image = App\Models\Image::where('imageable_id', $lecture['id'])
                                ->where('imageable_type', 'App\Models\Lecture')
                                ->where('image_name', 'video')
                                ->first();

                            $videoUrl = null;
                            if ($image && filter_var($image->image_url, FILTER_VALIDATE_URL)) {
                                $videoUrl =
                                    strpos($image->image_url, 'drive.google.com') !== false
                                        ? preg_replace('/\/d\/(.*?)\/.*/', '/d/$1/preview', $image->image_url)
                                        : $image->image_url;
                            }
                        @endphp

                        @if ($videoUrl)
                            <!-- Hiển thị video nếu URL hợp lệ -->
                            <iframe src="{{ $videoUrl }}" width="100%" height="725px" allow="autoplay"
                                frameborder="0"></iframe>
                        @else
                            <!-- Hiển thị thông báo nếu không có video -->
                            <div data-toggle="tooltip" title="Không có video" style="margin-top: 10px;">
                                <i class="ri-eye-off-line" style="font-size: 25px;"></i>
                            </div>
                        @endif
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
                                <div class="d-flex align-items-center bg-light osahan-post-header">
                                    @php
                                     $User = auth()->user();
                                        $thumbnail = $User->images()->where('image_name', 'avatar')->first();
                                        $thumbnailUrl = $thumbnail
                                            ? $thumbnail->image_url
                                            : asset('assets/images/book/book/01.jpg');
                                    @endphp
                                    <a href="javascript:void(0);">
                                        <img src="{{ $thumbnailUrl }}" class="rounded-circle w-50" alt="avatar">
                                    </a>
                                    <div class="pe-2"></div>
                                    <div class="font-weight-bold mr-3">
                                        <div class="text-truncate" style="font-weight: bolder;">{{ $course->user->name }}
                                        </div>
                                    </div>
                                </div>
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
