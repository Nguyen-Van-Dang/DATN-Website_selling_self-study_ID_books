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
                                            <input type="text" class="text search-input"
                                                placeholder="Tìm kiếm ở đây..."
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
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div
                                        class="iq-card iq-card-block iq-card-stretch iq-card-height search-bookcontent">
                                        <div class="iq-card-body p-0">
                                            <div class="d-flex align-items-center">
                                                <div class="col-6 p-0 position-relative image-overlap-shadow">
                                                    <a href="javascript:void();"><img class="img-fluid rounded w-100"
                                                            src="{{ asset('assets/images/book/book/01.jpg') }}"
                                                            alt=""></a>
                                                    <div class="view-book">
                                                        <a href="{{ route('bookDetail') }}"
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
                                                        <h6><b>${{ $item->price }}</b></h6>
                                                    </div>
                                                    <div class="iq-product-action">
                                                        <a href="javascript:void(0);"
                                                            onclick="addToCart({{ $item->id }})" class="ml-2">
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

            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div
                        class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 similar-detail">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Similar Books</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="category.html" class="btn btn-sm btn-primary view-more">View More</a>
                        </div>
                    </div>
                    <div class="iq-card-body similar-contens">
                        <ul id="similar-slider" class="list-inline p-0 mb-0 row">
                            @foreach ($Book->slice(0, 5) as $item)
                                <li class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="col-5 p-0 position-relative image-overlap-shadow">
                                            <a href="javascript:void();"><img class="img-fluid rounded w-100"
                                                    src="{{ asset('assets/images/book/book/03.jpg') }}"
                                                    alt=""></a>
                                            <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Xem Sách</a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="mb-2">
                                                <h6 class="mb-1">{{ $item->name }}</h6>
                                                @php
                                                    $user = $item->user;
                                                @endphp
                                                <p class="font-size-13 line-height mb-1">{{ $user->name }}</p>
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
                                                <h6><b>${{ $item->price }}</b></h6>
                                            </div>
                                            <div class="iq-product-action">
                                                <a href="javascript:void(0);"
                                                    onclick="addToCart({{ $item->id }})" class="ml-2">
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
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div
                        class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 trendy-detail">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Trendy Books</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="category.html" class="btn btn-sm btn-primary view-more">View More</a>
                        </div>
                    </div>
                    <div class="iq-card-body trendy-contens">
                        <ul id="trendy-slider" class="list-inline p-0 mb-0 row">
                            @foreach ($Book as $item)
                                <li class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="col-5 p-0 position-relative image-overlap-shadow">
                                            <a href="javascript:void();"><img class="img-fluid rounded w-100"
                                                    src="{{ asset('assets/images/book/book/02.jpg') }}"
                                                    alt=""></a>
                                            <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Xem Sách</a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="mb-2">
                                                <h6 class="mb-1">{{ $item['name'] }}</h6>
                                                <div class="price d-flex align-items-center">
                                                    <h6><b>${{ $item['price'] }}</b></h6>
                                                </div>
                                                <div class="iq-product-action">
                                                    <a href="javascript:void(0);"
                                                        onclick="addToCart({{ $item->id }})" class="ml-2">
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
                            <h4 class="card-title mb-0">Favorite Reads</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="{{ route('bookList') }}" class="btn btn-sm btn-primary view-more">Xem Thêm</a>
                        </div>
                    </div>
                    <div class="iq-card-body favorites-contens">
                        <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                            @foreach ($Book->shuffle()->slice(0, 5) as $item)
                                <li class="col-md-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="col-5 p-0 position-relative">
                                            <a href="javascript:void();">
                                                <img src="{{ asset('assets/images/book/book/05.jpg') }}"
                                                    class="img-fluid rounded w-100" alt="">
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <h5 class="mb-2">{{ $item->name }}</h5>
                                            @php
                                                $user = $item->user;
                                            @endphp
                                            <p class="mb-2">Author : {{ $user->name }}</p>
                                            <div
                                                class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                                <span>Đã Đọc</span>
                                                <span class="mr-4">78%</span>
                                            </div>
                                            <div class="iq-progress-bar-linear d-inline-block w-100">
                                                <div class="iq-progress-bar iq-bg-primary">
                                                    <span class="bg-primary" data-percent="78"></span>
                                                </div>
                                            </div>
                                            <a href="#" class="text-dark">Đọc Ngay<i
                                                    class="ri-arrow-right-s-line"></i></a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function toggleFavorite(bookId) {
                fetch(`/books/${bookId}/toggle-favorite`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const heartIcons = document.querySelectorAll(`.heart-icon-${bookId}`);
                        heartIcons.forEach(icon => {
                            icon.style.color = data.is_favorite ? 'red' : 'pink';
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }

            function addToCart(bookId) {
                fetch(`/cart/add/${bookId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => data.success && Livewire.dispatch('cartUpdated'))
            }
        </script>
