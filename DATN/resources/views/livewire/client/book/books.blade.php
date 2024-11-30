<div class="row">
    <div class="col-lg-12">
        <div class="iq-card-transparent mb-0">
            <div class="d-block text-center">
                <div class="w-100 iq-search-filter">
                    <ul class="list-inline p-0 m-0 row justify-content-center search-menu-options">
                        <li class="search-menu-opt">
                            <div class="iq-dropdown">
                                <div class="form-group mb-0">
                                    <select class="form-control form-search-control bg-white border-0"
                                        wire:model.live="category_filter" id="filterCategory">
                                        <option value="" selected>Thể loại</option>
                                        @foreach ($categories as $danhmuc)
                                            <option value="{{ $danhmuc->id }}">{{ $danhmuc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>

                        <li class="search-menu-opt">
                            <div class="iq-dropdown">
                                <div class="form-group mb-0">
                                    <select class="form-control form-search-control bg-white border-0"
                                        wire:model.live="time_filter" id="filterTime">
                                        <option value="Mới nhất" selected>Mới nhất</option>
                                        <option value="Cũ nhất">Cũ nhất</option>
                                    </select>
                                </div>
                            </div>
                        </li>

                        <li class="search-menu-opt">
                            <div class="iq-dropdown">
                                <div class="form-group mb-0">
                                    <select class="form-control form-search-control bg-white border-0"
                                        wire:model.live="price_filter" id="filterPrice">
                                        <option value="" selected>Giá bán</option>
                                        <option value="Dưới 100,000đ">Dưới 100,000đ</option>
                                        <option value="100,000đ - 300,000đ">100,000đ - 300,000đ</option>
                                        <option value="300,000đ - 500,000đ">300,000đ - 500,000đ</option>
                                        <option value="500,000đ - 700,000đ">500,000đ - 700,000đ</option>
                                        <option value="700,000đ trở lên">700,000đ trở lên</option>
                                    </select>
                                </div>
                            </div>
                        </li>

                        <li class="search-menu-opt">
                            <div class="iq-dropdown">
                                <div class="form-group mb-0">
                                    <select class="form-control form-search-control bg-white border-0"
                                        wire:model.live="author_filter" id="filterAuthor">
                                        <option value="" selected>Tác giả</option>
                                        @foreach ($teachers as $tacgia)
                                            <option value="{{ $tacgia->id }}">{{ $tacgia->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>

                        <li class="search-menu-opt">
                            <div class="iq-search-bar search-book d-flex align-items-center">
                                <form action="#" class="searchbox"
                                    style="box-shadow: 0px 4px 20px 0px rgba(44, 101, 144, 0.1);">
                                    <input type="text" wire:model.live="search_filter" class="text search-input"
                                        placeholder="Tìm kiếm tên sách..." style="width: 300px; margin-left: -70px;">
                                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                </form>
                                <button type="submit" class="btn btn-primary search-data ml-2">Tìm kiếm</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="row">
                    @foreach ($books as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height search-bookcontent">
                                <div class="d-flex align-items-center">
                                    <div class="col-6 p-0 position-relative image-overlap-shadow">
                                        <a href="javascript:void(0);">
                                            @php
                                                $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                                            @endphp
                                            <img class="img-fluid rounded w-100"
                                                src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book_placeholder.png') }}">
                                        </a>
                                        <div class="view-book">
                                            <a wire:click="goToBookDetail({{ $item->id }})"
                                                class="btn btn-sm btn-white">Xem
                                                Sách</a>
                                        </div>
                                        @if ($item->discount)
                                            <span class="discount-badge">
                                                -{{ $item->discount }}%
                                            </span>
                                        @endif

                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <h6 class="mb-1">{{ $item->name }}</h6>
                                            @php
                                                $user = $item->user;
                                            @endphp
                                            <p class="font-size-13 line-height mb-1">{{ $user->name }}</p>
                                        </div>
                                        <div class="price d-flex flex-column align-items-start">
                                            @if ($item->discount)
                                                <small style="text-decoration:line-through">
                                                    {{ number_format($item->price, 0, ',', '.') }} đ</small>
                                                <div>
                                                    <span style="font-weight: bold;">
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
                    @endforeach
                    @if (count($books) < $allBooksCount)
                        <div class="col-12">
                            <div class="d-flex justify-content-center my-4" style="z-index: 1">
                                <a href="#" wire:click.prevent="loadMore" id="show-more-btn"
                                    class="iq-waves-class=px-2">
                                    <small>
                                        <i class="bi bi-arrow-down-circle"></i>
                                        <span>Xem thêm</span>
                                    </small>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (count($books) <= 0)
                        <div class="col-12">
                            <div class="d-flex justify-content-center my-4" style="z-index: 1">
                                <p>Không có kết quả</p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12" wire:ignore>
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div
                class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 similar-detail">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Sách Phổ Biến</h4>
                </div>
            </div>
            <div class="iq-card-body similar-contens">
                <ul id="similar-slider" class="list-inline p-0 mb-0 row">
                    @foreach ($popular_books as $item)
                        @php
                            $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                        @endphp
                        <li class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="col-5 p-0 position-relative image-overlap-shadow">
                                    <a href="javascript:void();">
                                        <img class="img-fluid rounded w-100"
                                            src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book_placeholder.png') }}">
                                        <div class="view-book">
                                            <a style="cursor: pointer;"
                                                wire:click="goToBookDetail({{ $item->id }})"
                                                class="btn btn-sm btn-white">Xem Sách</a>
                                        </div>
                                    </a>
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
                                            <i class="heart-icon-{{ $item->id }} ri-heart-fill"
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
    <div class="col-lg-12" wire:ignore>
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Sách Được Yêu Thích Nhất</h4>
                </div>
            </div>
            <div class="iq-card-body favorites-contens">
                <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                    @foreach ($fav_books as $item)
                        @php
                            $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                        @endphp
                        <li class="col-md-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-5 p-0 position-relative">
                                    <a href="javascript:void();">
                                        <img class="img-fluid rounded w-100"
                                            src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book_placeholder.png') }}">
                                    </a>
                                    @if ($item->discount)
                                        <span class="discount-badge">
                                            -{{ $item->discount }}%
                                        </span>
                                    @endif
                                </div>
                                <div class="col-7">
                                    <h5 class="mb-2">{{ $item->name }}</h5>
                                    <p class="mb-2">Author : {{ $item->user->name }}</p>
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
                                    <a wire:click="goToBookDetail({{ $item->id }})" style="cursor: pointer"
                                        class="text-dark">Xem Ngay<i class="ri-arrow-right-s-line"></i></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-12" wire:ignore>
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div
                class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 similar-detail">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Sách khuyến mãi</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="row">
                    @foreach ($sale_books as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height search-bookcontent">
                                <div class="d-flex align-items-center">
                                    <div class="col-6 p-0 position-relative image-overlap-shadow">
                                        <a href="javascript:void(0);">
                                            @php
                                                $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                                            @endphp
                                            <img class="img-fluid rounded w-100"
                                                src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book_placeholder.png') }}">
                                        </a>
                                        <div class="view-book">
                                            <a wire:click="goToBookDetail({{ $item->id }})"
                                                class="btn btn-sm btn-white">Xem
                                                Sách</a>
                                        </div>
                                        @if ($item->discount)
                                            <span class="discount-badge">
                                                -{{ $item->discount }}%
                                            </span>
                                        @endif

                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <h6 class="mb-1">{{ $item->name }}</h6>
                                            @php
                                                $user = $item->user;
                                            @endphp
                                            <p class="font-size-13 line-height mb-1">{{ $user->name }}</p>
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
                    @endforeach
                    {{-- @if (count($books) < $allBooksCount)
                        <div class="col-12">
                            <div class="d-flex justify-content-center my-4" style="z-index: 1">
                                <a href="#" wire:click.prevent="loadMore" id="show-more-btn"
                                    class="iq-waves-class=px-2">
                                    <small>
                                        <i class="bi bi-arrow-down-circle"></i>
                                        <span>Xem thêm</span>
                                    </small>
                                </a>
                            </div>
                        </div>
                    @endif --}}
                </div>

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
