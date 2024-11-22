<div>
    <form wire:submit.prevent="submit" style="">
        <div class="row">

            <div class="col-sm-7">
                <div class="iq-card modal-content">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Sửa khóa học: {{ $name }}</h4>
                        </div>
                    </div>
                    <div class="iq-card-body modal-body-scrollable">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Tên khóa học:</label>
                                    <input wire:model="name" type="text" class="form-control"
                                        placeholder="Nhập tên khóa học..." name="name">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả khóa học:</label>
                                    <textarea wire:model="description" class="form-control" rows="4" placeholder="Nhập mô tả..."></textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Chọn ảnh khóa học:</label>
                                    <div class="custom-file" style="display: contents">
                                        @if ($courseImage && is_string($courseImage))
                                            <img id="image-placeholder" src="{{ $courseImage }}"
                                                alt="Click to choose image" class="img-thumbnail"
                                                style="cursor: pointer; width: 100%; max-width: 200px;">
                                        @elseif ($courseImage)
                                            <img id="image-placeholder" src="{{ $courseImage->temporaryUrl() }}"
                                                alt="Click to choose image" class="img-thumbnail"
                                                style="cursor: pointer; width: 100%; max-width: 200px;">
                                        @else
                                            <img id="image-placeholder"
                                                src="{{ asset('assets/images/book/user/course.jpg') }}"
                                                alt="No image selected" class="img-thumbnail"
                                                style="cursor: pointer; width: 100%; max-width: 200px;">
                                        @endif
                                        <input type="file" class="custom-file-input"
                                            accept="image/png, image/jpeg, image/jpg" wire:model="courseImage"
                                            id="image-input" style="display: none;">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Tác giả:</label>
                                    <select class="form-control" wire:model="courseAuthor">
                                        <option selected="" disabled="">Chọn tác giả</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ $teacher->id == $courseAuthor ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pdfInput">Chọn khóa học PDF:
                                (<a href="{{ $this->documentFile }}" target="_blank">Xem file trước đó</a>)
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"
                                    accept="application/pdf, application/vnd.ms-excel" wire:model="documentFile"
                                    name="documentFile">
                                <label id="pdfLabel" class="custom-file-label">Chọn file</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Giá khóa học:</label>
                                <input wire:model="price" type="number" class="form-control"
                                    placeholder="Nhập giá khóa học...">
                            </div>
                            <div class="col-md-6">
                                <label>Giảm giá:</label>
                                <input wire:model="discount" type="number" class="form-control"
                                    placeholder="Nhập giá giảm khóa học...">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            {{ Auth::user()->id == 1 ? 'Cập nhật' : 'Cập nhật' }}
                        </button>
                        <button type="reset" class="btn btn-danger">Trở lại</button>
                    </div>
                </div>
            </div>

            <!-- Form thêm chương và bài giảng -->
            <div class="col-sm-5">
                <div class="iq-card modal-content">
                    <div class="iq-card-header">
                        <h4 class="card-title">Chỉnh sửa chương và bài giảng</h4>
                    </div>
                    <div class="iq-card-body modal-body-scrollable">
                        @foreach ($lectureCategories as $chapterIndex => $chapter)
                            <div class="chapter mb-3">
                                <!-- Tên chương -->
                                <input wire:model.prevent="lectureCategories.{{ $chapterIndex }}.name" type="text"
                                    class="form-control" placeholder="Nhập tên chương...">
                                <!-- Nút thêm bài giảng -->
                                <button wire:click.prevent="addLecture({{ $chapterIndex }})"
                                    class="btn btn-success mt-2">
                                    + Thêm Bài Giảng
                                </button>
                                @foreach ($chapter['lectures'] as $lectureIndex => $lecture)
                                    <div class="lecture mt-3">
                                        <!-- Tên bài giảng -->
                                        <input
                                            wire:model.defer="lectureCategories.{{ $chapterIndex }}.lectures.{{ $lectureIndex }}.name"
                                            type="text" class="form-control" placeholder="Nhập tên bài giảng...">
                                        <!-- Tải video -->
                                        <div class="row">
                                            <div class="col-11" style="padding-right: 0"><input
                                                    wire:model="lectureCategories.{{ $chapterIndex }}.lectures.{{ $lectureIndex }}.video"
                                                    type="file" class="form-control mt-2"></div>
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                <!-- Hiển thị video -->
                                                @if (!empty($lecture['id']))
                                                    @php
                                                        $image = App\Models\Image::where('imageable_id', $lecture['id'])
                                                            ->where('imageable_type', 'App\Models\Lecture')
                                                            ->where('image_name', 'video')
                                                            ->first();
                                                    @endphp
                                                    @if ($image)
                                                        <a href="{{ $image->image_url }}" target="_blank"
                                                            data-toggle="tooltip" title="Xem video" style="margin-top: 10px;"><i
                                                                class="ri-eye-line" style="font-size: 25px;"></i></a>
                                                    @else
                                                    <a target="_blank"
                                                        data-toggle="tooltip" title="Không có video" style="margin-top: 10px;">
                                                        <i class="ri-eye-off-line" style="font-size: 25px;"></i>
                                                    </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>


                                        <!-- Nút xóa bài giảng -->
                                        <button
                                            wire:click.prevent="removeLecture({{ $chapterIndex }}, {{ $lectureIndex }})"
                                            class="btn btn-danger mt-2">
                                            Xóa Bài Giảng
                                        </button>
                                    </div>
                                @endforeach
                                <hr>
                            </div>
                        @endforeach
                        <!-- Nút thêm chương -->
                        <button wire:click.prevent="addChapter" class="btn btn-primary mt-3">+ Thêm Chương</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
