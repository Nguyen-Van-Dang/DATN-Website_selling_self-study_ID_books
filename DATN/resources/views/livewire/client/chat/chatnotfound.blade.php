<div class="container-fluid d-flex justify-content-center align-items-center">
    <img src="{{ asset('assets/images/book/error/groupchat.png') }}" alt="">
    @if (Auth::user()->role_id == 3)
        <div class="text-center mt-5">
            <h4>Bạn chưa tham gia nhóm chat nào!</h4>
            <p>Truy cập khoá học của bạn để tham gia.</p>
            <a href="{{ route('hoc-tap') }}">
                <button class="btn btn-primary mt-3"><b>Tham gia ngay !</b></button>
            </a>
        </div>
    @else
        <div class="text-center mt-5">
            <h4>Bạn chưa sở hữu nhóm chat nào!</h4>
            <p>Tạo mới nhóm chat để mọi người cùng tham gia.</p>
            <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModalCenter">
                <b>Tạo mới ngay!</b>
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered mb-0" role="document">
                <div class="modal-content">
                    <div class="col-sm-12 p-0">
                        <div class="iq-card m-0">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Tạo nhóm chat mới</h4>
                                </div>
                            </div>
                            <div class="iq-card-body pb-5">
                                <form wire:submit.prevent="submit" class="px-3">
                                    <div class="form-group">
                                        <label>Tên nhóm chat</label>
                                        <input wire:model="groupName" type="text" class="form-control"
                                            placeholder="Nhập tên nhóm học...">
                                        @error('groupName')
                                            <span class="text-danger">{{ $message }}<br /></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh đại diện: </label>
                                        <div class="form-control" style="display: contents">
                                            @if ($groupImage)
                                                <img id="image-placeholder" src="{{ $groupImage->temporaryUrl() }}"
                                                    alt="Click to choose image" class="img-thumbnail"
                                                    style="cursor: pointer; width: 100%; max-width: 200px;"
                                                    name="bookImage">
                                            @else
                                                <img id="image-placeholder"
                                                    src="{{ asset('assets/images/book/default_groupchat.png') }}"
                                                    alt="Click to choose image" class="img-thumbnail"
                                                    style="cursor: pointer; width: 100%; max-width: 200px;">
                                            @endif
                                            <input type="file" class="custom-file-input"
                                                accept="image/png, image/jpeg, image/jpg" wire:model="groupImage"
                                                id="image-input" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả nhóm</label>
                                        <textarea wire:model="groupDescription" class="form-control" placeholder="Nhập mô tả..." rows="3"></textarea>
                                        @error('groupDescription')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Khoá học đại diện</label>
                                        <select class="form-control" wire:model="groupCourse">
                                            <option value="" selected disabled>Chọn khoá học</option>
                                            @foreach ($courses as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('groupCourse')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('image-placeholder').addEventListener('click', function() {
                document.getElementById('image-input').click();
            });
        </script>
    @endif
</div>
