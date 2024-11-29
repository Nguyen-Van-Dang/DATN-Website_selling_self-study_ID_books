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
                <!-- Blade -->
                @if ($currentUser->role_id == 1 || $currentUser->role_id == 2)
                    <div class="input-group rounded mb-3">
                        <button wire:click="openPopup('add')"
                            class="btn btn-primary d-flex align-items-center justify-content-center px-0"
                            style="width: 265px; text-align: center;">
                            <b>Tạo nhóm chat</b>
                        </button>
                    </div>
                @endif
                <!-- Modal add-->
                <div class="modal {{ $isAddPopupOpen ? 'is-open' : '' }}" id="addChatGroupModal"
                    wire:click="closePopup()">
                    <div class="modal-content" wire:click.stop>
                        <span class="close" wire:click="closePopup()" style="z-index: 1000">&times;</span>

                        <div class="col-sm-12 p-0">
                            <div class="iq-card m-0">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Tạo nhóm chat mới</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body pb-5">
                                    <form wire:submit.prevent="createChatGroup">
                                        <div class="form-group">
                                            <label>Tên nhóm chat</label>
                                            <input wire:model="groupName" type="text" class="form-control"
                                                placeholder="Nhập tên nhóm học...">
                                            @error('groupName')
                                                <span class="text-danger">{{ $message }}<br /></span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Ảnh đại diện</label>
                                            <div class="row p-0 m-0">
                                                @if ($groupImage instanceof \Illuminate\Http\UploadedFile)
                                                    <img id="image-add" src="{{ $groupImage->temporaryUrl() }}"
                                                        alt="Click to choose image" class="img-thumbnail"
                                                        style="cursor: pointer; width: 100%; max-width: 100px;"
                                                        name="groupImage">
                                                @elseif (is_string($groupImage))
                                                    <img id="image-add" src="{{ $groupImage }}"
                                                        alt="Click to choose image" class="img-thumbnail"
                                                        style="cursor: pointer; width: 100%; max-width: 100px;"
                                                        name="groupImage">
                                                @else
                                                    <img id="image-add"
                                                        src="{{ asset('assets/images/book/default_groupchat.png') }}"
                                                        alt="Click to choose image" class="img-thumbnail"
                                                        style="cursor: pointer; width: 100%; max-width: 100px;">
                                                @endif
                                                <input type="file" class="custom-file-input"
                                                    accept="image/png, image/jpeg, image/jpg" wire:model="groupImage"
                                                    id="image-input-add" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả nhóm</label>
                                            <textarea wire:model="groupDescription" class="form-control" placeholder="Nhập mô tả..." rows="2"></textarea>
                                            @error('groupDescription')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Khoá học đại diện</label>
                                            <select wire:model="groupCourse" class="form-control">
                                                <option value="" selected>Chọn khoá học</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('groupCourse')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                        <button type="button" class="btn btn-danger"
                                            wire:click="closePopup()">Hủy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div data-mdb-perfect-scrollbar-init style="position: relative; height: 400px">
                    <ul class="list-unstyled mb-0" style="max-height: 70vh; overflow-y: auto;">
                        @if (sizeof($groups) > 0)
                            @foreach ($groups as $group)
                                <li class="py-2 mr-3 border-bottom" wire:click="selectGroup({{ $group->id }})">
                                    <a href="#!" class="row">
                                        <div class="col-3 pr-0">
                                            @php
                                                $thumbnail = $group
                                                    ->images()
                                                    ->where('image_name', 'thumbnail')
                                                    ->first();
                                            @endphp
                                            @if ($thumbnail)
                                                <img src="{{ $thumbnail->image_url }}" alt="avatar"
                                                    class="d-flex align-self-center img-fluid rounded-circle"
                                                    style="width: 50px">
                                                <span class="badge bg-success badge-dot"></span>
                                            @else
                                                <img src="{{ asset('assets/images/book/default_groupchat.png') }}"
                                                    alt="avatar"
                                                    class="d-flex align-self-center img-fluid rounded-circle"
                                                    style="width: 50px">
                                                <span class="badge bg-success badge-dot"></span>
                                            @endif

                                        </div>
                                        <div class="col-9 pl-1 pr-1">
                                            <div class="pt-1">
                                                <p class="fw-bold mb-0">
                                                    @if ($group->id == $selectedGroup->id)
                                                        <strong>{{ $group->name }}</strong>
                                                    @else
                                                        {{ $group->name }}
                                                    @endif
                                                </p>
                                            </div>

                                            @php
                                                $latestMessage = $group->messages()->latest()->first();
                                            @endphp

                                            @if ($latestMessage)
                                                <div class="row m-0 p-0">
                                                    <div class="col-7 m-0 p-0">
                                                        <p class="small text-muted">
                                                            <b>{{ Str::limit($latestMessage->message, 20, '...') }}</b>
                                                        </p>
                                                    </div>
                                                    <div class="col-5 m-0 p-0">
                                                        <p class="small text-muted mb-1" style=" font-size: 0.75rem">
                                                            {{ \Carbon\Carbon::parse($latestMessage->created_at)->locale('vi')->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="small text-muted mb-1">
                                                    Chưa có tin nhắn
                                                </p>
                                            @endif

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
    <div id="content-page" class="content-page" style="padding-top: 100px; ">
        <div class="row" style=" height: 80vh;">
            <div class="col-12 col-md-8">
                @if ($selectedGroup)
                    <div class="iq-card d-flex flex-column mb-0">
                        <div class="iq-card-header p-2 pl-3">
                            <div class="d-flex">
                                <div class="mr-2">
                                    @php
                                        $thumbnail = $selectedGroup
                                            ->images()
                                            ->where('image_name', 'thumbnail')
                                            ->first();
                                    @endphp
                                    @if ($thumbnail)
                                        <img src="{{ $thumbnail->image_url }}" alt="avatar"
                                            class="d-flex align-self-center me-3 img-fluid rounded-circle"
                                            style="width: 60px">
                                        <span class="badge bg-success badge-dot"></span>
                                    @else
                                        <img src="{{ asset('assets/images/book/default_groupchat.png') }}"
                                            alt="avatar"
                                            class="d-flex align-self-center me-3  img-fluid rounded-circle"
                                            style="width: 60px">
                                        <span class="badge bg-success badge-dot"></span>
                                    @endif

                                </div>
                                <div class="pt-1">
                                    <p class="fw-bold mb-0"><b>{{ $selectedGroup->name }}</b></p>
                                    <p class="mb-0"><i class="fa fa-user " aria-hidden="true"></i>
                                        {{ $selectedGroup->participants->count() }} thành viên</p>
                                </div>
                            </div>
                        </div>

                        <div class="chat-content px-2 overflow-scroll flex-grow-1" id="messagesContainer">
                            @if (count($messages) > 0)
                                @foreach ($messages as $message)
                                    @if ($message->user_id === $currentUser->id)
                                        {{-- Tin nhắn của người dùng hiện tại (bên phải) --}}
                                        <div class="d-flex flex-row justify-content-end">
                                            <div>
                                                <p class="p-2 me-3 mb-1 rounded self-chat message border"
                                                    style="background-color: {{ in_array($message->user->role_id, [1, 2]) ? '#ffebeb' : '#ebfffc' }}">
                                                    {{ $message->message }}</p>

                                                <p class="small me-3 mb-3 rounded text-muted float-right ">
                                                    {{ $message->created_at ? $message->created_at->locale('vi')->diffForHumans() : 'Chưa xác định' }}
                                            </div>
                                            @php
                                                $thumbnail = $message->user
                                                    ->images()
                                                    ->where('image_name', 'thumbnail')
                                                    ->first();
                                            @endphp
                                            <img src="{{ $thumbnail->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                                alt="avatar 1" style="width: 45px; height: 100%;">
                                        </div>
                                    @else
                                        {{-- Tin nhắn của người dùng khác  (bên trái) --}}
                                        <div class="d-flex flex-row justify-content-start">
                                            @php
                                                $thumbnail = $message->user
                                                    ->images()
                                                    ->where('image_name', 'thumbnail')
                                                    ->first();
                                            @endphp
                                            <img src="{{ $thumbnail->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                                alt="avatar 1" style="width: 45px; height: 100%;">
                                            <div>
                                                <p class="p-2 me-3 mb-1 rounded self-chat message border"
                                                    style="background-color: {{ in_array($message->user->role_id, [1, 2]) ? '#ffebeb' : 'hsl(0, 0%, 92%)' }}">
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
                            @if ($cantSend)
                                <div class="d-flex flex-row justify-content-end">
                                    <div>
                                        <p class="p-2 me-3 mb-1 rounded self-chat message border"
                                            style="background-color: #ff8989' }}">
                                            Bạn không thể gửi tin nhắn</p>
                                        <p class="small me-3 mb-3 rounded text-muted float-right ">
                                            {{ $message->created_at ? $message->created_at->locale('vi')->diffForHumans() : 'Chưa xác định' }}
                                    </div>
                                    @php
                                        $thumbnail = $message->user
                                            ->images()
                                            ->where('image_name', 'thumbnail')
                                            ->first();
                                    @endphp
                                    <img src="{{ $thumbnail->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                        alt="avatar 1" style="width: 45px; height: 100%;">
                                </div>
                            @endif
                        </div>

                        <div class="text-muted d-flex justify-content-start align-items-center p-3 mt-2 bg-white"
                            style="background: #ffffff!important">
                            @php
                                $user = $currentUser;
                                $thumbnail = $user ? $user->images()->where('image_name', 'thumbnail')->first() : null;
                            @endphp

                            <img src="{{ $thumbnail->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                alt="avatar 3" style="width: 60px; height: 100%;">
                            <textarea class="form-control form-control-lg" placeholder="Nhập tin nhắn..." wire:model="newMessage" rows="1"
                                oninput="autoResize(this)"
                                style="height: 66px; max-width: 100%;max-height:266px; resize: none; line-height: 25px; overflow: hidden;"></textarea>

                            <button wire:click="sendMessage" class="btn btn-primary d-flex align-items-center p-3"
                                style="height: 64px">
                                Gửi <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </div>
                    </div>

                @endif
            </div>
            <div class="col-4 d-none d-md-block iq-card pt-3" id="right-sidebar">

                <div class="pl-md-4 border-md-left">
                    @if ($selectedGroup)
                        {{-- Modal-edit --}}
                        <div class="modal {{ $isEditPopupOpen ? 'is-open' : '' }}" id="editChatGroupModal"
                            wire:click="closePopup()">
                            <div class="modal-content" wire:click.stop>
                                <span class="close" wire:click="closePopup()" style="z-index: 1000">&times;</span>

                                <div class="col-sm-12 p-0">
                                    <div class="iq-card m-0">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-title">Chỉnh sửa nhóm chat</h4>
                                            </div>
                                        </div>
                                        <div class="iq-card-body pb-5">
                                            <form wire:submit.prevent="updateChatGroup">
                                                <div class="form-group">
                                                    <label>Tên nhóm chat</label>
                                                    <input wire:model="groupName" type="text" class="form-control"
                                                        placeholder="Nhập tên nhóm học..."
                                                        value="{{ $groupName }}">
                                                    @error('groupName')
                                                        <span class="text-danger">{{ $message }}<br /></span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Ảnh đại diện</label>
                                                    <div class="row p-0 m-0">
                                                        @if ($groupImage && is_string($groupImage))
                                                            <img id="image-edit" src="{{ $groupImage }}"
                                                                alt="Click to choose image" class="img-thumbnail"
                                                                style="cursor: pointer; width: 100%; max-width: 100px;"
                                                                name="groupImage">
                                                        @elseif($groupImage)
                                                            <img id="image-edit"
                                                                src="{{ $groupImage->temporaryUrl() }}"
                                                                alt="Click to choose image" class="img-thumbnail"
                                                                style="cursor: pointer; width: 100%; max-width: 100px;"
                                                                name="groupImage">
                                                        @else
                                                            <img id="image-edit"
                                                                src="{{ asset('assets/images/book/default_groupchat.png') }}"
                                                                alt="Click to choose image" class="img-thumbnail"
                                                                style="cursor: pointer; width: 100%; max-width: 100px;">
                                                        @endif
                                                        <input type="file" class="custom-file-input"
                                                            accept="image/png, image/jpeg, image/jpg"
                                                            wire:model="groupImage" id="image-input-edit"
                                                            style="display: none;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mô tả nhóm</label>
                                                    <textarea wire:model="groupDescription" class="form-control" placeholder="Nhập mô tả..." rows="2"></textarea>
                                                    @error('groupDescription')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Khoá học đại diện</label>
                                                    <select wire:model="groupCourse" class="form-control">
                                                        @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}"
                                                                @if ($course->id == $groupCourse) selected @endif>
                                                                {{ $course->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('groupCourse')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                <button type="button" class="btn btn-danger"
                                                    wire:click="closePopup()">Hủy</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-3">
                            @php
                                $thumbnail = $selectedGroup->images()->where('image_name', 'thumbnail')->first();
                            @endphp
                            @if ($thumbnail)
                                <img src="{{ $thumbnail->image_url }}" alt="Avatar nhóm"
                                    class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                            @else
                                <img src="{{ asset('assets/images/book/default_groupchat.png') }}" alt="Avatar nhóm"
                                    class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                            @endif
                            <h4 class="mt-2">{{ $selectedGroup->name }}</h4>
                        </div>
                        <div class="row text-center mb-4 border-bottom">
                            <div class="col-3">
                                <a class="nav-link" data-toggle="pill" href="#chang-pwd" role="tab">
                                    <i class="bi bi-people" style="font-size: 2rem;color: rgb(0, 171, 0);"></i>
                                    <div style="color: rgb(0, 171, 0)">
                                        {{ $selectedGroup->participants->where('role', 0)->count() }}
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="nav-link active" data-toggle="pill" href="#personal-information"
                                    role="tab">
                                    <i class="bi bi-book" style="font-size: 2rem;"></i>
                                    <div>{{ $selectedGroup->course->name }}</div>
                                </a>
                            </div>
                            <div class="col-3 pt-2">
                                @if ($currentUser->role_id == 1 || $currentUser->role_id == 2)
                                    <a id="editGroupButton" class="bg-primary text-white dropdown-toggle"
                                        href="#" id="dropdownMenuButton5" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <div>
                                            <i class="bi bi-gear" style="font-size: 2rem; color: gray;"
                                                title="Cài Đặt"></i>
                                        </div>
                                        <div class="text-secondary">Tuỳ chọn</div>
                                        <style>
                                            .dropdown-toggle::after {
                                                display: none;
                                            }
                                        </style>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenuButton5" style="">
                                        {{-- <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>Xem</a> --}}
                                        <a class="dropdown-item" href="#"
                                            wire:click="openPopup('edit', {{ $selectedGroup->id }})"><i
                                                class="ri-pencil-fill mr-2"></i>Thay
                                            đổi thông tin</a>
                                        {{-- <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Vô
                                            hiệu hoá</a> --}}
                                        <a class="dropdown-item" href="#" id="leaveGroupButton"
                                            data-group-id="{{ $selectedGroup->id }}">
                                            <i class="ri-delete-bin-6-fill mr-2"></i>Xoá nhóm</a>

                                        {{-- <a class="dropdown-item" href="#"><i
                                                class="ri-printer-fill mr-2"></i>In</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="ri-file-download-fill mr-2"></i>Tải
                                            xuống</a> --}}
                                    </div>
                                @else
                                    <a id="leaveGroupButton" class="bg-primary text-white" href="#"
                                        data-group-id="{{ $selectedGroup->id }}">
                                        <div>
                                            <i class="bi bi-box-arrow-right" style="font-size: 2rem; color: red;"></i>
                                        </div>
                                        <div class="text-danger">Rời nhóm</div>
                                    </a>
                                @endif

                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                                <div class="mb-3">
                                    <div class="input-group rounded mb-3">
                                        <input type="text" class="form-control rounded mr-3"
                                            placeholder="Danh sách thành viên" aria-label="Danh sách thành viên"
                                            wire:model.live="searchMemberTerm">
                                    </div>
                                    <div class="iq-card-body" style="max-height: 350px; overflow-y: auto;">
                                        @if ($selectedGroup && $selectedGroup->participants)
                                            @php
                                                $hasMembers = false;
                                            @endphp

                                            @foreach ($selectedGroup->participants as $member)
                                                @if ($member->role == 0)
                                                    @php $hasMembers = true; @endphp
                                                    <a href="#" class="iq-sub-card ">
                                                        <div class="media mb-1">
                                                            <div class="">
                                                                @php
                                                                    $thumbnail = $member->user
                                                                        ->images()
                                                                        ->where('image_name', 'thumbnail')
                                                                        ->first();
                                                                @endphp
                                                                <img src="{{ $thumbnail->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                                                    alt="Thành viên"
                                                                    class="img-fluid rounded-circle mr-2"
                                                                    style="width: 40px; height: 40px;">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0">{{ $member->user->name }}</h6>
                                                                @if ($currentUser->role_id != 3)
                                                                    <small class="float-right font-size-12">
                                                                        <a id="editMember" class="dropdown-toggle   "
                                                                            href="#" data-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="ri-pencil-fill"
                                                                                style="font-size: 1rem; color: gray;"
                                                                                title="Cài Đặt"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right"
                                                                            aria-labelledby="editMember"
                                                                            style="">
                                                                            <a class="dropdown-item" href="#"
                                                                                wire:click="toggleMemberStatus({{ $member->id }})">
                                                                                {{ $member->status === 0 ? 'Chặn thành viên' : 'Kích hoạt thành viên' }}
                                                                            </a>
                                                                        </div>
                                                                    </small>
                                                                @endif

                                                                @if ($member->status === 0)
                                                                    <p class="mb-0" style="color:rgb(0, 171, 0)
">
                                                                        Hoạt động
                                                                    </p>
                                                                @else
                                                                    <p class="mb-0">
                                                                        Không hoạt động
                                                                    </p>
                                                                @endif

                                                            </div>
                                                            <style>
                                                                .dropdown-toggle::after {
                                                                    display: none;
                                                                }
                                                            </style>
                                                        </div>
                                                    </a>
                                                @endif
                                            @endforeach

                                            @if (!$hasMembers)
                                                <p>Chưa có thành viên</p>
                                            @endif
                                        @else
                                            <p>Chưa có thành viên</p>
                                        @endif
                                    </div>


                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                                <div class="mb-3">
                                    <h5>Mô tả</h5>
                                    <p>{{ $selectedGroup->description }}</p>
                                </div>
                                <div class="mb-3 border-bottom">
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
                                                @php
                                                    $thumbnail = $teacher->user
                                                        ->images()
                                                        ->where('image_name', 'thumbnail')
                                                        ->first();
                                                @endphp
                                                <img src="{{ $thumbnail->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                                    alt="Giảng viên" class="img-fluid rounded-circle mr-2"
                                                    style="width: 40px; height: 40px;">
                                                <div>{{ $teacher->user->name }}</div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                {{-- <div>
                                    <h5>Danh sách ghim</h5>
                                    <p class="text-muted">Danh sách tin nhắn ghim trống</p>
                                </div> --}}
                            </div>
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
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd" role="tab">
                                        <i class="bi bi-people" style="font-size: 2rem;color: rgb(0, 171, 0);"></i>
                                        <div style="color: rgb(0, 171, 0)">{{ $selectedGroup->participants->count() }}
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information"
                                        role="tab">
                                        <i class="bi bi-book" style="font-size: 2rem;"></i>
                                        <div>{{ $selectedGroup->course->name }}</div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a id="leaveGroupButton" class="bg-primary text-white" href="#"
                                        data-group-id="{{ $selectedGroup->id }}">
                                        <div>
                                            <i class="bi bi-box-arrow-right" style="font-size: 2rem; color: red;"></i>
                                        </div>
                                        <div class="text-danger">Rời nhóm</div>
                                    </a>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                                    <div class="mb-3">
                                        <h5>Danh sách thành viên</h5>

                                        <div class="iq-card-body" style="max-height: 45vh; overflow-y: auto;">
                                            @foreach ($selectedGroup->participants as $member)
                                                <a href="#" class="iq-sub-card ">
                                                    <div class="media align-items-center mb-1">
                                                        <div class="">
                                                            @php
                                                                $thumbnail = $member->user
                                                                    ->images()
                                                                    ->where('image_name', 'thumbnail')
                                                                    ->first();
                                                            @endphp
                                                            <img src="{{ $thumbnail->image_url ?? asset('asset/images/book/user_thumbnail') }}"
                                                                alt="avatar" class="d-flex align-self-center me-3"
                                                                style="width: 40px">
                                                        </div>
                                                        <div class="media-body ml-3">
                                                            <h6 class="mb-0 ">{{ $member->user->name }}</h6>
                                                            <small class="float-right font-size-12">Just Now</small>
                                                            <p class="mb-0">
                                                                {{ $member->role == 0 ? 'Thành viên' : 'Giảng viên' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                                    <div class="mb-3">
                                        <h5>Mô tả</h5>
                                        <p>{{ $selectedGroup->description }}</p>
                                    </div>
                                    <div class="mb-3 border-bottom">
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
                                                    @php
                                                        $thumbnail = $teacher->user
                                                            ->images()
                                                            ->where('image_name', 'thumbnail')
                                                            ->first();
                                                    @endphp
                                                    <img src="{{ $thumbnail->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                                        alt="Giảng viên" class="img-fluid rounded-circle mr-2"
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
                                </div>
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
            @if ($currentUser->role_id == 1 || $currentUser->role_id == 2)
                <p>Bạn có chắc chắn muốn xoá nhóm này không?</p>
            @else
                <p>Bạn có chắc chắn muốn rời nhóm này không?</p>
            @endif
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
        // Hàm khởi tạo để đăng ký các sự kiện
        function initializeEvents() {
            // Rời nhóm chat
            document.getElementById('leaveGroupButton').addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('confirmPopup').style.display = 'block';
                document.getElementById('overlay').style.display = 'block';

                const groupId = this.getAttribute('data-group-id');

                document.getElementById('yesButton').onclick = function() {
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
                        });
                };

                document.getElementById('noButton').onclick = function() {
                    document.getElementById('confirmPopup').style.display = 'none';
                    document.getElementById('overlay').style.display = 'none';
                };
            });

            // Tự động cuộn xuống dưới
            window.onload = scrollToBottom;

            // Tự động thay đổi kích thước textarea
            document.querySelectorAll('textarea').forEach(function(textarea) {
                textarea.style.height = textarea.scrollHeight + 'px';
                textarea.style.overflowY = 'hidden';
                textarea.addEventListener('input', function() {
                    autoResize(textarea);
                });
            });

            // Khởi tạo Pusher
            initializePusher();

            // Quản lý tab navigation
            $('a[data-toggle="pill"]').on('click', function(e) {
                e.preventDefault();
                $('a[data-toggle="pill"]').removeClass('active');
                $(this).addClass('active');
                $('.tab-pane').removeClass('active show');
                $($(this).attr('href')).addClass('active show');
            });
        }

        // Hàm cuộn xuống dưới
        function scrollToBottom() {
            var messagesContainer = document.getElementById('messagesContainer');
            if (messagesContainer) {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        }

        // Hàm tự động thay đổi kích thước textarea
        function autoResize(textarea) {
            textarea.style.height = '66px'; // Đặt lại chiều cao về mặc định
            textarea.style.height = (textarea.scrollHeight) + 'px'; // Đặt chiều cao theo nội dung
            if (textarea.scrollHeight > 266) {
                textarea.style.height = '266px';
                textarea.style.overflowY = 'auto'; // Thêm thanh cuộn nếu cần
            } else {
                textarea.style.overflowY = 'hidden';
            }
        }

        // Hàm khởi tạo Pusher
        function initializePusher() {
            Pusher.logToConsole = true;

            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                encrypted: true,
            });

            pusher.connection.bind('connected', function() {
                console.log("Connected to Pusher");
            });

            var channel = pusher.subscribe('chat.{{ $selectedGroup->id }}');

            channel.bind('new-message', function(data) {
                if (window.Livewire) {
                    Livewire.find('{{ $this->getId() }}').call('updateMessages', data.message);
                } else {
                    console.error("Livewire is not defined.");
                }
            });
        }

        // Khởi tạo sự kiện khi DOM đã sẵn sàng
        $(document).ready(initializeEvents);

        document.getElementById('image-add').addEventListener('click', function() {
            document.getElementById('image-input-add').click();
        });
        document.getElementById('image-edit').addEventListener('click', function() {
            document.getElementById('image-input-edit').click();
        });
    </script>

    <style>
        .message {
            max-width: 600px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
    </style>

</div>
