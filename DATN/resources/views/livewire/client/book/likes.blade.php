<div class="row">
    <div class="col-lg-12">
        <div class="iq-card-transparent mb-1">
            <div class="d-block text-center">
                <h2 class="mb-3">Sách Đã Yêu Thích</h2>
            </div>
        </div>
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="row mt-4">
                    @foreach ($likedBooks as $item)
                        <div class="col-lg-3 mb-4">
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
                            {{ $likedBooks->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .text-muted {
                    display: none;
                }

                .iq-card-body {
                    padding-bottom: 0 !important;
                }
            </style>

        </div>
    </div>
</div>
