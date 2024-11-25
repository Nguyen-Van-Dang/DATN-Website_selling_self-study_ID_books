<div class="row">
    <div class="col-lg-12">
        <div class="iq-card-transparent mb-0">
            <div class="d-block text-center">
                <h2 class="mb-3">Tìm kiếm tên sách</h2>
                <div class="w-100 iq-search-filter">
                    <ul class="list-inline p-0 m-0 row justify-content-center search-menu-options">
                        <li class="search-menu-opt">
                            <div class="iq-dropdown">
                                <div class="form-group mb-0">
                                    <select class="form-control form-search-control bg-white border-0"
                                        id="exampleFormControlSelect1">
                                        <option selected="">Tất cả</option>
                                        <option>A Books</option>
                                        <option>the Sun</option>
                                        <option>Harsh book</option>
                                        <option>People book</option>
                                        <option>the Fog</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="search-menu-opt">
                            <div class="iq-dropdown">
                                <div class="form-group mb-0">
                                    <select class="form-control form-search-control bg-white border-0"
                                        id="exampleFormControlSelect2">
                                        <option selected="">Thể loại</option>
                                        <option>General</option>
                                        <option>History</option>
                                        <option>Horror</option>
                                        <option>Fantasy</option>
                                        <option>Literary</option>
                                        <option>Manga</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="search-menu-opt">
                            <div class="iq-dropdown">
                                <div class="form-group mb-0">
                                    <select class="form-control form-search-control bg-white border-0"
                                        id="exampleFormControlSelect3">
                                        <option selected="">Năm</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="search-menu-opt">
                            <div class="iq-dropdown">
                                <div class="form-group mb-0">
                                    <select class="form-control form-search-control bg-white border-0"
                                        id="exampleFormControlSelect4">
                                        <option selected="">Tác giả</option>
                                        <option>Milesiy Yor</option>
                                        <option>Ira Membrit</option>
                                        <option>Anna Mull</option>
                                        <option>John Smith</option>
                                        <option>David King</option>
                                        <option>Kusti Franti</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="search-menu-opt">
                            <div class="iq-search-bar search-book d-flex align-items-center">
                                <form action="#" class="searchbox"
                                    style="box-shadow: 0px 4px 20px 0px rgba(44, 101, 144, 0.1);">
                                    <input type="text" class="text search-input" placeholder="Tìm kiếm ở đây..."
                                        style="width: 300px; margin-left: -70px;">
                                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                </form>
                                <button type="submit" class="btn btn-primary search-data ml-2">Tìm
                                    kiếm</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="row">
                    @foreach ($Book as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height search-bookcontent">
                                <div class="d-flex align-items-center">
                                    <div class="col-6 p-0 position-relative image-overlap-shadow">
                                        <a href="javascript:void(0);">
                                            @php
                                                $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                                            @endphp
                                            <img class="img-fluid rounded w-100"
                                                src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/01.jpg') }}">
                                        </a>
                                        <div class="view-book">
                                            <a wire:click="goToBookDetail({{ $item->id }})"
                                                class="btn btn-sm btn-white">Xem
                                                Sách</a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <h6 class="mb-1">{{ $item->name }}</h6>
                                            @php
                                                $user = $item->user;
                                            @endphp
                                            <p class="font-size-13 line-height mb-1">{{ $user->name }}</p>
                                        </div>
                                        <div class="price d-flex align-items-center">
                                            <h6><b>{{ number_format($item->price) }}đ</b></h6>
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
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <div class="d-flex justify-content-center my-4" style="z-index: 1">
                            {{ $Book->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .text-muted {
                    display: none;
                }
            </style>

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
                    @foreach ($popularBooks as $item)
                        <li class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="col-5 p-0 position-relative image-overlap-shadow">
                                    <a href="javascript:void();">
                                        <img class="img-fluid rounded w-100"
                                            src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/02.jpg') }}">
                                        <div class="view-book">
                                            <a style="cursor: pointer;"
                                                wire:click="goToBookDetail({{ $item->id }})"
                                                class="btn btn-sm btn-white">Xem Sách</a>
                                        </div>
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
                                    <div class="price d-flex align-items-center">
                                        <h6><b>{{ number_format($item->price) }}đ</b></h6>
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
                    @foreach ($favBook as $item)
                        <li class="col-md-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-5 p-0 position-relative">
                                    <a href="javascript:void();">
                                        <img class="img-fluid rounded w-100"
                                            src="{{ $thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/05.jpg') }}">
                                    </a>
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
</div>
