@extends('layouts.client.client')

@section('title', 'Chi Tiết khóa học')

@section('content')

    <div class="container-fluid">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
            <div class="row">
                <div class="col-12 col-md-4 order-1 order-md-1">
                    @php
                        $courseImage = $course->images()->where('image_name', 'thumbnail')->first();
                    @endphp
                    <img class="rounded" style="width: 480px; height: 220px;"
                        src="{{ $courseImage ? $courseImage->image_url : asset('assets/images/book/course_thumbnail.png') }}">
                </div>
                <div class="col-12 col-md-8 order-2 order-md-2"style="border-right: 0.5px solid #8080804f;">
                    @if ($course->discount && $course->price > $course->discount)
                        @php
                            $price = $course->price;
                            $discount = $course->discount;
                            if ($price > 0 && $discount > 0 && $discount < $price) {
                                $discountPercentage = round(($discount / $price) * 100);
                            } else {
                                $discountPercentage = 0;
                            }
                        @endphp
                        @if ($discountPercentage > 0)
                            <span class="discount-badge">
                                -{{ $discountPercentage }}%
                            </span>
                        @endif
                    @endif
                    <h5 class="mb-0">{{ $course->name }}</h5>
                    <p class="text-muted mb-1">Thầy {{ $course->user->name }}</p>
                    <div class="d-flex justify-content-evenly mt-3 flex-nowrap">
                        <span name="course_price"
                            class="text-danger font-weight-bold">{{ number_format($course->price) }}đ</span>
                        <span class="text-muted ml-3" name="course_discount"
                            style="text-decoration:line-through">{{ number_format($course->discount) }}đ</span>
                    </div>
                    <p class="mb-2">
                        <span class="d-block"><i class="bi bi-collection-play"></i> Số bài:
                            {{ count($course->lectures) }}</span>
                        @if ($chatGroup)
                            <a href="{{ route('chat.show', ['id' => $chatGroup->id]) }}"
                                class="text-primary d-block mt-1"><i class="bi bi-people"></i>
                                Nhóm: {{ $chatGroup->name }}</a>
                        @else
                            <a href="#" class="text-primary d-block mt-1"><i class="bi bi-people"></i> Nhóm chat</a>
                        @endif
                    </p>
                    <div class="d-flex">
                        <button class="btn btn-danger btn-lg mr-2" data-toggle="modal" data-target="#payment-popup"
                            data-order-id="{{ $course->id }}">Mua ngay</button>

                        <button class="btn btn-secondary btn-lg">Tham gia nhóm</button>
                    </div>
                </div>

                {{-- <div class="col-12 col-md-12 order-2 order-md-2">
                    <p class="mb-2 fw-bold">{{ $course->description }}</p>
                </div> --}}
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
                                Bài thi
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="bai-giang" role="tabpanel"
                            aria-labelledby="bai-giang-tab">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach ($course->lectures->groupBy('lecture_categories_id') as $categoryId => $lectures)
                                    <div class="course-panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading{{ $categoryId }}">
                                            <h6 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
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
                                            <div class="panel-body" style="margin-left: 45px">
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($lectures as $lecture)
                                                        <li class="list-group-item py-0">
                                                            @auth
                                                                <a
                                                                    href="{{ route('khoa-hoc.chitiet', ['course_id' => $course->id, 'lecture_id' => $lecture->id]) }}">
                                                                    {{ $lecture->name }}
                                                                </a>
                                                            @else
                                                                <!-- Trigger -->
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#loginModal">
                                                                    {{ $lecture->name }}
                                                                </a>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="loginModal" tabindex="-1"
                                                                    aria-labelledby="loginModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="loginModalLabel">
                                                                                    Thông
                                                                                    báo</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal" aria-label="Close"
                                                                                    style="background: none; border: none;">X</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Bạn cần đăng nhập để xem bài giảng này.
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button id="open-popup-btn"
                                                                                    class="btn btn-primary">Đăng
                                                                                    nhập</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Đóng</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endauth
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bai-kiem-tra" role="tabpanel" aria-labelledby="bai-kiem-tra-tab">
                            <table class="table align-middle mb-0 bg-white">
                                <thead>
                                    <tr style="width:100%">
                                        <th style="width: 10%; border-top: none; padding-left:36px;text-align:center">STT
                                        </th>
                                        <th style="width: 50%;border-top: none;">Đề thi</th>
                                        <th style="width: 20%;border-top: none;text-align:center">Lần thi gần nhất</th>
                                        <th style="width: 10%;border-top: none;">Kết quả</th>
                                        <th style="width: 10%;border-top: none;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($exams as $index => $exam)
                                        @php
                                            $latestResult = $exam->results
                                                ->where('exam_id', $exam->id)
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        <tr>
                                            <td style="padding-left:36px;text-align:center">
                                                {{ $index + 1 }}
                                            </td>
                                            <td>

                                                <p class="fw-bold mb-1">{{ $exam->name }}</p>
                                            </td>
                                            <td style="text-align:center">
                                                @if ($latestResult)
                                                    {{ $latestResult->created_at->locale('vi')->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($latestResult)
                                                    @if ($latestResult->score >= 5)
                                                        <span class="badge badge-primary rounded-pill d-inline">Đã
                                                            đạt</span>
                                                    @else
                                                        <span class="badge badge-danger rounded-pill d-inline">Chưa
                                                            đạt</span>
                                                    @endif
                                                @else
                                                    <a href="{{ route('de-thi.doExam', ['exam_id' => $exam->id]) }}">
                                                        <span class="badge badge-info">Vào thi</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($latestResult)
                                                    <div class="dropdown">
                                                        <i class="bi bi-three-dots dropdown-toggle p-0 text-body"
                                                            id="dropdownMenuButton3" data-toggle="dropdown"
                                                            aria-expanded="false"></i>
                                                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                                                            aria-labelledby="dropdownMenuButton3" style="">

                                                            <a class="dropdown-item"
                                                                href="{{ route('de-thi.showExam', ['result_id' => $latestResult->id]) }}">Xem
                                                                kết quả</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('de-thi.doExam', ['exam_id' => $exam->id]) }}">Thi
                                                                lại</a>

                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <style>
                                .dropdown-toggle:empty::after {
                                    display: none !important;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
                    <div class="row">
                        <div class="col-3">
                            <div class="d-flex align-items-center mb-3">
                                <img class="rounded-circle me-3"style="width: 100px; height: 100px;"
                                    src="{{ $course->user->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}">
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
                            {{ $course->user->description }}
                        </p>
                    </div>
                    <div class="modal-content">
                        <h5 class="mb-0">Khóa học nổi bậc</h5>

                        <div class="iq-card-body pt-0 py-3 modal-body-scrollable">
                            @foreach ($user->courses as $userCourse)
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
                                        <div class="d-flex justify-content-evenly mt-1 flex-nowrap"
                                            style="font-size: 15px">
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

        <div class="modal fade" id="payment-popup" tabindex="-1" role="dialog" aria-labelledby="paymentPopupLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentPopupLabel">Lựa chọn thanh toán</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="mt-3 mb-3" style="padding-left: 40px !important; padding-right: 40px !important">
                            <div class="d-flex align-items-center">
                                <span>Mã giảm giá: </span>
                                <div class="cvv-input ml-3 mr-3" style="width: 40%;">
                                    <input type="text" class="form-control" required="">
                                </div>
                                <button type="submit" class="btn btn-primary">Tiếp tục</button>
                            </div>
                        </form>
                        <form action="{{ route('courseCheckout') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @foreach ($paymentMethods as $method)
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="payment_method_{{ $method->id }}"
                                            name="payment_method" value="{{ $method->id }}"
                                            class="custom-control-input">
                                        <label class="custom-control-label"
                                            for="payment_method_{{ $method->id }}">{{ $method->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" value="{{ $course->id }}" name="course_id" id="">
                            <button type="submit" class="btn btn-primary d-block mt-1" name="redirect">Thanh
                                toán</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .discount-badge {
                position: absolute;
                top: 10px;
                left: -90px;
                background-color: #f44336;
                color: white;
                padding: 5px 10px;
                border-radius: 10px;
                font-size: 16px;
                font-weight: bold;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                animation: bounce 2s infinite;
                transition: box-shadow 0.3s ease;
                z-index: 10;
            }

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

            .hover-enlarge-img {
                width: 100px;
                height: 55px;
                transition: transform 0.3s ease;
                /* Hiệu ứng phóng to mượt mà trong 0.3 giây */
            }

            /* Khi hover vào hình ảnh, sẽ phóng to */
            .hover-enlarge-img:hover {
                transform: scale(1.1);
                /* Phóng to hình ảnh lên 20% */
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

            .modal-body-scrollable::-webkit-scrollbar {
                display: none;
            }
        </style>
    </div>
@endsection
