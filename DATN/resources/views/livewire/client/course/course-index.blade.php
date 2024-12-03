<div>
    {{-- @livewire('client.course.carousel-image-upload') --}}
    
    <div class="d-flex justify-content-between align-items-center position-relative mt-3">
        <div class="w-100 iq-search-filter mb-0">
            <ul class="list-inline p-0 m-0 row justify-content-center search-menu-options">
                <li class="search-menu-opt">
                    <div class="iq-dropdown">
                        <div class="form-group mb-0">
                            <select class="form-control form-search-control bg-white border-0"
                                wire:model.live="date_filter">
                                <option value="latest">Mới nhất</option>
                                <option value="oldest">Cũ nhất</option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="search-menu-opt">
                    <div class="iq-dropdown">
                        <div class="form-group mb-0">
                            <select class="form-control form-search-control bg-white border-0"
                                wire:model.live="price_filter">
                                <option value="">Giá</option>
                                <option value="desc">Cao đến thấp</option>
                                <option value="asc">Thấp đến cao</option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="search-menu-opt">
                    <div class="iq-dropdown">
                        <div class="form-group mb-0">
                            <select class="form-control form-search-control bg-white border-0"
                                wire:model.live="teacher_filter">
                                <option value="">Giảng viên</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </li>
                <li class="search-menu-opt">
                    <div class="iq-search-bar search-book">
                        <input type="text" class="text search-input" wire:model.live.debounce.100ms="name_filter"
                            placeholder="Tên khóa học...">

                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="iq-card iq-card-block iq-card-stretch iq-card-height mt-4">
        <div class="iq-card-body pt-0">
            <div class="row">
                @foreach ($courseList as $course)
                    @php
                        $courseImage = $course->images()->where('image_name', 'thumbnail')->first();
                    @endphp
                    <div class="col-6 col-lg-3">
                        <div class="card card-filter h-50">
                            <div class="card-body">
                                <div class="" wire:click="goToCourseDetail({{ $course->id }})"
                                    style="cursor: pointer;">
                                    <h5 class="card-title course-top-title">{{ $course->name }}
                                    </h5>
                                    @if ($course->discount && $course->price > $course->discount)
                                        @php
                                            $price = $course->price;
                                            $discount = $course->discount;
                                            if ($price > 0 && $discount > 0 && $discount < $price) {
                                                $discountPercentage = round(($discount / $price) * 100);
                                            } else {
                                                $discountPercentage = 0;
                                            }
                                        @endphp
                                        @if ($discountPercentage > 0)
                                            <span class="discount-badge">
                                                -{{ $discountPercentage }}%
                                            </span>
                                        @endif
                                    @endif
                                    <img class="card-img-top img-fluid rounded course-image"
                                        style="width: 770px; ;height: 200px;"
                                        src="{{ $courseImage ? $courseImage->image_url : asset('assets/images/book/book/01.jpg') }}">
                                </div>
                                <div class="d-flex justify-content-evenly mt-3 flex-nowrap">
                                    <span class="text-danger font-weight-bold">{{ number_format($course->price) }}
                                        đ</span>
                                    <span class="text-muted ml-3"
                                        style="text-decoration:line-through">{{ number_format($course->discount) }}
                                        đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4 col">
            <img style="width:100%;height:200px"
                src="https://mshoagiaotiep.com/uploads/images/crop/500x263/Ti%E1%BA%BFng%20Anh%20chuy%C3%AAn%20ng%C3%A0nh/videotrainghiempphoc.jpg"
                class="img-container rounded" alt="Image 1">
        </div>
        <div class="col-4 col">
            <img style="width:100%;height:200px"
                src="https://mshoagiaotiep.com/uploads/images/crop/500x263/VIDEO/phat_am.png"
                class="img-container rounded" alt="Image 2">
        </div>
        <div class="col-4 col">
            <img style="width:100%;height:200px"
                src="https://topbaiviet.com/wp-content/uploads/2021/04/khoa-hoc-online-1-730x373.png"
                class="img-container rounded" alt="Image 3">
        </div>
    </div>

    <div class="iq-card iq-card-block iq-card-stretch iq-card-height mt-4" wire:ignore>
        <div class="iq-card-body trendy-contens">
            <ul id="trendy-slider" class="row">
                @foreach ($teachers as $teacher)
                    @php
                        $teachetImage = $teacher->images()->where('image_name', 'thumbnail')->first();
                    @endphp
                    <li>
                        <div class="d-flex flex-column align-items-center teacher-card">
                            <div class="avatar-container">=
                                <img class="carousel-img"
                                    src="{{ $teachetImage ? $teachetImage->image_url : asset('assets/images/book/user/avatar.jpg') }}">
                            </div>
                            <div class="text-center mt-1 p-0">
                                <p class="m-0">Thầy</p>
                                <h6 class="teacher-name">{{ $teacher->name }}</h6>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
        <div class="iq-card-body similar-contens">
            <h5 class="card-title mb-2">Khóa Học Thịnh Hành</h5>
            <div class="row">
                @foreach ($popularCourses as $course)
                    <div class="col-2 col-lg-2 px-2 mb-3" wire:click="goToCourseDetail({{ $course->id }})"
                        style="cursor: pointer;">
                        <div class="trendy-course card h-100 " style=" transition: transform 0.3s ease;">
                            @php
                                $courseImage = $course->images()->where('image_name', 'thumbnail')->first();
                            @endphp
                            <img class="card-img-top img-fluid rounded course-image"
                                style="aspect-ratio: 1.5/1; object-fit: cover;"
                                src="{{ $courseImage ? $courseImage->image_url : asset('assets/images/book/book/01.jpg') }}">
                            <div class="card-body border pt-1">
                                <div>
                                    <h5 class="card-title course-title">{{ $course->name }}</h5>
                                    <h7 class="card-title course-teacher">Thầy {{ $course->user->name }}</h7>
                                    <div class="d-flex justify-content-evenly mt-3 flex-nowrap">
                                        <span class="text-danger font-weight-bold">{{ number_format($course->price) }}
                                            đ</span>
                                        <span class="text-muted ml-3"
                                            style="text-decoration:line-through">{{ number_format($course->discount) }}
                                            đ</span>
                                    </div>
                                </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <style>
        .course-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            line-height: 1.5em;
            height: 3em;
        }

        .course-top-title {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            line-height: 1.5em;
            height: 1.5em;
        }

        .card:hover .course-title {
            color: blue;
        }

        .trendy-course:hover {
            transform: scale(1.02);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .card-filter:hover .course-image {
            transform: scale(1.02);
        }

        .avatar-container {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .teacher-card:hover .avatar-container {
            transform: scale(1.05);
        }

        .carousel-img {
            width: 100%;
            height: auto;
        }

        .discount-badge {
            position: absolute;
            top: 70px;
            right: 40px;
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: bounce 2s infinite;
            transition: box-shadow 0.3s ease;
            z-index: 10;
        }
    </style>
</div>
