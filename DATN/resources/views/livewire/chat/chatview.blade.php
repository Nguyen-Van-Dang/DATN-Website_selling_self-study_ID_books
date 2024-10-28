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
                    <input type="search" class="form-control rounded mr-3" placeholder="Tìm kiếm" aria-label="Tìm kiếm"
                        aria-describedby="search-addon" />
                </div>
                <div data-mdb-perfect-scrollbar-init style="position: relative; height: 400px">
                    <ul class="list-unstyled mb-0">
                        @foreach ($groups as $group)
                            <li class="py-2 mr-3 border-bottom" wire:click="selectGroup({{ $group->id }})">
                                <a href="#!" class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <div class="me-1">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                alt="avatar" class="d-flex align-self-center me-3"
                                                style="width: 50px">
                                            <span class="badge bg-success badge-dot"></span>
                                        </div>
                                        <div class="pt-1">
                                            <p class="fw-bold mb-0">{{ $group->name }}</p>
                                            <p class="small text-muted">
                                                <b>{{ $group->latest_message ? $group->latest_message : 'Không có tin nhắn' }}</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pr-1">
                                        <p class="small text-muted mb-1">
                                            {{ $group->last_message_time ? $group->last_message_time->diffForHumans() : '' }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                        {{-- <li class="py-2 mr-3 border-bottom">
                            <a href="#!" class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                    <div>
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                            alt="avatar" class="d-flex align-self-center me-3" style="width: 50px">
                                        <span class="badge bg-success badge-dot"></span>
                                    </div>
                                    <div class="pt-1">
                                        <p class="fw-bold mb-0">Marie Horwitz</p>
                                        <p class="small text-muted">Hello, Are you there?</p>
                                    </div>
                                </div>
                                <div class="pr-1">
                                    <p class="small text-muted mb-1">10 phút</p>
                                </div>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content-page" class="content-page">
        <div class="row">
            <div class="col-12 col-md-8 pr-0">
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

                        <div class="chat-content pe-3 overflow-scroll flex-grow-1">
                            @if (count($messages) > 0)
                                @foreach ($messages as $message)
                                    @if ($message->user_id === Auth::id())
                                        {{-- Tin nhắn của người dùng hiện tại (bên phải) --}}
                                        <div class="d-flex flex-row justify-content-end">
                                            <div>
                                                <p class="p-2 me-3 mb-1 rounded self-chat"
                                                    style="background-color: #d3fff8;">{{ $message->message }}</p>
                                                <p class="small me-3 mb-3 rounded text-muted float-right">
                                                    {{ $message->created_at ? $message->created_at->diffForHumans() : 'Chưa xác định' }}
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
                                                    {{ $message->created_at ? $message->created_at->diffForHumans() : 'Chưa xác định' }}
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
            <div class="col-4 d-none d-md-block" id="right-sidebar">
                <div class="pl-md-4 border-md-left">
                    @if ($selectedGroup)
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/images/book/user/6.jpg') }}" alt="Nhóm Mooners"
                                class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                            <h3 class="mt-2">{{ $selectedGroup->name }}</h3>
                        </div>
                        <div class="row text-center mb-4 border-bottom">
                            <div class="col">
                                <div>
                                    <i class="bi bi-people" style="font-size: 2rem;color: rgb(0, 171, 0);"></i>
                                </div>
                                <div style="color: rgb(0, 171, 0)">451K</div>
                            </div>
                            <div class="col">
                                <div>
                                    <i class="bi bi-book" style="font-size: 2rem;"></i>
                                </div>
                                <div>Môn Vật Lý</div>
                            </div>
                            <div class="col">
                                <div>
                                    <i class="bi bi-box-arrow-right" style="font-size: 2rem; color: red;"></i>
                                </div>
                                <div class="text-danger">Rời nhóm</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5>Mô tả</h5>
                            <p>{{ $selectedGroup->description }}</p>
                        </div>
                        <div class="mb-3  border-bottom">
                            <h5>Khoá học</h5>
                            <p>Khoá học luyện thi Vật Lý 12</p>
                        </div>
                        <div class="mb-3">
                            <h5>Giáo viên</h5>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/book/user/6.jpg') }}" alt="Giảng viên"
                                    class="img-fluid rounded-circle mr-2" style="width: 40px; height: 40px;">
                                <div>Phan Văn Tính</div>
                            </div>
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
                                <h3 class="mt-2">{{ $selectedGroup->name }}</h3>
                            </div>
                            <div class="row text-center mb-4 border-bottom">
                                <div class="col">
                                    <div>
                                        <i class="bi bi-people" style="font-size: 2rem;color: rgb(0, 171, 0);"></i>
                                    </div>
                                    <div style="color: rgb(0, 171, 0)">451K</div>
                                </div>
                                <div class="col">
                                    <div>
                                        <i class="bi bi-book" style="font-size: 2rem;"></i>
                                    </div>
                                    <div>Môn Vật Lý</div>
                                </div>
                                <div class="col">
                                    <div>
                                        <i class="bi bi-box-arrow-right" style="font-size: 2rem; color: red;"></i>
                                    </div>
                                    <div class="text-danger">Rời nhóm</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h5>Mô tả</h5>
                                <p>{{ $selectedGroup->description }}</p>
                            </div>
                            <div class="mb-3  border-bottom">
                                <h5>Khoá học</h5>
                                <p>Khoá học luyện thi Vật Lý 12</p>
                            </div>
                            <div class="mb-3">
                                <h5>Giáo viên</h5>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/images/book/user/6.jpg') }}" alt="Giảng viên"
                                        class="img-fluid rounded-circle mr-2" style="width: 40px; height: 40px;">
                                    <div>Phan Văn Tính</div>
                                </div>
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
    </div>

</div>
