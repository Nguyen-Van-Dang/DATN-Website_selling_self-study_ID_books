<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Thêm đề thi</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Tác giả</label>
                                <select class="form-control" wire:model.live="teacherId" name="Teacher">
                                    @if (Auth::user()->role_id == 1)
                                        <option selected="">Chọn giảng viên</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option selected value="{{ Auth::id() }}">{{ Auth::user()->name }}
                                        </option>
                                    @endif

                                </select>
                                @error('teacherId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group col-lg-6">
                                <div class="icon iq-icon-box mr-3">
                                    <a href="javascript:void();">
                                        @if ($selectedTeacher)
                                            <img class="img-fluid avatar-60 rounded-circle"
                                                src="{{ $selectedTeacher->images()->where('image_name', 'avatar')->first() ? $selectedTeacher->images()->where('image_name', 'avatar')->first()->image_url : asset('assets/images/book/user_thumbnail.png') }}"
                                                alt="">
                                        @else
                                            <img class="img-fluid avatar-60 rounded-circle"
                                                src="{{ asset('assets/images/book/user_thumbnail.png') }}"
                                                alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="mt-1">
                                    <h6> {{ $selectedTeacher ? $selectedTeacher->name : 'Chọn giảng viên sở hữu' }}
                                    </h6>
                                    <p class="mb-0 text-primary">Số lượng sách:
                                        {{ $selectedTeacher ? count($selectedTeacher->books) : '0' }}</p>
                                    <p class="mb-0 text-primary">Số lượng khóa học:
                                        {{ $selectedTeacher ? count($selectedTeacher->courses) : '0' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Khoá học kích hoạt</label>
                                    <select class="form-control" name="selectedCourse" wire:model.live="courseId">
                                        @if ($selectedTeacher)
                                            @if (count($selectedTeacher->courses) > 0)
                                                <option selected="">Chọn khoá học</option>
                                                @foreach ($selectedTeacher->courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            @else
                                                <option selected="" disabled>Giảng viên không sở hữu khoá học có thể
                                                    kích
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
                                <div class="form-group">
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
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
                                @if ($selectedCourse)
                                    @if ($selectedCourse->images()->where('image_name', 'thumbnail')->first())
                                        <img src="{{ $selectedCourse->images()->where('image_name', 'thumbnail')->first()->image_url }}"
                                            alt="Click to choose image" class="img-thumbnail img-fluid"
                                            style="height:215.703px">
                                    @else
                                        <img src="{{ asset('assets/images/book/course_thumbnail.png') }}"
                                            alt="Click to choose image" class="img-thumbnail img-fluid"
                                            style="height:215.703px">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/book/course_thumbnail.png') }}"
                                        alt="Click to choose image" class="img-thumbnail img-fluid"
                                        style="height:215.703px">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nhập liệu bộ đề bài tập</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept=".xls, .xlsx"
                                            wire:model="examFile" name="examFile">
                                        <label class="custom-file-label">
                                            {{ $examFile ? $examFile->getClientOriginalName() : 'Chọn file' }}
                                        </label>
                                    </div>
                                    @error('examFile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label><small>Mẫu bộ đề có dạng: (<a
                                                href="{{ asset('assets/images/book/examFile.xlsx') }}" target="_blank"
                                                download>Tải xuống mẫu</a>)</small></label>
                                    <img class="img-fluid" src="{{ asset('assets/images/book/exam.jpg') }}"
                                        alt="">

                                </div>
                                <div class="form-group">
                                    <label>Tên bài tập:</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên bài tập..."
                                        wire:model="examName" name="examName">
                                    @error('examName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mô tả:</label>
                                    <textarea class="form-control" rows="3" placeholder="Nhập nội dung..." wire:model="examDescription"
                                        name="examDescription"></textarea>
                                    @error('examDescription')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="iq-card">
                                    <div class="iq-card-body overflow-scroll "
                                        style="max-height: 500px; overflow-y: auto">
                                        @if ($questions)
                                            @foreach ($questions as $index => $question)
                                                <div class="question">
                                                    <p class="m-0">
                                                        <small>
                                                            <b>Câu {{ $index + 1 }}: {{ $question[0] }}</b>
                                                        </small>
                                                    </p>
                                                    <div class="answer">
                                                        <p
                                                            class="m-0 p-0 {{ $question[5] == 1 ? 'text-danger' : '' }}">
                                                            <small>A. {{ $question[1] }}</small>
                                                        </p>
                                                        <p
                                                            class="m-0 p-0 {{ $question[5] == 2 ? 'text-danger' : '' }}">
                                                            <small>B. {{ $question[2] }}</small>
                                                        </p>
                                                        <p
                                                            class="m-0 p-0 {{ $question[5] == 3 ? 'text-danger' : '' }}">
                                                            <small>C. {{ $question[3] }}</small>
                                                        </p>
                                                        <p
                                                            class="m-0 p-0 {{ $question[5] == 4 ? 'text-danger' : '' }}">
                                                            <small>D. {{ $question[4] }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>
                                                @if (session()->has('error'))
                                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                                @endif
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    {{ Auth::user()->role_id == 1 ? 'Thêm mới' : 'Gửi phê duyệt' }}
                </button>
                <a href="{{ route('admin.de-thi.index') }}" class="btn btn-danger">Trở lại</a>
            </form>
        </div>




    </div>
</div>
