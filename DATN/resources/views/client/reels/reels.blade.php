@extends('layouts.client.client')

@section('title', 'Reels')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            height: 100px;
            overflow: hidden;
        }

        .iq-footer {
            margin-left: 0;
        }
    </style>
    {{-- <script>
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F5' || (event.key === 'r' && event.ctrlKey)) {
                event.preventDefault();
            }
        });

        window.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        });
    </script> --}}
    <div class="container-fluid">
        <div class="row">
            <!-- VIDEO SECTION -->
            <div class="col-md-8 videos">
                <div class="align-element">
                    <!-- VIDEO 1 -->
                    <div class="video">
                        <ul class="notifications" style="right:0; top:75px;"></ul>
                        <div class="video-box">
                            <div class="video-info">
                                {{-- <div class="video-container"> --}}
                                <div class="video-section">
                                    <video id="videoPlayer" src="{{ asset('assets/images/book/reals/reals 1.mp4') }}"
                                        class="videoPlayer"></video>
                                    <span class="video-play-icon"><i class="bx bx-play"></i></span>
                                    <div id="video-timeline" class="video-timeline">
                                        <div id="progress-bar" class="progress-bar"></div>
                                    </div>
                                </div>
                                <div class="user-info">
                                    <h5>@NguyenVanDang</h5>
                                    <p>Cây cam ngọt của tôi</p>
                                    <div class="flex items-center justify-between controlss">
                                        <button class="control-button text-white">
                                            <i class="fas fa-play"></i>
                                        </button>
                                        <div class="flex items-center">
                                            <input class="volume-slider w-24 h-1 bg-blue-500 rounded-lg" type="range"
                                                value="0" />
                                            <span class="ml-2 text-sm">00:00</span>
                                        </div>
                                        <div class="flex items-center">
                                            <button class="control-button text-white">
                                                <i class="fa fa-volume-up"></i>
                                            </button>
                                            <button class="control-button text-white">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <button class="control-button text-white">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- </div> --}}
                            </div>
                            <div class="video-desc">
                                <div class="user-profile">
                                    <img src="{{ asset('assets/images/book/user/7.jpg') }}" alt="" />
                                    <span class="follow buttons" onclick="toggleIcon()">
                                        <b><i id="success_follow" class="btn bx bx-plus icon"
                                                style="background: none"></i></b>
                                    </span>
                                </div>
                                <ul style="padding-left: 0;">
                                    <li style="padding-top: 30%">
                                        <span class="like"><i class="bx bxs-heart"></i></span>
                                        <span>83k</span>
                                    </li>
                                    <li>
                                        <span class="comments"><i id="commentIcon"
                                                class="bx bxs-message-rounded-dots"></i></span>
                                        <span>80k</span>
                                    </li>
                                    <li>
                                        <span class="like buttons"><i id="success_save" class="btn bx bxs-bookmark"
                                                style="background: none"></i></span>
                                        <span>999.5k</span>
                                    </li>
                                    <li>
                                        <span class="like"><i class="bx bxs-share bx-flip-horizontal"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- VIDEO 1 -->
                    <div class="video">
                        <ul class="notifications" style="right:0; top:75px;"></ul>
                        <div class="video-box">
                            <div class="video-info">
                                {{-- <div class="video-container"> --}}
                                <div class="video-section">
                                    <video id="videoPlayer" src="{{ asset('assets/images/book/reals/reals 2.mp4') }}"
                                        class="videoPlayer"></video>
                                    <span class="video-play-icon"><i class="bx bx-play"></i></span>
                                    <div id="video-timeline" class="video-timeline">
                                        <div id="progress-bar" class="progress-bar"></div>
                                    </div>
                                </div>
                                <div class="user-info">
                                    <h5>@NguyenVanDang</h5>
                                    <p>Cây cam ngọt của tôi</p>
                                    <div class="flex items-center justify-between controlss">
                                        <button class="control-button text-white">
                                            <i class="fas fa-play"></i>
                                        </button>
                                        <div class="flex items-center">
                                            <input class="volume-slider w-24 h-1 bg-blue-500 rounded-lg" type="range"
                                                value="0" />
                                            <span class="ml-2 text-sm">00:00</span>
                                        </div>
                                        <div class="flex items-center">
                                            <button class="control-button text-white">
                                                <i class="fa fa-volume-up"></i>
                                            </button>
                                            <button class="control-button text-white">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <button class="control-button text-white">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- </div> --}}
                            </div>
                            <div class="video-desc">
                                <div class="user-profile">
                                    <img src="{{ asset('assets/images/book/user/7.jpg') }}" alt="" />
                                    <span class="follow buttons" onclick="toggleIcon()">
                                        <b><i id="success_follow" class="btn bx bx-plus icon"
                                                style="background: none"></i></b>
                                    </span>
                                </div>
                                <ul style="padding-left: 0;">
                                    <li style="padding-top: 30%">
                                        <span class="like"><i class="bx bxs-heart"></i></span>
                                        <span>83k</span>
                                    </li>
                                    <li>
                                        <span class="comments"><i id="commentIcon"
                                                class="bx bxs-message-rounded-dots"></i></span>
                                        <span>80k</span>
                                    </li>
                                    <li>
                                        <span class="like buttons"><i id="success_save" class="btn bx bxs-bookmark"
                                                style="background: none"></i></span>
                                        <span>999.5k</span>
                                    </li>
                                    <li>
                                        <span class="like"><i class="bx bxs-share bx-flip-horizontal"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="col-md-4 content-column" id="content-column"
                style="box-shadow: 0px 20px 20px 0px rgba(44, 101, 144, 0.1); height: 570px;">
                <div class="content-box">
                    <h3>New Content</h3>
                    <p>Here is the content for the new column. You can add text, images, or other elements as needed.</p>
                </div>
            </div>

            <!-- COMMENT -->
            <div class="col-md-4 content-column" id="newContentColumn"
                style="display: none; box-shadow: 0px 20px 20px 0px rgba(44, 101, 144, 0.1); height: 570px;">
                <div class="content-box">
                    <h4 class="text-center">Bình luận</h3>
                        <div class="video-container">
                            <div class="post">
                                <div class="post-comments open">
                                    <div class="post-comments-area">
                                        <div class="post-comment">
                                            <div class="post-comment-user verified">
                                                <img class="post-comment-user-img"
                                                    src="{{ asset('assets/images/book/user/13.jpg') }}">
                                            </div>
                                            <div class="post-comment-content">
                                                <div class="post-comment-user-name verified"><a href="#">Nguyễn Văn
                                                        A</a></div>
                                                <div class="post-comment-user-msg">commnent1</div>
                                                <p>
                                                    <a href="" class="hours">18 giờ</a>
                                                    <a href="" class="likes">Thích</a>
                                                    <a href="" class="feedback">Phản hồi</a>
                                                </p>
                                            </div>
                                            <div class="post-comment-like-btn like"><i class="bx bxs-heart"></i>
                                                <p class="post-comment-like-number">9</p>
                                            </div>
                                        </div>
                                        <p>{{-- feedback --}}</p>
                                        <div class="post-comment" id="comment-feedback">
                                            <div class="post-comment-user verified">
                                                <img class="post-comment-user-img"
                                                    src="{{ asset('assets/images/book/user/13.jpg') }}">
                                            </div>
                                            <div class="post-comment-content">
                                                <div class="post-comment-user-name verified"><a href="#">Nguyễn Văn
                                                        B</a></div>
                                                <div class="post-comment-user-msg">Feedback</div>
                                                <p>
                                                    <a href="" class="hours">18 giờ</a>
                                                    <a href="" class="likes">Thích</a>
                                                    <a href="" class="feedback">Phản hồi</a>
                                                </p>
                                            </div>
                                            <div class="post-comment-like-btn like"><i class="bx bxs-heart"></i>
                                                <p class="post-comment-like-number">9</p>
                                            </div>
                                        </div>

                                        <div class="post-comment">
                                            <div class="post-comment-user verified">
                                                <img class="post-comment-user-img"
                                                    src="{{ asset('assets/images/book/user/13.jpg') }}">
                                            </div>
                                            
                                            <div class="post-comment-content">
                                                <div class="post-comment-user-name verified"><a href="#">Nguyễn Văn
                                                        C</a></div>
                                                <div class="post-comment-user-msg">Commnent 2</div>
                                                <p>
                                                    <a href="" class="hours">18 giờ</a>
                                                    <a href="" class="likes">Thích</a>
                                                    <a href="" class="feedback">Phản hồi</a>
                                                </p>
                                            </div>
                                            <div class="post-comment-like-btn like"><i class="bx bxs-heart"></i>
                                                <p class="post-comment-like-number">9</p>
                                            </div>
                                        </div>
                                        <div class="post-comment-input">
                                            <input type="text" name="" class="post-comment-text"
                                                placeholder="Nhập nội dung....">
                                            <button class="post-comment-send"><i class="fa fa-send send-btn"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <style>
                    #comment-feedback {
                        padding: 0 0 0 40px;
                        margin-top: -35px;
                    }

                    .likes {
                        padding: 0 10px;
                        color: #333;
                        font-weight: 500;
                        font-size: 14px;
                    }

                    .likes:hover {
                        color: var(--iq-primary);
                    }

                    .hours {
                        color: #333;
                        font-weight: 500;
                        font-size: 14px;
                    }

                    .hours:hover {
                        color: var(--iq-primary);
                    }

                    .feedback {
                        color: #333;
                        font-weight: 500;
                        font-size: 14px;
                    }

                    .feedback:hover {
                        color: var(--iq-primary);
                    }

                    .post-comments {
                        position: relative;
                        height: 475px;
                        display: flex;
                        flex-direction: column;
                        background: white;
                        pointer-events: all;
                    }

                    .post-comments::before {
                        content: "";
                        position: absolute;
                        top: 5px;
                        left: 50%;
                        width: 50%;
                        padding: 1px;
                        background-color: #333;
                        border-radius: 50px;
                        transform: translate(-50%);
                    }

                    .post-comments.open {
                        bottom: 0;
                    }

                    .close-comment {
                        position: absolute;
                        top: 10px;
                        right: 10px;
                        cursor: pointer;
                        font-size: 20px;
                        font-weight: 300px;
                    }

                    .post-comments-area {
                        flex: 1;
                        overflow-y: auto;
                        padding: 10px;
                        pointer-events: all;
                    }

                    .post-comment {
                        margin: 10px 0;
                        display: flex;
                        width: 100%;
                        align-items: center;
                        justify-content: space-between;
                        text-align: left;
                    }

                    .post-comment-user-name {
                        display: flex;
                    }

                    .post-comment-user-img {
                        overflow: hidden;
                        border-radius: 50%;
                        height: 40px;
                        width: 40px;
                        margin-top: -40px;
                    }

                    .post-comment-user-verified {
                        width: 15px;
                        height: 15px;
                        font-size: 10px;
                    }

                    .post-comment-user-msg {
                        font-size: 14px;
                    }

                    .post-comment-like-btn {
                        text-align: center;
                        cursor: pointer;
                    }

                    .post-comment-like-btn p {
                        font-size: 10px;
                    }

                    .post-comment-like-btn .post-comment-like-icon.liked {
                        color: #ff2828;
                    }

                    .post-comment-content {
                        display: flex;
                        flex-direction: column;
                        padding-left: 20px;
                        justify-content: center;
                        width: 100%;
                    }

                    .post-comment-input {
                        display: flex;
                        height: 50px;
                        width: 100%;
                        align-items: center;
                        justify-content: flex-start;
                        box-shadow: 0px 4px 20px rgba(44, 101, 144, 0.1);
                        border-radius: 10px;
                        background-color: white;
                        padding: 0 10px;
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        pointer-events: all;
                        top: 100%
                    }

                    .post-comment-text {
                        height: 40px;
                        width: 100%;
                        border: 0;
                        padding: 10px 20px;
                        box-sizing: border-box;
                    }

                    .post-comment-send {
                        height: 40px;
                        width: 40px;
                        border: 0;
                        background-color: transparent;
                        cursor: pointer;
                        padding-right: 12%;
                    }

                    .music-name {
                        display: flex;
                        font-size: 10px;
                        padding: 5px;
                    }

                    .song-name {
                        margin-left: 10px;
                    }

                    video.post-video {
                        height: 100%;
                        width: 100%;
                        object-fit: cover;
                    }
                </style>
            @endsection
