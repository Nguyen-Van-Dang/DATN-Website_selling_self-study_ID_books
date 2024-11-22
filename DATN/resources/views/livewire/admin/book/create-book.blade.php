<div class="row">
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Thêm sách</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <form wire:submit.prevent="submit">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tên sách:</label>
                                <input type="text" class="form-control" placeholder="Nhập tên sách..."
                                    wire:model="bookName" name="bookName">
                                @error('bookName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Tác giả:</label>
                                        <select class="form-control" wire:model="bookAuthor" name="bookAuthor">
                                            @if ($teachers)
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option selected value="{{ Auth::id() }}">{{ Auth::user()->name }}</option>
                                            @endif
                                        </select>
                                        @error('bookAuthor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Sách pdf:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"
                                                accept="application/pdf, application/vnd.ms-excel" wire:model="bookFile"
                                                name="bookFile">
                                            <label class="custom-file-label">Chọn file</label>
                                        </div>
                                        @error('bookFile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Giá sách:</label>
                                        <input type="number" class="form-control" placeholder="Nhập giá sách..."
                                            wire:model="bookPrice" name="bookPrice">
                                        @error('bookPrice')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Giảm giá:</label>
                                        <input type="number" class="form-control" placeholder="%..."
                                            wire:model="bookDiscount" name="bookDiscount">
                                        @error('bookDiscount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Số trang:</label>
                                        <input type="number" class="form-control" placeholder="Nhập số trang..."
                                            name="bookPage" wire:model="bookPage">
                                        @error('bookPage')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label>Số lượng:</label>
                                        <input type="number" class="form-control" placeholder="Nhập số lượng..."
                                            wire:model="bookQuantity" name="bookQuantity">
                                        @error('bookQuantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Hình ảnh:</label>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="custom-file" style="display: contents">
                                            @if ($bookImage)
                                                <img id="image-placeholder" src="{{ $bookImage->temporaryUrl() }}"
                                                    alt="Click to choose image" class="img-thumbnail"
                                                    style="cursor: pointer; width: 100%; max-width: 200px;"
                                                    name="bookImage">
                                            @else
                                                <img id="image-placeholder"
                                                    src="{{ asset('assets/images/book/book_placeholder.png') }}"
                                                    alt="Click to choose image" class="img-thumbnail"
                                                    style="cursor: pointer; width: 100%; max-width: 200px;">
                                            @endif
                                            <input type="file" class="custom-file-input"
                                                accept="image/png, image/jpeg, image/jpg" wire:model="bookImage"
                                                id="image-input" style="display: none;">
                                        </div>
                                    </div>

                                    <div class="col-8">
                                        <div class="custom-file" style="display:contents">
                                            @for ($i = 0; $i < 4; $i++)
                                                <div class="custom-file" style="display: contents">
                                                    @if (isset($imageGallery[$i]))
                                                        <img id="image-placeholder-{{ $i }}"
                                                            src="{{ $imageGallery[$i]->temporaryUrl() }}"
                                                            alt="Click to choose image" class="img-thumbnail p-0 m-1"
                                                            style="cursor: pointer; width: 100%; max-width: 100px;">
                                                    @else
                                                        <img id="image-placeholder-{{ $i }}"
                                                            src="{{ asset('assets/images/book/book_gallery.png') }}"
                                                            alt="Click to choose image" class="img-thumbnail p-0 m-1"
                                                            style="cursor: pointer; width: 100%; max-width: 100px;">
                                                    @endif
                                                    <input type="file" class="custom-file-input"
                                                        accept="image/png, image/jpeg"
                                                        wire:model="imageGallery.{{ $i }}"
                                                        id="image-input-{{ $i }}" style="display: none;">
                                                </div>
                                            @endfor
                                        </div>
                                        <label for="" class="text-muted mt-3">Chọn tối thiểu 1 ảnh bìa và 1
                                            ảnh phụ</label>
                                        <br>
                                        @error('bookImage')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                        @error('imageGallery')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Danh mục sách:</label>
                                <div class="overflow-scroll shadow-sm p-3 mb-5 bg-white rounded"
                                    style="max-height: 190px; overflow-y: auto;margin-bottom:0!important">
                                    @foreach ($categories as $category)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="category-{{ $category->id }}" value="{{ $category->id }}"
                                                wire:model="selectedCategories">
                                            <label class="custom-control-label"
                                                for="category-{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                @error('selectedCategories')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label>Mô tả:</label>
                                <textarea class="form-control" rows="4" placeholder="Nhập nội dung..." wire:model="bookDescription"
                                    name="bookDescription"></textarea>
                                @error('bookDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ Auth::user()->id == 1 ? 'Thêm mới' : 'Gửi phê duyệt' }}
                    </button>
                    <a href="{{ route('admin.sach.index') }}" class="btn btn-danger">Trở lại</a>

                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('image-placeholder').addEventListener('click', function() {
            document.getElementById('image-input').click();
        });
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 4; i++) {
                document.getElementById(`image-placeholder-${i}`).addEventListener('click', function() {
                    document.getElementById(`image-input-${i}`).click();
                });
            }

        });
    </script>
</div>
