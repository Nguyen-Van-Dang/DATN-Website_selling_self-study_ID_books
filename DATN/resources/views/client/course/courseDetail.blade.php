@extends('layouts.client.client')

@section('title', 'Chi Tiết khóa học')

@section('content')
    <div class="container-fluid">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
            <div class="row align-items-center">
                <div class="col-12 col-md-4 order-1 order-md-1">
                    <img src="https://cdn.mclass.vn/blog/uploads/2024/06/28134058/z5581767185476_8dde1beb2c61f7600912c0684e0a1435.jpg"
                        class="img-fluid rounded" alt="Course Image" style="object-fit: cover;aspect-ratio: 2/1">
                </div>
                <div class="col-12 col-md-8 order-2 order-md-2">
                    <h4 class="mb-2 fw-bold">Live C - Luyện thi TN THPT 2025 môn Ngữ văn</h4>
                    <p class="text-muted mb-1">Thầy Phạm Minh Nhật</p>
                    <div class="d-flex justify-content-evenly mt-3 flex-nowrap">
                        <span class="text-danger font-weight-bold">500.000đ</span>
                        <span class="text-muted ml-3" style="text-decoration:line-through">600.000đ</span>
                    </div>
                    <p class="mb-2">
                        <span class="d-block"><i class="bi bi-collection-play"></i> Số bài: 88</span>
                        <a href="#" class="text-primary d-block mt-1"><i class="bi bi-people"></i> Nhóm Mooners</a>
                    </p>
                    <div class="d-flex">
                        <button class="btn btn-danger btn-lg mr-2">Mua ngay</button>
                        <button class="btn btn-secondary btn-lg">Kích hoạt</button>
                    </div>
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

                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="bai-giang" role="tabpanel"
                            aria-labelledby="bai-giang-tab">

                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="course-panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h6 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                                class="collapsed">
                                                Chương 1
                                            </a>
                                            <span class="badge bg-danger rounded-pill position-absolute"
                                                style="right: 0; top: 0;">14</span>
                                        </h6>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item py-0"><a href="#">Bài 1</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 2</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 3</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 4</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 5</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="course-panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h6 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                Chương 2
                                            </a>
                                            <span class="badge bg-danger rounded-pill position-absolute"
                                                style="right: 0; top: 0;">24</span>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item py-0"><a href="#">Bài 1</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 2</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 3</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 4</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 5</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="course-panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h6 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                Chương 3
                                            </a>
                                            <span class="badge bg-danger rounded-pill position-absolute"
                                                style="right: 0; top: 0;">14</span>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item py-0"><a href="#">Bài 1</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 2</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 3</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 4</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 5</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="bai-kiem-tra" role="tabpanel" aria-labelledby="bai-kiem-tra-tab">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="course-panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h6 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                                class="collapsed">
                                                Kiểm tra chương 1
                                            </a>
                                            <span class="badge bg-danger rounded-pill position-absolute"
                                                style="right: 0; top: 0;">14</span>
                                        </h6>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item py-0"><a href="#">Bài 1</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 2</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 3</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 4</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 5</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="course-panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h6 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                Kiểm tra chương 2
                                            </a>
                                            <span class="badge bg-danger rounded-pill position-absolute"
                                                style="right: 0; top: 0;">24</span>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item py-0"><a href="#">Bài 1</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 2</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 3</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 4</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 5</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="course-panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h6 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                Kiểm tra chương 3
                                            </a>
                                            <span class="badge bg-danger rounded-pill position-absolute"
                                                style="right: 0; top: 0;">14</span>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item py-0"><a href="#">Bài 1</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 2</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 3</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 4</a></li>
                                                <li class="list-group-item py-0"><a href="#">Bài 5</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
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
                                <h5 class="mb-0">Thầy Bùi Văn Công <i class="bi bi-check-circle-fill text-success"></i>
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
                </div>
            </div>
        </div>

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
