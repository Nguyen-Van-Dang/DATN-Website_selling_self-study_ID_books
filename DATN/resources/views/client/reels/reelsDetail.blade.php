@extends('layouts.client.client')

@section('title', 'Reels')

@section('content')
    <div class="card">
        <div class="row" style="background-color: #e9ecef;">
            <div class="col-8">
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        @if (!empty($reel['id']))
                            @php
                                $image = App\Models\Image::where('imageable_id', $reel['id'])
                                    ->where('imageable_type', 'App\Models\Reels')
                                    ->where('image_name', 'reelsVideo')
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
                                <iframe src="{{ $videoUrl }}" width="450" height="750" allow="autoplay"></iframe>
                            @else
                                <div data-toggle="tooltip" title="Không có video" style="margin-top: 10px;">
                                    <i class="ri-eye-off-line" style="font-size: 25px;"></i>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-4" style="padding-left: 0px">
                <div class="section-1">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-3">
                                <div class="d-flex align-items-center mb-3">
                                    <img class="rounded-circle me-3" style="width: 100px; height: 100px;"
                                        src="{{ $reel->user->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}">
                                </div>
                            </div>
                            <div class="col-9">
                                <div>
                                    <h5 class="mb-0">Thầy {{ $reel->user->name }} <i
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
                        <div class="pt-4 text-center border-top">
                            <button id="yesButton" type="submit"
                                style="background-color: #ff4d6d; color: white; border: none; padding: 10px 45px; font-size: 14px; border-radius: 5px; cursor: pointer; font-weight: bolder;">
                                Theo dõi
                            </button>
                            <b class="px-2"></b>
                            <button id="noButton"
                                style="background-color: #00000035; color: rgb(0, 0, 0); border: none; padding: 10px 35px; font-size: 14px; border-radius: 5px; cursor: pointer; font-weight: 500">
                                <i class="ri-chat-3-line"></i> Nhắn tin
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Section 2 -->
                <div class="section-2">
                    <div class="p-3">
                        <h5 class="mb-0">Khóa học nổi bật</h5>
                        <div class="iq-card-body pt-0 py-3 modal-body-scrollable">
                            @foreach ($userCourses as $userCourse)
                                @php
                                    $courseImage = $userCourse->images()->where('image_name', 'thumbnail')->first();
                                @endphp
                                <div class="row pb-2">
                                    <div class="col-3">
                                        <img class="hover-enlarge-img" style="width: 100px; height: 55px;"
                                            src="{{ $courseImage ? $courseImage->image_url : asset('assets/images/book/course_thumbnail.png') }}">
                                    </div>
                                    <div class="col-9">
                                        <a href="{{ route('khoa-hoc.show', $userCourse->id) }}"
                                            class="card-title course-title">
                                            <h6 class="panel-title">
                                                {{ $userCourse->name }}
                                            </h6>
                                        </a>
                                        <div class="d-flex justify-content-evenly mt-1 flex-nowrap" style="font-size: 15px">
                                            <span
                                                class="text-danger font-weight-bold">{{ number_format($userCourse->price) }}
                                                đ</span>
                                            <span class="text-muted ml-3"
                                                style="text-decoration:line-through">{{ number_format($userCourse->discount) }}
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
    </div>

    <style>
        .section-1 {
            background-color: #f8f9fa;

        }

        .section-2 {
            background-color: #f8f9fa;
            margin-top: 15px;
            height: 85vh;
        }

        .col-8 {
            background: black;
        }

        .embed-responsive {
            width: 100%;
            max-width: 500px;
            height: 85vh;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
@endsection
