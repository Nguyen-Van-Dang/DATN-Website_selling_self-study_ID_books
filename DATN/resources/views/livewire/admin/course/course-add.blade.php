<div>
    <div class="row">
        <div class="col-sm-7">
            <div class="iq-card modal-content">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Thêm khóa học</h4>
                    </div>
                </div>
                <div class="iq-card-body modal-body-scrollable">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Tên khóa học:</label>
                                <input wire:model="courseName" type="text" class="form-control"
                                    placeholder="Nhập tên khóa học...">
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
                                    @if ($image_url)
                                        <img id="image-placeholder" src="{{ $image_url->temporaryUrl() }}"
                                            alt="Click to choose image" class="img-thumbnail"
                                            style="cursor: pointer; width: 100%; max-width: 300px;"
                                            name="image_url">
                                    @else
                                        <img id="image-placeholder"
                                            src="{{ asset('assets/images/book/user/course.jpg') }}"
                                            alt="Click to choose image" class="img-thumbnail"
                                            style="cursor: pointer; width: 100%; max-width: 300px;">
                                    @endif
                                    <input type="file" class="custom-file-input"
                                        accept="image/png, image/jpeg, image/jpg" wire:model="image_url"
                                        id="image-input" style="display: none;">
                                </div>
                                <script>
                                    document.getElementById('image-placeholder').addEventListener('click', function() {
                                        document.getElementById('image-input').click();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Chọn khóa học PDF:</label>
                        <div class="custom-file" wire:ignore>
                            <input wire:model="document_url" type="file" class="custom-file-input" id="pdfInput" accept=".pdf,.doc,.docx" onchange="updateFileName()">
                            <label class="custom-file-label" for="pdfInput" id="pdfLabel">Chọn file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tác giả:</label>
                        <select class="form-control" wire:model="courseAuthor" name="courseAuthor">
                            <option selected="" disabled="">Chọn tác giả</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <script>
                        function updateFileName() {
                            const input = document.getElementById('pdfInput');
                            const label = document.getElementById('pdfLabel');
                            const fileName = input.files[0]?.name || 'Chọn file';
                            label.textContent = fileName;
                        }
                    </script>
                    
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
                    <button wire:click="storeCourse" class="btn btn-primary">{{ Auth::user()->id == 1 ? 'Thêm khóa học' : 'Gửi phê duyệt' }}</button>
                    <button type="reset" class="btn btn-danger">Xóa bỏ</button>
                </div>
            </div>
        </div>
        <!-- Form thêm chương và bài giảng -->
        <div class="col-sm-5">
            <div class="iq-card modal-content">
                <div class="iq-card-header">
                    <h4 class="card-title">Thêm chương bài giảng</h4>
                </div>
                <div class="iq-card-body modal-body-scrollable">
                    @foreach ($lectureCategories as $chapterIndex => $chapter)
                        <div class="chapter mb-3">
                            <input wire:model.defer="lectureCategories.{{ $chapterIndex }}" type="text"
                                class="form-control" placeholder="Nhập tên chương...">
                            <button wire:click="addLecture({{ $chapterIndex }})" class="btn btn-success mt-2">+ Thêm
                                Bài
                                Giảng</button>
                            @foreach ($lectures[$chapterIndex] ?? [] as $lectureIndex => $lecture)
                                <div class="lecture mt-3">
                                    <input wire:model.defer="lectures.{{ $chapterIndex }}.{{ $lectureIndex }}"
                                        type="text" class="form-control" placeholder="Nhập tên bài giảng...">
                                    {{-- <input wire:model.defer="lectureVideo.{{ $chapterIndex }}.{{ $lectureIndex }}"
                                        type="file" class="form-control mt-2"> --}}
                                        <input wire:model.lazy="lectureVideo.{{ $chapterIndex }}.{{ $lectureIndex }}" type="file" class="form-control mt-2">

                                    <button wire:click="removeLecture({{ $chapterIndex }}, {{ $lectureIndex }})"
                                        class="btn btn-danger mt-2">Xóa Bài Giảng</button>
                                </div>
                            @endforeach
                            <hr>
                        </div>
                    @endforeach
                    <button wire:click="addChapter" class="btn btn-primary">Thêm chương</button>
                </div>
            </div>
        </div>
        <style>
            .form-control {
                line-height: 25px
            }

            .modal-content {
                max-height: 90vh;
                overflow-y: auto;
                padding-right: 15px;
            }

            .modal-body-scrollable {
                max-height: calc(85vh - 100px);
                overflow-y: auto;
            }

            .chapter {
                border: 1px solid #ccc;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 5px;
            }
        </style>
    </div>
</div>
