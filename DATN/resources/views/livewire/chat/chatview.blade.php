<div class="containter-fluid">
    <div class="iq-sidebar">
        <div class="iq-sidebar-logo">
            <div class="iq-sidebar-logo d-flex justify-content-between p-0">
                <a href="http://127.0.0.1:8000" class="header-logo">
                    <img id="main-logo" src="http://127.0.0.1:8000/assets/images/book/icon/big_logo.png"
                        class="img-fluid rounded-normal" alt="">
                </a>
                <div class="iq-menu-bt align-self-center d-md-none">
                    <div class="wrapper-menu">
                        <i class="bi bi-list"></i>
                    </div>
                </div>
            </div>
            <div class="pt-3">
                <div class="input-group rounded mb-3">
                    <input type="text" class="form-control rounded mr-3" placeholder="Tìm kiếm" aria-label="Tìm kiếm"
                        wire:model.live.debounce.100ms="searchTerm" />
                </div>
                <div data-mdb-perfect-scrollbar-init style="position: relative; height: 400px">
                    <ul class="list-unstyled mb-0">
                        @if (sizeof($groups) > 0)
                            @foreach ($groups as $group)
                                <li class="py-2 mr-3 border-bottom" wire:click="selectGroup({{ $group->id }})">
                                    <a href="#!" class="row">
                                        <div class="col-3 pr-0">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                alt="avatar" class="d-flex align-self-center" style="width: 50px">
                                            <span class="badge bg-success badge-dot"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="pt-1">
                                                <p class="fw-bold mb-0">{{ $group->name }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                @php
                                                    $latestMessage = $group->messages()->latest()->first();
                                                @endphp

                                                @if ($latestMessage)
                                                    <p class="small text-muted">
                                                        <b>{{ Str::limit($latestMessage->message, 16, '...') }}</b>
                                                    </p>
                                                    <p class="small text-muted mb-1">
                                                        {{ \Carbon\Carbon::parse($latestMessage->created_at)->locale('vi')->diffForHumans() }}
                                                    </p>
                                                @else
                                                    <p class="small text-muted mb-1">
                                                        Chưa có tin nhắn
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content-page" class="content-page">
        <div class="row">
            <div class="col-12 col-md-8">
                @if ($selectedGroup)
                    <div class="iq-card d-flex flex-column mb-0" style="height: 84vh;">

                        <div class="iq-card-header p-2 pl-3">
                            <div class="d-flex">
                                <div class="mr-2">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                        alt="avatar" class="d-flex align-self-center me-3" style="width: 60px">
                                    <span class="badge bg-success badge-dot"></span>
                                </div>
                                <div class="pt-1">
                                    <p class="fw-bold mb-0"><b>{{ $selectedGroup->name }}</b></p>
                                    <p class="mb-0"><i class="fa fa-user " aria-hidden="true"></i>
                                        {{ $selectedGroup->participants->count() }} thành viên</p>
                                </div>
                            </div>
                        </div>

                        <div class="chat-content pe-3 overflow-scroll flex-grow-1" id="messagesContainer">
                            @if (count($messages) > 0)
                                @foreach ($messages as $message)
                                    @if ($message->user_id === Auth::id())
                                        {{-- Tin nhắn của người dùng hiện tại (bên phải) --}}
                                        <div class="d-flex flex-row justify-content-end">
                                            <div>
                                                <p class="p-2 me-3 mb-1 rounded self-chat"
                                                    style="background-color: #d3fff8;">{{ $message->message }}</p>
                                                <p class="small me-3 mb-3 rounded text-muted float-right">
                                                    {{ $message->created_at ? $message->created_at->locale('vi')->diffForHumans() : 'Chưa xác định' }}
                                            </div>
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                alt="avatar 1" style="width: 45px; height: 100%;">
                                        </div>
                                    @else
                                        {{-- Tin nhắn của người dùng khác  (bên trái) --}}
                                        <div class="d-flex flex-row justify-content-start">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                                alt="avatar 1" style="width: 45px; height: 100%;">
                                            <div>
                                                <p class="p-2 ms-3 mb-1 rounded"
                                                    style="background-color: hsl(0, 0%, 92%);">
                                                    {{ $message->message }}
                                                </p>
                                                <p class="small ms-3 mb-3 rounded text-muted float-end">
                                                    {{ $message->created_at ? $message->created_at->locale('vi')->diffForHumans() : 'Chưa xác định' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center align-items-center flex-column"
                                    style="height: 50vh;">
                                    <p class="text-center">Chưa có ai ở đây cả <br>Hãy là người đầu tiên viết lên những
                                        thông
                                        điệp tuyệt vời!</p>
                                    <img src="{{ asset('assets/images/book/icon/handwave.png') }}" alt=""
                                        height="50px" class="mt-1">
                                </div>

                            @endif
                        </div>

                        <div class="text-muted d-flex justify-content-start align-items-center p-3 mt-2 bg-white"
                            style="background: #ffffff!important">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                alt="avatar 3" style="width: 60px; height: 100%;">
                            <input type="text" class="form-control form-control-lg" placeholder="Nhập tin nhắn..."
                                wire:model="newMessage">
                            {{-- <a class="mx-1 text-muted" href="#!"><i class="fas fa-image"></i></a> --}}
                            <button wire:click="sendMessage" class="btn btn-primary d-flex align-items-center p-3">
                                Gửi <i class="fas fa-paper-plane ml-2"></i>
                            </button>

                        </div>
                    </div>
                    <script>
                        document.addEventListener('livewire:load', function() {
                            if (typeof groupId !== 'undefined') {
                                Echo.channel('chat-group.' + groupId)
                                    .listen('.message.sent', (e) => {
                                        console.log('Message received:', e.message);
                                        Livewire.emit('messageReceived', e.message);
                                    });
                            } else {
                                console.warn('Group ID is undefined');
                            }
                        });
                    </script>
                @endif
            </div>
            <div class="col-4 d-none d-md-block iq-card pt-3" id="right-sidebar">
                <div class="pl-md-4 border-md-left">
                    @if ($selectedGroup)
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/images/book/user/6.jpg') }}" alt="Nhóm Mooners"
                                class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                            <h4 class="mt-2">{{ $selectedGroup->name }}</h4>
                        </div>
                        <div class="row text-center mb-4 border-bottom">
                            <div class="col-3">
                                <div>
                                    <i class="bi bi-people" style="font-size: 2rem;color: rgb(0, 171, 0);"></i>
                                </div>
                                <div style="color: rgb(0, 171, 0)">{{ $selectedGroup->participants->count() }}</div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <i class="bi bi-book" style="font-size: 2rem;"></i>
                                </div>
                                <div>{{ $selectedGroup->course->name }}</div>
                            </div>
                            <div class="col-3">
                                <a id="leaveGroupButton" class="bg-primary text-white" href="#">
                                    <div>
                                        <i class="bi bi-box-arrow-right" style="font-size: 2rem; color: red;"></i>
                                    </div>
                                    <div class="text-danger">Rời nhóm</div>
                                </a>

                            </div>
                        </div>
                        <div class="mb-3">
                            <h5>Mô tả</h5>
                            <p>{{ $selectedGroup->description }}</p>
                        </div>
                        <div class="mb-3  border-bottom">
                            <h5>Khoá học</h5>
                            <p>{{ $selectedGroup->course->description }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Giáo viên</h5>
                            @php
                                $teachers = $selectedGroup->participants->filter(function ($participant) {
                                    return $participant->role == 1;
                                });
                            @endphp
                            @if ($teachers->isEmpty())
                                <div class="d-flex align-items-center">
                                    Không tìm thấy.
                                </div>
                            @else
                                @foreach ($teachers as $teacher)
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/book/user/6.jpg') }}" alt="Giảng viên"
                                            class="img-fluid rounded-circle mr-2" style="width: 40px; height: 40px;">
                                        <div>{{ $teacher->user->name }}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <h5>Danh sách ghim</h5>
                            <p class="text-muted">Danh sách tin nhắn ghim trống</p>
                        </div>
                    @else
                        <p>Chọn một nhóm chat để xem thông tin.</p>
                    @endif
                </div>
            </div>

            {{-- nút của responsive mobile --}}
            <div class="iq-colorbox color-fix d-md-none">
                <div class="buy-button"> <a class="color-full" href="#"><i class="fa fa-bars"></i></a> </div>
                <div class="clearfix color-picker text-center">


                    <div class="pl-md-4 border-md-left">
                        @if ($selectedGroup)
                            <div class="text-center mb-3">
                                <img src="{{ asset('assets/images/book/user/6.jpg') }}" alt="Nhóm Mooners"
                                    class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                                <h4 class="mt-2">{{ $selectedGroup->name }}</h4>
                            </div>
                            <div class="row text-center mb-4 border-bottom">
                                <div class="col-3">
                                    <div>
                                        <i class="bi bi-people" style="font-size: 2rem;color: rgb(0, 171, 0);"></i>
                                    </div>
                                    <div style="color: rgb(0, 171, 0)">{{ $selectedGroup->participants->count() }}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <i class="bi bi-book" style="font-size: 2rem;"></i>
                                    </div>
                                    <div>{{ $selectedGroup->course->name }}</div>
                                </div>
                                <div class="col-3">
                                    <a id="leaveGroupButton" class="bg-primary text-white" href="#">
                                        <div>
                                            <i class="bi bi-box-arrow-right" style="font-size: 2rem; color: red;"></i>
                                        </div>
                                        <div class="text-danger">Rời nhóm</div>
                                    </a>

                                </div>
                            </div>
                            <div class="mb-3">
                                <h5>Mô tả</h5>
                                <p>{{ $selectedGroup->description }}</p>
                            </div>
                            <div class="mb-3  border-bottom">
                                <h5>Khoá học</h5>
                                <p>{{ $selectedGroup->course->description }}</p>
                            </div>
                            <div class="mb-3">
                                <h5>Giáo viên</h5>
                                @php
                                    $teachers = $selectedGroup->participants->filter(function ($participant) {
                                        return $participant->role == 1;
                                    });
                                @endphp
                                @if ($teachers->isEmpty())
                                    <div class="d-flex align-items-center">
                                        Không tìm thấy.
                                    </div>
                                @else
                                    @foreach ($teachers as $teacher)
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/images/book/user/6.jpg') }}" alt="Giảng viên"
                                                class="img-fluid rounded-circle mr-2"
                                                style="width: 40px; height: 40px;">
                                            <div>{{ $teacher->user->name }}</div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div>
                                <h5>Danh sách ghim</h5>
                                <p class="text-muted">Danh sách tin nhắn ghim trống</p>
                            </div>
                        @else
                            <p>Chọn một nhóm chat để xem thông tin.</p>
                        @endif
                    </div>


                </div>
            </div>
        </div>

        {{-- popup xác nhận xoá --}}
        <div id="confirmPopup"
            style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
            <p>Bạn có chắc chắn muốn rời nhóm này không?</p>
            <div class="text-center">
                <button id="yesButton"
                    style="width: 90px; height: 35px; border: none; color: white; background: #11e1c2; border-radius: 5px;">
                    Xác nhận
                </button>
                <button id="noButton"
                    style="width: 90px; height: 35px; border: none; color: black; background-color: #0000000e; border-radius: 5px;">
                    Trở về
                </button>
            </div>
        </div>
        <div id="overlay"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;">
        </div>


    </div>
    <script>
        document.getElementById('leaveGroupButton').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('confirmPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('yesButton').onclick = function() {
                const groupId = '{{ $selectedGroup->id }}';
                fetch(`/leave-group/${groupId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    })
            };
            document.getElementById('noButton').addEventListener('click', function() {
                document.getElementById('confirmPopup').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
            });
        });

        function scrollToBottom() {
            var messagesContainer = document.getElementById('messagesContainer');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
        window.onload = scrollToBottom;
    </script>


</div>
