<div class="container-fluid">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row" style="margin-top: -3%;">
        <!-- VIDEO -->
        <div class="col-md-8 videos">
            <div class="align-element">
                <!-- VIDEO 1 -->
                @foreach ($reels as $reel)
                    <div class="video">
                        <ul class="notifications" style="right:0; top:75px;"></ul>
                        <div class="video-box">
                            <div class="video-info">
                                <div class="video-section">
                                    <iframe src="{{ $reel->video_url }}" width="380" height="570"
                                        data-reel-id="{{ $reel->id }}"></iframe>
                                    <span class="video-play-icon"><i class="bx bx-play"></i></span>
                                    <div id="video-timeline" class="video-timeline">
                                        <div id="progress-bar" class="progress-bar"></div>
                                    </div>
                                </div>
                                <div class="user-info">
                                    <h5 class="h5" style="width: 300px;">
                                        {{ $reel->user ? $reel->user->name : 'Không xác định' }}</h5>
                                    <p style="width: 300px;">{{ $reel->title }}</p>
                                    {{-- <div class="flex items-center justify-between controlss">
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
                                    </div> --}}
                                </div>
                            </div>
                            <div class="video-desc">
                                {{-- Follow --}}
                                <div class="user-profile">
                                    <img src="{{ asset('assets/images/book/user/7.jpg') }}" alt="" />
                                    @if (auth()->check() && auth()->user()->id !== $reel->user->id)
                                        @if (auth()->user()->followings()->where('following_id', $reel->user->id)->exists())
                                            <!-- Nút Unfollow -->
                                            <span class="follow buttons"
                                                onclick="event.preventDefault(); document.getElementById('unfollow-form-{{ $reel->user->id }}').submit(); toggleIcon()">
                                                <b><i id="success_follow" class="btn bx bx-minus icon"
                                                        style="background: none"></i></b>
                                            </span>
                                            <form id="unfollow-form-{{ $reel->user->id }}"
                                                action="{{ route('unfollow', $reel->user->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @else
                                            <!-- Nút Follow -->
                                            <span class="follow buttons"
                                                onclick="event.preventDefault(); document.getElementById('follow-form-{{ $reel->user->id }}').submit(); toggleIcon()">
                                                <b><i id="success_follow" class="btn bx bx-plus icon"
                                                        style="background: none"></i></b>
                                            </span>
                                            <form id="follow-form-{{ $reel->user->id }}"
                                                action="{{ route('follow', $reel->user->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        @endif
                                    @endif
                                </div>
                                <ul style="padding-left: 0;">
                                    <li style="padding-top: 30%">
                                        <span class="like"><i class="bx bxs-heart"></i></span>
                                        <span>123k</span>
                                    </li>
                                    <li>
                                        <span class="comments">
                                            <i class="bx bxs-message-rounded-dots" id="message"></i>
                                        </span>
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
                    <!-- Popup1 -->
                    <div id="popup1" class="popup1">
                        <!-- COMMENT -->
                        <button id="closePopup1" class="closePopup1">X</button>
                        <div class="col-12 content-column"
                            style="box-shadow: 0px 20px 20px 0px rgba(44, 101, 144, 0.1); height: 570px;">
                            <div class="content-box">
                                <h4 class="text-center">Bình luận</h3>
                                    <div class="video-container">
                                        <div class="post">
                                            <div class="post-comments open">
                                                <div class="post-comments-area">
                                                    {{-- COMMENT --}}
                                                    @foreach ($comments as $comment)
                                                    <span>ID: {{ $comment->id }}</span>
                                                        <div class="post-comment">
                                                            <div class="post-comment-user verified">
                                                                <img class="post-comment-user-img"
                                                                    src="{{ asset('assets/images/book/user/13.jpg') }}">
                                                            </div>
                                                            <div class="post-comment-content">
                                                                <div class="post-comment-user-name verified">
                                                                    <a href="#">{{ $comment->user->name }}</a>
                                                                </div>
                                                                <div class="post-comment-user-msg">
                                                                    {{ $comment->content }}</div>
                                                                <p>
                                                                    <a href="" class="hours">created_at</a>
                                                                    <a href="" class="likes">Thích</a>
                                                                    <a href="" class="feedback">Phản hồi</a>
                                                                </p>
                                                            </div>
                                                            <div class="post-comment-like-btn like"><i
                                                                    class="bx bxs-heart"></i>
                                                                <p class="post-comment-like-number">9</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- FORM COMMENT --}}
                                                    <div class="post-comment-input">
                                                        <input type="text" name="" class="post-comment-text"
                                                            placeholder="Nhập nội dung....">
                                                        <button class="post-comment-send"><i
                                                                class="fa fa-send send-btn"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div id="popupOverlay" class="overlay"></div>
                @endforeach
            </div>
        </div>

        {{-- popup --}}
        <script>
            // Lấy phần tử
            const message = document.getElementById("message");
            const popup1 = document.getElementById("popup1");
            const closePopup1 = document.getElementById("closePopup1");
            const popupOverlay = document.getElementById("popupOverlay");

            // Hiển thị popup1 khi nhấn vào biểu tượng
            message.addEventListener("click", () => {
                popup1.style.display = "block";
                popupOverlay.style.display = "block";
            });

            // Đóng popup1 khi nhấn nút đóng
            closePopup1.addEventListener("click", () => {
                popup1.style.display = "none";
                popupOverlay.style.display = "none";
            });

            popupOverlay.addEventListener("click", (event) => {
                if (event.target === popupOverlay) {
                    popup1.style.display = "none";
                    popupOverlay.style.display = "none";
                }
            });
            // Hàm hiển thị popup
            function showPopup() {
                popup1.style.display = "block";
                popupOverlay.style.display = "block";
            }
            // Gắn sự kiện click cho tất cả video khi render
            function attachVideoClickEvents() {
                const videos = document.querySelectorAll(".video");
                videos.forEach(video => {
                    video.addEventListener("click", showPopup);
                });
            }

            // Gọi hàm này sau khi render dữ liệu
            attachVideoClickEvents();
        </script>

        <!-- CONTENT -->
        <div class="col-md-4 content-column" id="content-column"
            style="box-shadow: 0px 20px 20px 0px rgba(44, 101, 144, 0.1); height: 570px;">
            <div class="content-box">
                <h3>New Content</h3>
                <p>Here is the content for the new column. You can add text, images, or other elements as needed.</p>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let iframes = document.querySelectorAll('iframe[data-reel-id]');

                iframes.forEach(iframe => {
                    let hasSent = false;

                    let observer = new IntersectionObserver(function(entries) {
                        if (entries[0].isIntersecting && !hasSent) {
                            let reelId = iframe.getAttribute('data-reel-id');
                            console.log(`Video ID: ${reelId}`); // Kiểm tra reelId

                            fetch(`/reels/view/${reelId}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute('content'),
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log(`Response data:`, data); // Kiểm tra phản hồi
                                    if (data.success) {
                                        hasSent = true;
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    }, {
                        threshold: 0.5
                    });

                    observer.observe(iframe);
                });
            });
        </script>

        <style>
            .popup1 {
                width: 40%;
                border-radius: 15px;
                top: 2rem;
            }

            #closePopup1 {
                position: absolute;
                top: 0px;
                right: 0px;

            }

            .closePopup1 {
                border: none;
                background-color: white;
                color: black;
                font-weight: bolder;
                border-radius: 15px;
            }

            .closePopup1:hover {
                color: #0dd6b8;
            }

            .popup1 {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                z-index: 1001;
            }

            /* Overlay */
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                /* Đặt overlay dưới popup */
            }

            body {
                height: 100px;
                overflow: hidden;
            }

            .iq-footer {
                margin-left: 0;
            }

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
    </div>
