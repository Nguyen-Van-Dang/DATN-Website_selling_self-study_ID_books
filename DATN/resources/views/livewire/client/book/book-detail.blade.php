<div class="row">
    <div class="col-sm-12">
        <div class="iq-card iq-card-ph iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Thông tin</h4>
            </div>
            <div class="iq-card-body pb-0">
                <div class="description-contens align-items-top row">
                    <div wire:loading>
                        <p>Đang tải...</p>
                    </div>
                    <div class="col-md-6" wire:loading.remove>
                        <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body p-0">
                                <div class="row">
                                    <div class="col-3">
                                        <ul id="description-slider-nav"
                                            class="list-inline p-0 m-0  d-flex align-items-center">
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="{{ $thumbnail }}" class="img-thumbnail rounded "
                                                        alt="Thumbnail">
                                                </a>
                                            </li>
                                            @foreach ($gallery1 as $item)
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <img src="{{ $item->image_url }}" class="img-thumbnail rounded"
                                                            alt="Gallery 1">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-9">
                                        <ul id="description-slider"
                                            class="list-inline p-0 m-0  d-flex align-items-center">
                                            <li style="width:100%">
                                                <a href="javascript:void(0);">
                                                    <img style="height:700px" src="{{ $thumbnail }}"
                                                        class="img-thumbnail rounded img-fluid" alt="Thumbnail">
                                                </a>
                                            </li>
                                            @foreach ($gallery1 as $item)
                                                <li style="width:100%"> <a href="javascript:void(0);">
                                                        <img style="height:700px" src="{{ $item->image_url }}"
                                                            class="img-thumbnail rounded img-fluid" alt="Gallery 1">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body p-0">
                                <h3 class="mb-3">{{ $book->name }}</h3>
                                <div class="price d-flex flex-column align-items-start">
                                    @if ($book->discount)
                                        <small style="text-decoration:line-through">
                                            {{ number_format($book->price, 0, ',', '.') }} đ</small>
                                        <div>
                                            <span style="font-weight: bold; font-size:25px">
                                                {{ number_format($book->price - ($book->price * $book->discount) / 100, 0, ',', '.') }}
                                                đ
                                            </span>
                                        </div>
                                    @else
                                        <span style="font-weight: bold">
                                            {{ number_format($book->price) }}đ
                                        </span>
                                    @endif
                                </div>
                                <span
                                    class="text-dark mb-4 pb-4 iq-border-bottom d-block">{{ $book->description }}</span>
                                <div class="text-primary mb-4">Tác giả: <span
                                        class="text-body">{{ $book->user->sex == 0 ? 'Thầy' : 'Cô' }}
                                        {{ $book->user->name }}</span>
                                </div>
                                <div class="iq-social d-flex flex-wrap align-items-center mb-4">
                                    <h5 class="mr-2">Danh mục:</h5>
                                    @foreach ($book->categories as $item)
                                        <span class="badge badge-secondary m-1">{{ $item->name }}</span>
                                    @endforeach
                                </div>
                                <div class="mb-4 d-flex align-items-center">
                                    <a href="javascript:void(0);" onclick="addToCart({{ $book->id }})"
                                        class="btn btn-primary view-more mr-2">Thêm vào giỏ
                                        hàng</a>
                                </div>
                                <div class="mb-3">
                                    <a href="javascript:void(0);" class="text-body text-center"
                                        onclick="toggleFavorite({{ $book->id }})">
                                        <span class="avatar-30 rounded-circle bg-primary d-inline-block mr-2">
                                            <i class="main-heart-icon-{{ $book->id }} ri-heart-fill"
                                                style="{{ $book->favorites()->where('user_id', auth()->id())->exists() ? 'color: red;' : 'color: white;' }}"></i></span><span>Thêm
                                            vào danh sách yêu
                                            thích</span></a>
                                </div>
                                {{-- <div class="iq-social d-flex align-items-center">
                                    <h5 class="mr-2">Chia sẻ:</h5>
                                    <ul class="list-inline d-flex p-0 mb-0 align-items-center">
                                        <li>
                                            <a href="#"
                                                class="avatar-40 rounded-circle bg-primary mr-2 facebook"><i
                                                    class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="avatar-40 rounded-circle bg-primary mr-2 twitter"><i
                                                    class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="avatar-40 rounded-circle bg-primary mr-2 youtube"><i
                                                    class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="avatar-40 rounded-circle bg-primary pinterest"><i
                                                    class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div
                class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 trendy-detail">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Sách Tương Tự</h4>
                </div>
            </div>
            <div class="iq-card-body trendy-contens">
                <ul id="trendy-slider" class="list-inline p-0 mb-0 row">
                    @foreach ($relatedBooks as $item)
                        @php
                            $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                        @endphp
                        <li class="col-md-12">
                            <div class="d-flex align-items-center">
                                <div class="col-5 p-0 position-relative image-overlap-shadow">
                                    <img class="img-fluid rounded w-100"
                                        src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/03.jpg') }}"
                                        alt="">
                                    <div class="view-book">
                                        <a href="{{ route('bookDetail', $item->id) }}" class="btn btn-sm btn-white">Xem
                                            sách</a>
                                    </div>
                                    @if ($item->discount)
                                        <span class="discount-badge">
                                            -{{ $item->discount }}%
                                        </span>
                                    @endif
                                </div>
                                <div class="col-7">
                                    <div class="mb-2">
                                        <h6 class="mb-1">{{ $item->name }}</h6>
                                        <p class="font-size-13 line-height mb-1">{{ $item->user->name }}</p>
                                        <div class="d-block">
                                            <span class="font-size-13 text-warning">
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
                                        <a href="javascript:void(0);" onclick="toggleFavorite({{ $item->id }})">
                                            <i class="related-heart-icon-{{ $item->id }} ri-heart-fill"
                                                style="{{ $item->favorites()->where('user_id', auth()->id())->exists() ? 'color: red;' : 'color: pink;' }}"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div
                class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 similar-detail">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Sách Phổ Biến</h4>
                </div>
            </div>
            <div class="iq-card-body similar-contens">
                <ul id="similar-slider" class="list-inline p-0 mb-0 row">
                    @foreach ($popularBooks as $item)
                        @php
                            $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                        @endphp
                        <li class="col-md-12">
                            <div class="d-flex align-items-center">
                                <div class="col-5 p-0 position-relative image-overlap-shadow">
                                    <img class="img-fluid rounded w-100"
                                        src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/02.jpg') }}">
                                    <div class="view-book">
                                        <a href="{{ route('bookDetail', $item->id) }}"
                                            class="btn btn-sm btn-white">Xem
                                            Sách</a>
                                    </div>
                                    @if ($item->discount)
                                        <span class="discount-badge">
                                            -{{ $item->discount }}%
                                        </span>
                                    @endif
                                </div>
                                <div class="col-7">
                                    <div class="mb-2">
                                        <h6 class="mb-1">{{ $item->name }}</h6>
                                        <p class="font-size-13 line-height mb-1">{{ $item->user->name }}</p>
                                        <div class="d-block">
                                            <span class="font-size-13 text-warning">
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
                                        <a href="javascript:void(0);" onclick="toggleFavorite({{ $item->id }})">
                                            <i class="related-heart-icon-{{ $item->id }} ri-heart-fill"
                                                style="{{ $item->favorites()->where('user_id', auth()->id())->exists() ? 'color: red;' : 'color: pink;' }}"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Sách Được Yêu Thích</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{ route('bookList') }}" class="btn btn-sm btn-primary view-more">Xem Thêm</a>
                </div>
            </div>
            <div class="iq-card-body favorites-contens">
                <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                    @foreach ($favBooks as $item)
                        @php
                            $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                        @endphp
                        <li class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-5 p-0 position-relative">
                                    <img class="img-fluid rounded w-100"
                                        src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/05.jpg') }}">
                                </div>
                                <div class="col-7">
                                    <h5 class="mb-2">{{ $item->name }}</h5>
                                    <p class="mb-2">Tác Giả : {{ $item->user->name }}</p>
                                    <div
                                        class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                        <span>Lượt Thích</span>
                                        <span class="mr-4"
                                            id="favorite-count-{{ $item->id }}">{{ $item->favorites()->count() }}</span>
                                    </div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                        <div class="iq-progress-bar iq-bg-primary">
                                            <span class="bg-primary" data-percent="100"></span>
                                        </div>
                                    </div>
                                    <a href="{{ route('bookDetail', $item->id) }}" class="text-dark">Đọc Ngay<i
                                            class="ri-arrow-right-s-line"></i></a>
                                </div>
                            </div>
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
    </style>
</div>
