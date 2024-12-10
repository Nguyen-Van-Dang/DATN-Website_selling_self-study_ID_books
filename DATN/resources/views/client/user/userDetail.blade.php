@extends('layouts.client.client')

@section('title', 'Thông Tin Tài khoản')

@section('content')

    <div class="container-fluid">
        <div class="row profile-content">
            <div class="col-12">
                <div class="iq-card">
                    <div class="iq-card-body profile-page">
                        <div class="profile-header">
                            <div class="cover-container">
                                <div class="row">

                                    <div class="col-3 text-center">

                                        @php
                                            $avatar = auth()->user()->images()->where('image_name', 'avatar')->first();
                                        @endphp

                                        <img src="{{ asset($avatar->image_url ?? 'assets/images/book/user/avatar.jpg') }}"
                                            alt="profile-bg" class="rounded-circle img-fluid"
                                            style="width: 60%; box-shadow: 0px 4px 20px 0px rgba(44, 101, 144, 0.50);">

                                        <div class="iq-social d-inline-block align-items-center pt-5">
                                            <ul class="list-inline d-flex p-0 mb-0 align-items-center">
                                                <li>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Facebook"
                                                        class="avatar-40 rounded-circle bg-primary mr-2 facebook"><i
                                                            class="fa fa-facebook" aria-hidden="true"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Zalo"
                                                        class="avatar-40 rounded-circle bg-primary mr-2 twitter"><i
                                                            class="fa fa-twitter" aria-hidden="true"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Youtube"
                                                        class="avatar-40 rounded-circle bg-primary mr-2 youtube"><i
                                                            class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="TikTok"
                                                        class="avatar-40 rounded-circle bg-primary pinterest"><i
                                                            class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="profile-detail mt-3">
                                            <h3>{{ auth()->user()->name }}</h3>
                                            {{-- <p class="text-primary">chuyên môn: Toán </p> --}}
                                            @if (auth()->user()->description == '')
                                                <p id="description-text">
                                                    - Giảng viên chưa cập nhật thông tin
                                                    <a class="ml-2" style="cursor: pointer;"
                                                        onclick="editDescription()"><i class="fa fa-pen"></i></a>
                                                </p>
                                            @else
                                                <p id="description-text">
                                                    {!! auth()->user()->description !!}
                                                    <a class="ml-2" style="cursor: pointer;"
                                                        onclick="editDescription()"><i class="fa fa-pen"></i></a>
                                                </p>
                                            @endif
                                            <div id="description-edit" style="display: none;">
                                                <form action="{{ route('updateDescription') }}" method="POST">
                                                    @csrf
                                                    <textarea id="description-input" class="form-control" name="user_description" rows="4"></textarea>
                                                    <button type="submit" class="btn btn-primary btn-sm mt-2"
                                                        onclick="saveDescription()">Lưu</button>
                                                    <button class="btn btn-secondary btn-sm mt-2"
                                                        onclick="cancelEdit()">Hủy</button>
                                                </form>
                                            </div>
                                            <div class="pt-3" style="font-size: 14px; color: #444; margin-left: 1rem">
                                                <div class="row">
                                                    <div class="text-center" style="padding-right: 3rem">
                                                        <h3 style="font-weight: bold;">6.5M</h3>
                                                        <div style="color: #777; margin-top: -10px;">Views</div>
                                                    </div>
                                                    <div class="text-center" style="padding-right: 3rem">
                                                        <h3 style="font-weight: bold;">15.7K</h3>
                                                        <div style="color: #777; margin-top: -10px;">Likes</div>
                                                    </div>
                                                    <div class="text-center" style="padding-right: 3rem">
                                                        <h3 style="font-weight: bold;">1.5M</h3>
                                                        <div style="color: #777; margin-top: -10px;">Followers</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <button id="yesButton" type="submit"
                                                style="background-color: #ff4d6d; color: white; border: none; padding: 10px 45px; font-size: 14px; border-radius: 5px; cursor: pointer; font-weight: bolder;">Theo
                                                dõi</button>
                                            <b class="px-2"></b>
                                            <button id="noButton"
                                                style="background-color: #00000035; color: rgb(0, 0, 0); border: none; padding: 10px 35px; font-size: 14px; border-radius: 5px; cursor: pointer; font-weight: 500"><i
                                                    class="ri-chat-3-line"></i> Nhắn tin</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Courses -->
            <div class="col-12">
                <div class="iq-card">
                    <div class="iq-card-body profile-page">
                        <div class="profile-header">
                            <div class="cover-container">
                                <h4 class="pb-4">Khóa Học</h4>
                                <div class="row">
                                    @forelse ($courses as $course)
                                        @php
                                            $courseImage = $course->images()->where('image_name', 'thumbnail')->first();
                                        @endphp
                                        <div class="col-6 pb-3">
                                            <div class="row">
                                                <div class="col-6" onclick="goToCourseDetail({{ $course->id }})"
                                                    style="cursor: pointer;">
                                                    <img class="card-img-top img-fluid rounded course-image"
                                                        style="width: 770px; height: 200px;"
                                                        src="{{ $courseImage ? $courseImage->image_url : asset('assets/images/book/book/01.jpg') }}"
                                                        alt="Course Image">
                                                </div>
                                                <script>
                                                    function goToCourseDetail(courseId) {
                                                        window.location.href = '/khoa-hoc/' + courseId;
                                                    }
                                                </script>
                                                <div class="col-6">
                                                    <span
                                                        style="font-weight: bold; display: block;">{{ $course->name }}</span>
                                                    <p>
                                                        Số bài giảng: {{ $course->lectures->count() }}
                                                        <br>
                                                        <span
                                                            class="d-inline-flex justify-content-center align-items-center rounded-circle bg-success text-white"
                                                            style="width: 30px; height: 30px;">
                                                            <i class="ri-book-open-line" style="font-size: 20px;"></i>
                                                        </span>
                                                    </p>
                                                    <span
                                                        class="text-danger font-weight-bold">{{ number_format($course->price) }}
                                                        đ</span>
                                                    <span class="text-muted ml-3"
                                                        style="text-decoration:line-through">{{ number_format($course->discount) }}
                                                        đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 pb-1">
                                            <div class="row text-center">
                                                <div class="col-12">
                                                    <p>Hiện tại chưa có Khóa Học nào...</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Books -->
            <div class="col-12">
                <div class="iq-card">
                    <div class="iq-card-body profile-page">
                        <div class="profile-header">
                            <div class="cover-container">
                                <h4 class="pb-4">Sách</h4>
                                <div class="row px-2">
                                    @forelse ($books as $book)
                                        @php
                                            $bookImage = $book->images()->where('image_name', 'thumbnail')->first();
                                        @endphp
                                        <div class="col-2 pb-3">
                                            <div class="row">
                                                <div style="width: 210px;">
                                                    <div style="border: 2px solid rgba(128, 128, 128, 0.214);">
                                                        <div style="cursor: pointer;"
                                                            onclick="goToBookDetail({{ $book->id }})">
                                                            <img src="{{ $bookImage ? $bookImage->image_url : asset('assets/images/book/book_placeholder.png') }}"
                                                                alt="profile-bg" style="height: 300px; width: 206px;"
                                                                class="course-image">
                                                        </div>
                                                        <script>
                                                            function goToBookDetail(bookId) {
                                                                window.location.href = '/sach/' + bookId;
                                                            }
                                                        </script>
                                                        <div class="px-3 pb-4 pt-3">
                                                            <span class="book-title" style="font-weight: 600;">
                                                                {{ $book->name }}
                                                            </span>
                                                            <div class="pb-1">
                                                                <button id="yesButton" type="submit"
                                                                    style="background-color: #c9f1f2; color: #0e9f6e; border: none; padding: 5px 5px; font-size: 10px; border-radius: 5px; cursor: pointer; font-weight: bolder;">Freeship</button>
                                                                @if ($book->discount > 0)
                                                                    <button id="noButton"
                                                                        style="background-color: #ffb5b5; color: #ca0909; border: none; padding: 5px 5px; font-size: 10px; border-radius: 5px; cursor: pointer; font-weight: 500">
                                                                        {{ $book->discount }}%
                                                                    </button>
                                                                @endif
                                                            </div>

                                                            <span>
                                                                <a style="font-weight: bolder; color:#ff2a00;">
                                                                    {{ number_format($book->price - $book->price * ($book->discount / 100), 0, '.', ',') }}đ
                                                                </a>
                                                                @if ($book->discount > 0)
                                                                    <b class="px-2"></b>
                                                                    <del
                                                                        style="font-size: 12px;">{{ number_format($book->price, 0, '.', ',') }}đ</del>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 pb-1">
                                            <div class="row text-center">
                                                <div class="col-12">
                                                    <p>Hiện tại chưa có Sách nào...</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Reels -->
            <div class="col-12">
                <div class="iq-card">
                    <div class="iq-card-body profile-page">
                        <div class="profile-header">
                            <div class="cover-container">
                                <h4 class="pb-4">Reels</h4>
                                <div class="row">
                                    @forelse ($reels as $reel)
                                        @php
                                            $reelsImage = $reel->images()->where('image_name', 'reelsImg')->first();
                                        @endphp
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card" style="position: relative; cursor: pointer;"
                                                onclick="">
                                                <a href="{{ route('client.reels.reelsDetail', $reel->id) }}">
                                                <img src="{{ $reelsImage ? $reelsImage->image_url : asset('assets/images/book/book/01.jpg') }}"
                                                    alt="profile-bg" class="card-img-top"
                                                    style="height: 550px; object-fit: cover; box-shadow: 0px 4px 20px rgba(44, 101, 144, 0.5); border-radius: 10px">
                                                <div
                                                    class="position-absolute bottom-0 start-0 p-2 text-white bg-opacity-50 rounded-end">
                                                    <i class="fas fa-eye"></i> {{ $reel->views_count }} Views
                                                </div>
                                                <div style="margin-top: -35px; margin-left: 90%;">
                                                    @if (auth()->user()->id === $reel->user_id)
                                                        <button class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#deleteConfirmationModal"
                                                            onclick="setDeleteAction({{ $reel->id }})">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 pb-1">
                                            <div class="row text-center">
                                                <div class="col-12">
                                                    <p>Hiện tại chưa có Reels nào...</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <!-- Modal Xác Nhận -->
                                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1"
                                    aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteConfirmationModalLabel">Xác nhận
                                                    xóa video này hay không</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">X</button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa video này? Hành động này không thể hoàn
                                                tác.
                                            </div>
                                            <div class="modal-footer">
                                                <form id="deleteForm" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                    <button type="button" class="btn btn-secondary me-2"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                </form>
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
    </div>
    <style>
        #deleteForm {
            padding: 0;
        }

        .btn-close {
            background: none;
            border: none
        }

        .btn-close:hover {
            color: var(--iq-primary);
        }

        .btn:hover {
            color: var(--iq-primary);
        }

        .book-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
            line-height: 1.2em;
            height: 2.4em;
            text-overflow: ellipsis;
        }

        textarea.form-control {
            width: 100%;
            font-size: 14px;
            padding: 5px;
        }

        button {
            margin-right: 5px;
        }

        .course-image {
            transition: transform 0.3s ease-in-out;
            object-fit: cover;
        }

        .course-image:hover {
            transform: scale(1.1);
        }
    </style>
    <script>
        function editDescription() {
            const descriptionText = document.getElementById("description-text");
            const descriptionEdit = document.getElementById("description-edit");
            const descriptionInput = document.getElementById("description-input");

            descriptionInput.value = descriptionText.innerText.trim();
            descriptionText.style.display = "none";
            descriptionEdit.style.display = "block";
        }

        function saveDescription(event) {
            event.preventDefault();

            const descriptionText = document.getElementById("description-text");
            const descriptionInput = document.getElementById("description-input");
            const trimmedValue = descriptionInput.value.trim();

            descriptionText.innerHTML = trimmedValue.replace(/\n/g, '<br>') +
                ' <a class="ml-2" style="cursor: pointer;" onclick="editDescription()"><i class="fa fa-pen"></i></a>';
            descriptionText.style.display = "block";
            document.getElementById("description-edit").style.display = "none";

        }

        function cancelEdit() {
            const descriptionText = document.getElementById("description-text");
            const descriptionEdit = document.getElementById("description-edit");

            descriptionText.style.display = "block";
            descriptionEdit.style.display = "none";
        }
    </script>
    <script>
        function setDeleteAction(reelId) {
            const form = document.getElementById('deleteForm');
            form.action = `/thong-tin-tai-khoan/xoa-video/${reelId}`;
        }
    </script>
@endsection
