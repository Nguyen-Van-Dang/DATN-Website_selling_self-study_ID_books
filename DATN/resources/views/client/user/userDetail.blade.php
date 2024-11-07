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
                                        <img src="{{ asset($user->image_url ?? 'assets/images/book/user/avatar.jpg') }}"
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
                                            <p class="text-primary">chuyên môn: Toán </p>
                                            <p>-Giáo viên với 15 năm kinh nghiệm giảng dạy online và offline môn Toán. <br>
                                                -Tác giả của hơn 30 đầu sách ID luyện thi THPT. <br>
                                                - Phương pháp giảng dạy hay, lạ, độc đáo giúp học sinh tiếp cận các bài toán
                                                nhanh, dễ hiểu.
                                            </p>
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
                                        <div class="col-6 pb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <img src="{{ asset('assets/images/book/user/4.jpg') }}" alt="profile-bg"
                                                        class="w-100"
                                                        style="height: 150px; box-shadow: 0px 4px 20px rgba(44, 101, 144, 0.5); border-radius: 10px">
                                                </div>
                                                <div class="col-6">
                                                    <span
                                                        style="font-weight: bold; display: block;">{{ $course->name }}</span>
                                                    <p>Số bài: {{ $course->amount_lecture }}</p>
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
                                <div class="text-center pt-5" style="color: black">
                                    <a href=""><span style="font-size: 20px"><i
                                                class="ri-arrow-down-s-line"></i></span> Xem thêm</a>
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
                                <h4 class="pb-4">Sách ID</h4>
                                <div class="row px-2">
                                    @forelse ($books as $book)
                                        <div class="col-3 pb-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class=""
                                                        style="border: 2px solid rgba(128, 128, 128, 0.214);">
                                                        <img src="{{ asset('assets/images/book/user/3.jpg') }}"
                                                            alt="profile-bg" class="w-100" style="height: 300px;">
                                                        <div class="px-3 pb-4 pt-3">
                                                            <span style="font-weight: 600;">
                                                                {{ $book->name }}
                                                            </span>
                                                            <br>
                                                            <div class="pb-1">
                                                                <button id="yesButton" type="submit"
                                                                    style="background-color: #c9f1f2; color: #0e9f6e; border: none; padding: 5px 5px; font-size: 10px; border-radius: 5px; cursor: pointer; font-weight: bolder;">Freeship</button>
                                                                <button id="noButton"
                                                                    style="background-color: #E1EFFE; color: #1C64F2; border: none; padding: 5px 5px; font-size: 10px; border-radius: 5px; cursor: pointer; font-weight: 500">10%</button>
                                                            </div>
                                                            <span> <a
                                                                    style="font-weight: bolder; color:#ff2a00;">{{ $book->price }}đ</a>
                                                                <b class="px-2"></b><del
                                                                    style="font-size: 12px;">{{ $book->discount }}đ</del></span>
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
                                <div class="text-center pt-5" style="color: black">
                                    <a href=""><span style="font-size: 20px"><i
                                                class="ri-arrow-down-s-line"></i></span> Xem thêm</a>
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
                                        <div class="col-6 pb-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <img src="{{ asset('assets/images/book/user/4.jpg') }}"
                                                        alt="profile-bg" class="w-100"
                                                        style="height: 150px; box-shadow: 0px 4px 20px rgba(44, 101, 144, 0.5); border-radius: 10px">
                                                </div>
                                                <div class="col-12">
                                                    <span
                                                        style="font-weight: bold; display: block;">{{ $reel->title }}</span>
                                                    <p>{{ $reel->description }}</p>
                                                </div>
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
                                <div class="text-center pt-5" style="color: black">
                                    <a href=""><span style="font-size: 20px"><i
                                                class="ri-arrow-down-s-line"></i></span> Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
