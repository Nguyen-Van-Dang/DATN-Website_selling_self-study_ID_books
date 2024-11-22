<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Thêm liên kết kích hoạt</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label>Tác giả</label>
                        <select class="form-control" wire:model.live="teacherId" name="Teacher">
                            <option selected="">Chọn giảng viên</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacherId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 d-flex">

                        <div class="icon iq-icon-box mr-3">
                            <a href="javascript:void();">
                                @if ($selectedTeacher)
                                    <img class="img-fluid avatar-60 rounded-circle"
                                        src="{{ $selectedTeacher->images()->where('image_name', 'avatar')->first() ? $selectedTeacher->images()->where('image_name', 'avatar')->first()->image_url : asset('assets/images/book/user_thumbnail.png') }}"
                                        alt="">
                                @else
                                    <img class="img-fluid avatar-60 rounded-circle"
                                        src="{{ asset('assets/images/book/user_thumbnail.png') }}" alt="">
                                @endif
                            </a>
                        </div>
                        <div class="mt-1">
                            <h6> {{ $selectedTeacher ? $selectedTeacher->name : 'Chọn giảng viên sở hữu' }}</h6>
                            <p class="mb-0 text-primary">Số lượng sách: {{ $books ? count($books) : '0' }}</p>
                            <p class="mb-0 text-primary">Số lượng khóa học: {{ $courses ? count($courses) : '0' }}</p>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="form-group">
                            <label>Sách kích hoạt</label>
                            <select class="form-control" name="selectedBook" wire:model.live="bookId">
                                @if ($selectedTeacher)
                                    @if (count($books) > 0)
                                        <option selected="">Chọn sách</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}">{{ $book->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected="" disabled>Giảng viên không sở hữu sách có thể kích hoạt
                                        </option>
                                    @endif
                                @else
                                    <option selected="" disabled>Chọn giảng viên trước</option>
                                @endif
                            </select>
                            @error('bookId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group d-flex justify-content-center">
                                    @if ($selectedBook)
                                        @if ($selectedBook->images()->where('image_name', 'thumbnail')->first())
                                            <img src="{{ $selectedBook->images()->where('image_name', 'thumbnail')->first()->image_url }}"
                                                alt="Ảnh sách" class="img-thumbnail" style="height: 200px !important;">
                                        @else
                                            <img src="{{ asset('assets/images/book/book_placeholder.png') }}"
                                                alt="Click to choose image" class="img-thumbnail"
                                                style="height: 200px !important;">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/images/book/book_placeholder.png') }}"
                                            alt="Ảnh sách" class="img-thumbnail" style="height: 200px !important;">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Thông tin sách</label>
                                    <div>
                                        <h6 class="mb-1">{{ $selectedBook ? $selectedBook->name : 'Tên sách' }}
                                        </h6>
                                        <p>{{ $selectedBook ? $selectedBook->description : 'Mô tả' }}</p>
                                        <span class="d-block">
                                            <i class="ri-calendar-fill"></i>Ngày đăng:
                                            {{ $selectedBook ? \Carbon\Carbon::parse($selectedBook->created_at)->format('d-m-Y') : '' }}</span>

                                        <span class="d-block">
                                            <i class="ri-pages-fill"></i>Số trang:
                                            {{ $selectedBook ? $selectedBook->page_number : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="form-group">
                            <label>Khoá học kích hoạt</label>
                            <select class="form-control" name="selectedCourse" wire:model.live="courseId">
                                @if ($selectedTeacher)
                                    @if (count($courses) > 0)
                                        <option selected="">Chọn khoá học</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected="" disabled>Giảng viên không sở hữu khoá học có thể kích
                                            hoạt
                                        </option>
                                    @endif
                                @else
                                    <option selected="" disabled>Chọn giảng viên trước</option>
                                @endif
                            </select>
                            @error('courseId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-sm-12">
                                <div class="form-group d-flex justify-content-center">
                                    @if ($selectedCourse)
                                        @if ($selectedCourse->images()->where('image_name', 'thumbnail')->first())
                                            <img src="{{ $selectedCourse->images()->where('image_name', 'thumbnail')->first()->image_url }}"
                                                alt="Click to choose image" class="img-thumbnail">
                                        @else
                                            <img src="{{ asset('assets/images/book/course_thumbnail.png') }}"
                                                alt="Click to choose image" class="img-thumbnail">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/images/book/course_thumbnail.png') }}"
                                            alt="Click to choose image" class="img-thumbnail">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Thông tin khoá học</label>
                                    <div>
                                        <h6 class="mb-1">
                                            {{ $selectedCourse ? $selectedCourse->name : 'Tên khoá học' }}
                                        </h6>
                                        <p>{{ $selectedCourse ? $selectedCourse->description : 'Mô tả' }}</p>
                                        <span class="d-block">
                                            <i class="ri-calendar-fill"></i>Ngày đăng:
                                            {{ $selectedCourse ? \Carbon\Carbon::parse($selectedCourse->created_at)->format('d-m-Y') : '' }}</span>

                                        <span class="d-block">
                                            <i class="ri-play-circle-fill"></i>Số bài giảng:
                                            {{ $selectedCourse ? $selectedCourse->lectures->count() : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Tạo mã kích hoạt</label>
                            <div class="custom-file">
                                <input type="number" class="form-control" name="codeQuantity"
                                    value="{{ $selectedBook ? $selectedBook->quantity : '' }}" readonly>

                            </div>
                            <p class="text-muted small mt-3">
                                Số lượng mã = số lượng sách tồn kho
                            </p>
                            @error('codeQuantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ Auth::user()->role_id == 1 ? 'Thêm mới' : 'Gửi phê duyệt' }}
                </button>
                <a href="{{ route('admin.kich-hoat-sach.index') }}" class="btn btn-danger">Trở lại</a>

            </form>
        </div>
    </div>
</div>
