<div class="row mb-3">
    <div class="col-lg-8">
        <div class="iq-card mb-3">
            <div class="p-3 border-top">
                <button class="btn {{ $selectedCourseId === 'all' ? 'btn-primary' : 'btn-warning' }}  mr-2 mb-2"
                    wire:click="$set('selectedCourseId', 'all')">
                    Tất cả
                </button>
                @foreach ($enrollCourses as $course)
                    <button class="btn {{ $selectedCourseId === $course->id ? 'btn-primary' : 'btn-warning' }} mr-2 mb-2"
                        wire:click="$set('selectedCourseId', {{ $course->id }})">
                        {{ $course->name }}
                    </button>
                @endforeach
            </div>
        </div>
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
            <div class="row">
                <table class="table align-middle mb-0 bg-white">
                    <thead>
                        <tr style="width:100%">
                            <th style="width: 10%; border-top: none; padding-left:36px;text-align:center">STT</th>
                            <th style="width: 50%;border-top: none;">Đề thi</th>
                            <th style="width: 20%;border-top: none;text-align:center">Lần thi gần nhất</th>
                            <th style="width: 10%;border-top: none;">Kết quả</th>
                            <th style="width: 10%;border-top: none;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $index => $exam)
                            @php
                                $latestResult = $examResult
                                    ->where('exam_id', $exam->id)
                                    ->sortByDesc('created_at')
                                    ->first();
                            @endphp
                            <tr>
                                <td style="padding-left:36px;text-align:center">
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $exam->course->user->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                            alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ml-3">
                                            <p class="fw-bold mb-1">{{ $exam->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    @if ($latestResult)
                                        {{ $latestResult->created_at->locale('vi')->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    @if ($latestResult)
                                        @if ($latestResult->score >= 5)
                                            <span class="badge badge-primary rounded-pill d-inline">Đã đạt</span>
                                        @else
                                            <span class="badge badge-danger rounded-pill d-inline">Chưa đạt</span>
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
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <h5 class="p-3">
                Khoá học mới nhất
            </h5>
            <ul class="iq-edit-profile d-flex nav nav-pills">
                <li class="col-md-3 py-3">
                    <div class="text-center">
                        <h6 class="mb-0 border-right"><a href="">Tất cả</a></h6>
                    </div>
                </li>
                <li class="col-md-3 py-3">
                    <div class="text-center">
                        <h6 class="mb-0 border-right"><a href="">Lớp 10</a></h6>
                    </div>
                </li>
                <li class="col-md-3 py-3">
                    <div class="text-center">
                        <h6 class="mb-0 border-right"><a href="">Lớp 11</a>
                        </h6>
                    </div>
                </li>
                <li class="col-md-3 py-3">
                    <div class="text-center">
                        <h6 class="mb-0"><a href="">Lớp 10</a></h6>
                    </div>
                </li>
            </ul>
            <div class="border-top p-3">
                <div class="row">
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt="" class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt="" class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt=""class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt=""class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt=""class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt=""class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt="" class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt="" class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt=""class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt=""class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt=""class="img-fluid">
                    </div>
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUSR8wzALo8_3wasTTj33smoTrvzpN3SctsQ&s"
                            alt=""class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .dropdown-toggle:empty::after {
            display: none !important;
        }
    </style>
</div>
