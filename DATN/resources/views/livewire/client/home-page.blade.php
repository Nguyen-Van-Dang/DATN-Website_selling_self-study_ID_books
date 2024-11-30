<div class="row">
    <div class="col-lg-12">
        <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height rounded">
            <div class="newrealease-contens">
                <ul id="newrealease-slider" class="list-inline p-0 m-0 d-flex align-items-center">
                    @if (count($saleBook) > 0)
                        @for ($i = 0; $i < 10; $i++)
                            @php
                                $index = $i % count($saleBook);
                                $item = $saleBook[$index];
                            @endphp

                            <li class="item">
                                <div class="image-overlap-shadow">
                                    <img src="{{ $item->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/book_placeholder.png') }}"
                                        class="img-fluid w-100 rounded" alt="{{ $item->title ?? 'Book' }}">

                                    <div class="view-book">
                                        <a href="{{ route('bookDetail', $item->id) }}" class="btn btn-sm btn-white">Xem
                                            Sách</a>
                                    </div>
                                    @if ($item->discount)
                                        <span class="discount-badge">
                                            -{{ $item->discount }}%
                                        </span>
                                    @endif
                                </div>
                            </li>
                        @endfor
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Sách Mới Nhất</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{ route('bookList') }}" class="btn btn-sm btn-primary view-more">Xem Thêm</a>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="row">
                    @foreach ($Book as $item)
                        @php
                            $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                        @endphp
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                <div class="iq-card-body p-0">
                                    <div class="d-flex align-items-center">
                                        <div class="col-6 p-0 position-relative image-overlap-shadow">
                                            <img class="img-fluid rounded w-100"
                                                src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/01.jpg') }}"
                                                alt="">
                                            <div class="view-book">
                                                <a href="{{ route('bookDetail', $item->id) }}"
                                                    class="btn btn-sm btn-white">Mua Ngay</a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <h6 class="mb-1">{{ $item->name }}</h6>
                                                <p class="font-size-13 line-height mb-1">{{ $item->user->name }}
                                                </p>
                                                <div class="d-block line-height">
                                                    <span class="font-size-11 text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price d-flex flex-column align-items-start">
                                                @if ($item->discount)
                                                    <small style="text-decoration:line-through">
                                                        {{ number_format($item->price, 0, ',', '.') }} đ</small>
                                                    <div>
                                                        <span style="font-weight: bold">
                                                            {{ number_format($item->price - ($item->price * $item->discount) / 100, 0, ',', '.') }}
                                                            đ
                                                        </span>
                                                    </div>
                                                @else
                                                    <span style="font-weight: bold">
                                                        {{ number_format($item->price) }}đ
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="iq-product-action">
                                                <a href="javascript:void(0);" onclick="addToCart({{ $item->id }})"
                                                    class="ml-2">
                                                    <i class="ri-shopping-cart-2-fill text-primary"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    onclick="toggleFavorite({{ $item->id }})">
                                                    <i class="heart-icon-{{ $item->id }} ri-heart-fill"
                                                        style="{{ $item->favorites()->where('user_id', auth()->id())->exists() ? 'color: red;' : 'color: pink;' }}"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between mb-0">
                <div class="iq-header-title">
                    <h4 class="card-title">Sách có lượt bán nhiều nhất</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <div class="dropdown">
                        <span class="dropdown-toggle p-0 text-body" id="dropdownMenuButton2" data-toggle="dropdown">
                            {{ $filter_time }} <i class="ri-arrow-down-s-fill"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                            aria-labelledby="dropdownMenuButton2">
                            <a class="dropdown-item" href="#" wire:click.prevent="setFilterTime('Ngày')">Ngày</a>
                            <a class="dropdown-item" href="#" wire:click.prevent="setFilterTime('Tuần')">Tuần</a>
                            <a class="dropdown-item" href="#"
                                wire:click.prevent="setFilterTime('Tháng')">Tháng</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-card-body">
                @if ($topBuyBook)
                    @php
                        $thumbnail = $topBuyBook->images()->where('image_name', 'thumbnail')->first();
                    @endphp
                    <div class="row align-items-center">
                        <div class="col-sm-5 pr-0">
                            <img class="img-fluid rounded w-100"
                                src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/01.jpg') }}"alt="">
                            <span class="topbuy-badge">
                                {{ $topBuyBook->total_quantity }} lượt bán
                            </span>
                        </div>
                        <div class="col-sm-7 mt-3 mt-sm-0">
                            <h4 class="mb-2">{{ $topBuyBook->name }}</h4>
                            <p class="mb-2">Tác Giả {{ $topBuyBook->user->name }}</p>
                            <div class="mb-2 d-block">
                                <span class="font-size-12 text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                            </div>
                            <span class="text-dark mb-3 d-block">{{ $topBuyBook->description }}</span>
                            <a href="{{ route('bookDetail', $topBuyBook->id) }}"
                                class="btn btn-primary learn-more">Chi
                                Tiết</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6" wire:ignore>
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between mb-0">
                <div class="iq-header-title">
                    <h4 class="card-title">Giáo Viên</h4>
                </div>
                {{-- <div class="iq-card-header-toolbar d-flex align-items-center">
                    <div class="dropdown">
                        <span class="dropdown-toggle p-0 text-body" id="dropdownMenuButton3" data-toggle="dropdown">
                            Ngày<i class="ri-arrow-down-s-fill"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                            aria-labelledby="dropdownMenuButton3">
                            <a class="dropdown-item" href="#">Tuần</a>
                            <a class="dropdown-item" href="#">Theo Tháng</a>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="iq-card-body">
                <ul class="list-inline row mb-0 iq-scrollable-block">
                    @foreach ($teachers as $teacher)
                        @php
                            $avatar = $teacher->images()->where('image_name', 'avatar')->first();
                        @endphp
                        <li class="col-sm-6 d-flex mb-3">
                            <div class="icon iq-icon-box mr-3">
                                <a href="javascript:void();">
                                    <img class="img-fluid avatar-60 rounded-circle"
                                        src="{{ $avatar ? $avatar->image_url : asset('assets/images/book/user/3.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                            <div class="mt-1">
                                <a href="">
                                    <h6>{{ $teacher->name }}</h6>
                                </a>
                                <p class="mb-0 text-primary">Số lượng sách:
                                    <span class="text-body">{{ $teacher->total_books }}</span>
                                </p>
                                <p class="mb-0 text-primary">Số lượng khóa học:
                                    <span class="text-body">{{ $teacher->total_courses }}</span>
                                </p>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-12" wire:ignore>
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Sách yêu thích</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{ route('bookList') }}" class="btn btn-sm btn-primary view-more">Xem thêm</a>
                </div>
            </div>
            <div class="iq-card-body favorites-contens">
                <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                    @foreach ($favBook as $item)
                        @php
                            $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                        @endphp
                        <li class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="col-5 p-0 position-relative">
                                    <a href="javascript:void();">
                                        <img class="img-fluid rounded w-100"
                                            src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/01.jpg') }}">
                                    </a>
                                </div>
                                <div class="col-7">
                                    <h5 class="mb-2">{{ $item->name }}</h5>
                                    <p class="mb-2">Tác giả : {{ $item->user->name }}</p>
                                    <div
                                        class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                        <span>Lượt Thích</span>
                                        <span class="mr-4"
                                            id="favorite-count-{{ $item->id }}">{{ $item->favorites()->count() }}</span>
                                    </div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                        <div class="iq-progress-bar iq-bg-primary">
                                            <span class="bg-primary" data-percent="65"></span>
                                        </div>
                                    </div>
                                    <a href="{{ route('bookDetail', $item->id) }}" class="text-dark">Xem Ngay<i
                                            class="ri-arrow-right-s-line"></i></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{-- course --}}
    <div class="col-lg-12">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Khóa Học Hấp Dẫn</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{ route('khoa-hoc.index') }}" class="btn btn-sm btn-primary view-more">Xem thêm</a>
                </div>
            </div>
            <div class="iq-card-body favorites-contens">
                <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                    @foreach ($popularCourses as $item)
                        @php
                            $courseImage = $item->images()->where('image_name', 'course')->first();
                        @endphp
                        <li class="col-md-2">
                            <a href="{{ route('khoa-hoc.show', $item->id) }}">
                                <div class="trendy-course card h-100 pt-3" style=" transition: transform 0.3s ease;">
                                    <img src="{{ $courseImage ? $courseImage->image_url : asset('assets/images/book/course_thumbnail.png') }}"
                                        class="card-img-top img-fluid rounded course-image img-thumbnail"
                                        alt="Product 3">
                                    <div class="card-body border pt-1">
                                        <div>
                                            <h5 class="card-title course-title">{{ $item->name }}</h5>
                                            <h7 class="card-title course-teacher" style="font-size: 13px">
                                                {{-- {{ $item->user->name }}</h7> --}}
                                        </div>
                                        <div class="d-flex justify-content-evenly mt-3 flex-nowrap"
                                            style="font-size: 13px">
                                            <span class="text-danger font-weight-bold">{{ $item->price }}đ</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <style>
        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: bounce 2s infinite;
            transition: box-shadow 0.3s ease;
        }

        .topbuy-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #00e21e;
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: bounce 2s infinite;
            transition: box-shadow 0.3s ease;
        }
    </style>
</div>
