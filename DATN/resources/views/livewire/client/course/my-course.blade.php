<div>
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="iq-card">
                <div class="iq-edit-list">
                    <ul class="iq-edit-profile d-flex nav nav-pills">
                        <li class="col-md-3 py-3">
                            <div class="text-center">
                                <h6 class="mb-0 border-right">
                                    <a href="#" wire:click.prevent="filterByClass(null)"
                                        class="{{ $selectedClass === null ? 'text-primary font-weight-bold' : '' }}">
                                        Tất cả
                                    </a>
                                </h6>
                            </div>
                        </li>
                        <li class="col-md-3 py-3">
                            <div class="text-center">
                                <h6 class="mb-0 border-right">
                                    <a href="#" wire:click.prevent="filterByClass(1)"
                                        class="{{ $selectedClass === 1 ? 'text-primary font-weight-bold' : '' }}">
                                        Lớp 10
                                    </a>
                                </h6>
                            </div>
                        </li>
                        <li class="col-md-3 py-3">
                            <div class="text-center">
                                <h6 class="mb-0 border-right">
                                    <a href="#" wire:click.prevent="filterByClass(2)"
                                        class="{{ $selectedClass === 2 ? 'text-primary font-weight-bold' : '' }}">
                                        Lớp 11
                                    </a>
                                </h6>
                            </div>
                        </li>
                        <li class="col-md-3 py-3">
                            <div class="text-center">
                                <h6 class="mb-0">
                                    <a href="#" wire:click.prevent="filterByClass(3)"
                                        class="{{ $selectedClass === 3 ? 'text-primary font-weight-bold' : '' }}">
                                        Lớp 12
                                    </a>
                                </h6>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="p-3 border-top">
                    <button class="btn {{ $selectedSubject === null ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(null)">
                        Tất cả
                    </button>
                    <button class="btn {{ $selectedSubject === 1 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(1)">
                        Toán
                    </button>
                    <button class="btn {{ $selectedSubject === 2 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(2)">
                        Vật lý
                    </button>
                    <button class="btn {{ $selectedSubject === 3 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(3)">
                        Hóa học
                    </button>
                    <button class="btn {{ $selectedSubject === 4 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(4)">
                        Sinh học
                    </button>
                    <button class="btn {{ $selectedSubject === 5 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(5)">
                        Ngữ văn
                    </button>
                    <button class="btn {{ $selectedSubject === 6 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(6)">
                        Lịch sử
                    </button>
                    <button class="btn {{ $selectedSubject === 7 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(7)">
                        Địa lý
                    </button>
                    <button class="btn {{ $selectedSubject === 8 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(8)">
                        Tiếng Anh
                    </button>
                    <button class="btn {{ $selectedSubject === 9 ? 'btn-primary' : 'btn-danger' }} mr-2"
                        wire:click="filterBySubject(9)">
                        Tin học
                    </button>
                </div>
            </div>
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
                <div class="row">
                    @foreach ($courses as $enroll)
                        <div class="col-6">
                            <div class="course-item border mb-4 rounded">
                                <a href="{{ route('khoa-hoc.show', ['id' => $enroll->course->id]) }}">
                                    <div class="row hover-enlarge">
                                        <div class="col-md-4">
                                            <img class="img-fluid"
                                                src="{{ $enroll->course->images()->where('image_name', 'thumbnail')->first()->image_url ??
                                                    asset('assets/images/book/course_thumbnail.png') }}">
                                        </div>
                                        <div class="col-md-8 d-flex flex-column justify-content-center">
                                            <h5 class="mb-2">{{ mb_strimwidth($enroll->course->name ?? 'không có tên khóa học', 0, 30, '...') }}</h5>
                                            </h5>
                                            <p class="mb-1"><strong>Giáo viên:</strong>
                                                {{ $enroll->course->user->name ?? 'không có tên giáo viên' }}</p>
                                            <p class="mb-1"><strong>Số video bài giảng:</strong>
                                                {{ $enroll->course->lectures_count ?? 0 }} video</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="col-lg-4">
            <x-client.lecture-history />
        </div>
    </div>
    <style>
        .mb-1 {
            color: var(--iq-body-text);
        }
        .col-md-8 .mb-2:hover {
            color: var(--iq-primary);
            transition: color 0.8s ease;
        }
        .hover-enlarge .col-md-4 img {
            transition: transform 0.3s ease;
        }
        .hover-enlarge:hover .col-md-4 img {
            transform: scale(1.1);
        }
        .img-fluid{
            max-width: 160px;
            max-height: 102px;
        }
    </style>
</div>
