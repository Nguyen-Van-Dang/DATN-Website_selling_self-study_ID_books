<div class="container-fluid">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row mt-3">
        <!-- VIDEO -->
        <div class="col-md-6 videos">
            <div class="align-element">
                <!-- VIDEO 1 -->
                @foreach ($reels as $reel)
                    <div class="video">
                        <ul class="notifications" style="right:0; top:75px;"></ul>
                        <div class="video-box" data-reel-id="{{ $reel->id }}">
                            <div class="video-info">
                                <div class="video-section">
                                    <iframe id="videoFrame" src="{{ $reel->preview_url }}" width="450" height="750"
                                        allow="autoplay; fullscreen" playsinline></iframe>
                                    {{-- <span class="video-play-icon"><i class="bx bx-play"></i></span>
                                    <div id="video-timeline" class="video-timeline">
                                        <div id="progress-bar" class="progress-bar"></div>
                                    </div> --}}
                                </div>
                                <div class="user-info">
                                    <h5 class="h5" style="width: 300px;">
                                        {{ $reel->user ? $reel->user->name : 'Không xác định' }}</h5>
                                    <p style="width: 300px;">{{ $reel->title }}</p>
                                </div>
                            </div>
                            <div class="video-desc">
                                {{-- Follow --}}
                                <div class="user-profile">
                                    @if ($reel->user->images())
                                        <img src="{{ $reel->user->images()->where('image_name', 'thumbnail')->first()->image_url }}"
                                            alt="" />
                                    @else
                                        <img src="{{ asset('assets/images/book/user_thumbnail.png') }}"
                                            alt="" />
                                    @endif

                                </div>
                                <ul style="padding-left: 0;">
                                    <li style="padding-top: 30%">
                                        @if ($user)
                                            <span class="like" wire:click="toggleLike">
                                                <i
                                                    class="{{ $isLiked ? 'bx bxs-heart text-danger' : 'bx bx-heart' }}"></i>
                                            </span>
                                        @else
                                            <span class="like">
                                                <i class=" bx bx-heart"></i>
                                            </span>
                                        @endif
                                        <span>{{ $likeCount }}</span>
                                    </li>
                                    <li>
                                        <span class="comments">
                                            <i class="bx bxs-message-rounded-dots" id="message"></i>
                                        </span>
                                        <span>{{ $commentCount }}</span>
                                    </li>
                                    {{-- <li>
                                        <span class="like buttons"><i id="success_save" class="btn bx bxs-bookmark"
                                                style="background: none"></i></span>
                                        <span>999.5k</span>
                                    </li>
                                    <li>
                                        <span class="like"><i class="bx bxs-share bx-flip-horizontal"></i></span>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- COMMENT -->
        <div class="col-md-4 ml-3">
            <div class="iq-card">
                <div class="card-header">
                    Bình luận <span><small>{{ $commentCount }} </small></span>
                </div>
                <div class="card-body" style="max-height: 589px; overflow-y: auto; overflow-x: hidden;">
                    @if (count($comments) < 1)
                        <p>Chưa có bình luận nào.</p>
                    @else
                        <!-- Danh sách bình luận -->
                        @foreach ($comments as $comment)
                            <li class="d-flex mb-3" style="width:100%">
                                <div class="icon iq-icon-box mr-3">
                                    <a href="javascript:void();">
                                        @if ($comment->user->images())
                                            <img class="img-fluid avatar-60 rounded-circle"
                                                src="{{ $comment->user->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                                alt="">
                                        @else
                                            <img class="img-fluid avatar-60 rounded-circle"
                                                src="{{ asset('assets/images/book/user_thumbnail.png') }}"
                                                alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="mt-1">
                                    <a href="javascript:void(0)">
                                        <h6>{{ $comment->user->name }} <small class="text-muted">
                                                {{ $comment->created_at ? $comment->created_at->locale('vi')->diffForHumans() : 'Chưa xác định' }}</small>
                                        </h6>
                                    </a>
                                    {{-- đây là bình luận --}}
                                    @if ($isEditingCommentId === $comment->id)
                                        <div class="input-group" style="width: 350px;">
                                            <input type="text" class="form-control" wire:model.defer="editComment"
                                                placeholder="Nhập nội dung">
                                            <button class="btn btn-primary" wire:click="updateComment">
                                                <i class="fa fa-send send-btn"></i>
                                            </button>
                                            <button class="btn btn-secondary" wire:click="cancelEdit"><i
                                                    class="fa-solid fa-x"></i></button>
                                        </div>
                                    @else
                                        <p class="mb-0">{{ $comment->content }}</p>
                                    @endif
                                    <a href="javascript:void(0)" wire:click="toggleReplies({{ $comment->id }})">
                                        <span>Phản hồi ({{ $comment->replies->count() }})</span>
                                    </a>
                                    {{-- Hiển thị các phản hồi chỉ khi showRepliesId trùng với comment ID --}}
                                    @if ($showRepliesId == $comment->id)
                                        @foreach ($comment->replies as $reply)
                                            <div class="d-flex mb-2">
                                                <div class="icon iq-icon-box">
                                                    <a href="javascript:void();">
                                                        <img class="img-fluid avatar-40 rounded-circle"
                                                            src="{{ $reply->user->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="pt-1" style="width: 100%;">
                                                    @if ($isEditingReplyId === $reply->id)
                                                        <div class="input-group" style="width: 300px;">
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="editReply"
                                                                placeholder="Nhập nội dung">
                                                            <button class="btn btn-primary btn-sm"
                                                                wire:click="updateReply">
                                                                <i class="fa fa-send send-btn"></i>
                                                            </button>
                                                            <button class="btn btn-secondary btn-sm"
                                                                wire:click="cancelEditReply">
                                                                <i class="fa-solid fa-x"></i>
                                                            </button>
                                                        </div>
                                                    @else
                                                        <a href="">
                                                            <h6>{{ $reply->user->name }} <small class="text-muted">
                                                                    {{ $reply->created_at ? $reply->created_at->locale('vi')->diffForHumans() : 'Chưa xác định' }}</small>
                                                            </h6>
                                                        </a>
                                                        <p class="mb-0">{{ $reply->content }}</p>
                                                    @endif
                                                </div>
                                                @if ($user)
                                                    @if ($reply->user_id == $user->id)
                                                        <div class="dropdown ml-auto">
                                                            <i class="bi bi-three-dots dropdown-toggle p-0 text-body"
                                                                id="dropdownMenuButton3" data-toggle="dropdown"
                                                                aria-expanded="false"></i>
                                                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                                                aria-labelledby="dropdownMenuButton3">
                                                                <a class="dropdown-item"
                                                                    wire:click="toggleEditReply({{ $reply->id }})"
                                                                    href="javascript:void(0)">Chỉnh sửa</a>
                                                                <a class="dropdown-item"
                                                                    wire:click="deleteComment({{ $reply->id }})"
                                                                    href="javascript:void(0)">Xoá</a>
                                                            </div>
                                                        </div>
                                                    @elseif($user->role_id == 1 || $user->id == $selectedReel->user_id)
                                                        <div class="dropdown ml-auto">
                                                            <i class="bi bi-three-dots dropdown-toggle p-0 text-body"
                                                                id="dropdownMenuButton3" data-toggle="dropdown"
                                                                aria-expanded="false"></i>
                                                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                                                aria-labelledby="dropdownMenuButton3">
                                                                <a class="dropdown-item"
                                                                    wire:click="deleteComment({{ $reply->id }})"
                                                                    href="javascript:void(0)">Ẩn</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        @endforeach


                                        {{-- Ô nhập phản hồi --}}
                                        @if ($user)
                                            <div class="input-group" style="width: 350px;">
                                                <input type="text" class="form-control"
                                                    placeholder="Để lại phản hồi" wire:model.defer="newReply">
                                                <input type="hidden">
                                                <button class="btn btn-primary" wire:click="addReply">
                                                    <i class="fa fa-send send-btn"></i>
                                                </button>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                {{-- bình luận của bản thân --}}
                                {{-- check role khác role học sinh --}}
                                @if ($user)
                                    @if ($user->id == $selectedReel->user_id)
                                        @if ($comment->user_id == $user->id)
                                            <div class="dropdown ml-auto">
                                                <i class="bi bi-three-dots dropdown-toggle p-0 text-body"
                                                    id="dropdownMenuButton3" data-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                                    aria-labelledby="dropdownMenuButton3" style="">
                                                    <a class="dropdown-item"
                                                        wire:click="toggleEdit({{ $comment->id }})"
                                                        href="javascript:void(0)">Chỉnh sửa</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        wire:click="deleteComment({{ $comment->id }})">Xoá</a>
                                                </div>
                                            </div>
                                        @else
                                            <div class="dropdown ml-auto">
                                                <i class="bi bi-three-dots dropdown-toggle p-0 text-body"
                                                    id="dropdownMenuButton3" data-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                                    aria-labelledby="dropdownMenuButton3" style="">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        wire:click="deleteComment({{ $comment->id }})">Ẩn bình
                                                        luận</a>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($user->role_id == 1)
                                        <div class="dropdown ml-auto">
                                            <i class="bi bi-three-dots dropdown-toggle p-0 text-body"
                                                id="dropdownMenuButton3" data-toggle="dropdown"
                                                aria-expanded="false"></i>
                                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                                aria-labelledby="dropdownMenuButton3" style="">
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    wire:click="deleteComment({{ $comment->id }})">Ẩn bình luận</a>
                                            </div>
                                        </div>
                                    @else
                                        @if ($comment->user_id == $user->id)
                                            <div class="dropdown ml-auto">
                                                <i class="bi bi-three-dots dropdown-toggle p-0 text-body"
                                                    id="dropdownMenuButton3" data-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                                    aria-labelledby="dropdownMenuButton3" style="">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        wire:click="toggleEdit({{ $comment->id }})">Chỉnh sửa</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        wire:click="deleteComment({{ $comment->id }})">Xoá</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    @endif

                </div>
                <div class="card-footer">
                    <li class="d-flex mb-3 align-items-stretch">
                        @if ($user)
                            <div class="icon iq-icon-box mr-3">
                                <a href="javascript:void();">
                                    <img class="img-fluid avatar-60 rounded-circle"
                                        src="{{ $user->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                        alt="">
                                </a>
                            </div>
                            <div class="input-group flex-grow-1">
                                <input style="height: 100%" type="text" class="form-control"
                                    placeholder="Để lại bình luận" wire:model.defer="newComment">
                                <button class="btn btn-primary" wire:click="addComment">
                                    <i class="fa fa-send send-btn"></i>
                                </button>
                            </div>
                        @else
                            <div class="icon iq-icon-box mr-3">
                                <a href="javascript:void();">
                                    <img class="img-fluid avatar-60 rounded-circle"
                                        src="{{ asset('assets/images/book/user_thumbnail.png') }}" alt="">
                                </a>
                            </div>
                            <div class="input-group flex-grow-1">
                                <input style="height: 100%" type="text" class="form-control"
                                    placeholder="Đăng nhập để bình luận" disabled>
                                <button class="btn btn-primary" disabled>
                                    <i class="fa fa-send send-btn"></i>
                                </button>
                            </div>
                        @endif

                    </li>
                </div>

            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const videos = document.querySelectorAll('.video-box');

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const reelId = entry.target.getAttribute('data-reel-id');

                            // Dispatch sự kiện custom
                            window.dispatchEvent(new CustomEvent('reelSelected', {
                                detail: {
                                    reelId
                                }
                            }));
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.5
                });

                videos.forEach(video => {
                    observer.observe(video);
                });
            });

            // function scrollToBottom() {
            //     var messagesContainer = document.getElementById('messagesContainer');
            //     if (messagesContainer) {
            //         messagesContainer.scrollTop = messagesContainer.scrollHeight;
            //     }
            // }
        </script>

        <style>
            .dropdown-toggle:empty::after {
                display: none !important;
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
