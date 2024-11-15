<div class="container-fluid">

    @if ($cart->isEmpty())
        <div class="row">
            <div id="cart" class="card-block show p-0 col-12">
                <div class="row align-item-center">
                    <div class="col-lg-8">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex iq-border-bottom mb-0">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Giỏ hàng của bạn hiện
                                        đang trống. Vui lòng thêm
                                        sản phẩm vào
                                        giỏ hàng</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <p>Tùy chọn</p>
                                <hr>
                                <p><b>Chi tiết</b></p>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Tổng</span>
                                    <span>0 đ</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Giảm giá</span>
                                    <span class="text-success">0 đ</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Thuế VAT</span>
                                    <span>0 đ<span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="text-dark"><strong>Tổng</strong></span>
                                    <span class="text-dark"><strong>0
                                            đ</strong></span>
                                </div>
                                <a id="place-order" href="javascript:void();" class="btn btn-primary d-block mt-3 next"
                                    disabled>Đặt hàng</a>
                            </div>
                        </div>
                        <div class="iq-card ">
                            <div class="card-body iq-card-body p-0 iq-checkout-policy">
                                <ul class="p-0 m-0">
                                    <li class="d-flex align-items-center">
                                        <div class="iq-checkout-icon">
                                            <i class="ri-checkbox-line"></i>
                                        </div>
                                        <h6>Chính sách bảo mật (Thanh toán an toàn và bảo mật.)</h6>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="iq-checkout-icon">
                                            <i class="ri-truck-line"></i>
                                        </div>
                                        <h6>Chính sách giao hàng (Giao hàng tận nhà.)</h6>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="iq-checkout-icon">
                                            <i class="ri-arrow-go-back-line"></i>
                                        </div>
                                        <h6>Chính sách hoàn trả</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div id="cart" class="card-block show p-0 col-12">
                <div class="row align-item-center">
                    <div class="col-lg-8">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between iq-border-bottom mb-0">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Giỏ hàng</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <ul class="list-inline p-0 m-0">
                                    @foreach ($cart as $item)
                                        <li class="checkout-product">
                                            <div class="row align-items-center">
                                                <div class="col-sm-2">
                                                    <span class="checkout-product-img">
                                                        <a href="javascript:void();"><img class="img-fluid rounded"
                                                                src="{{ asset('assets/images/book/book/01.jpg') }}"
                                                                alt=""></a>
                                                    </span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="checkout-product-details">
                                                        <h5>{{ $item->book->name }}</h5>
                                                        <p class="text-success">Còn hàng</p>
                                                        <div class="price">
                                                            <h5>{{ $item->book->price }} đ</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <div class="row align-items-center mt-2">
                                                                <div class="col-sm-7 col-md-6">
                                                                    <button type="button" class="fa fa-minus qty-btn"
                                                                        id="btn-minus"
                                                                        wire:click="decreaseQuantity({{ $item->id }})"></button>
                                                                    <input type="text" readonly
                                                                        id="quantity{{ $item->id }}"
                                                                        class="quantity"
                                                                        style=" width: 30px; height: 28px;"
                                                                        value="{{ $item->quantity }}">
                                                                    <button type="button" class="fa fa-plus qty-btn"
                                                                        id="btn-plus"
                                                                        wire:click="increaseQuantity({{ $item->id }})"></button>
                                                                </div>
                                                                <div class="col-sm-5 col-md-6">
                                                                    <span
                                                                        class="product-price">{{ $item->book->price * $item->quantity }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <i class="ri-delete-bin-7-fill"
                                                                wire:click="removeFromCart({{ $item->id }})"
                                                                style="cursor: pointer;"></i>
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
                    <div class="col-lg-4">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <p>Tùy chọn</p>
                                <hr>
                                <p><b>Chi tiết</b></p>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Tổng</span>
                                    <span>{{ $totalPrice }} đ</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Giảm giá</span>
                                    <span class="text-success">{{ $voucher = ($totalPrice * 1) / 100 }} đ</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Thuế VAT</span>
                                    <span>{{ $total = ($totalPrice * 5) / 100 }} đ<span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Phí vận chuyển</span>
                                    <span class="text-success">Miễn phí</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="text-dark"><strong>Tổng</strong></span>
                                    <span class="text-dark"><strong>{{ $finalTotal = $total + $totalPrice - $voucher }}
                                            đ</strong></span>
                                </div>
                                <a id="place-order" href="javascript:void();" class="btn btn-primary d-block mt-3 next"
                                    @if ($finalTotal == 0) disabled @endif>Đặt hàng</a>
                            </div>
                        </div>
                        <div class="iq-card ">
                            <div class="card-body iq-card-body p-0 iq-checkout-policy">
                                <ul class="p-0 m-0">
                                    <li class="d-flex align-items-center">
                                        <div class="iq-checkout-icon">
                                            <i class="ri-checkbox-line"></i>
                                        </div>
                                        <h6>Chính sách bảo mật (Thanh toán an toàn và bảo mật.)</h6>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="iq-checkout-icon">
                                            <i class="ri-truck-line"></i>
                                        </div>
                                        <h6>Chính sách giao hàng (Giao hàng tận nhà.)</h6>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="iq-checkout-icon">
                                            <i class="ri-arrow-go-back-line"></i>
                                        </div>
                                        <h6>Chính sách hoàn trả</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="address" class="card-block p-0 col-12">
                <div class="row align-item-center">
                    <div class="col-lg-8">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Thêm địa chỉ mới</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Họ và tên: *</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $user->name }}" name="fname" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Số điện thoại: *</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $user->phone }}" name="mno" required=""
                                                    maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tỉnh/thành phố: *</label>
                                                <select class="form-control" aria-label=".form-select-sm example"
                                                    id="city">
                                                    <option value="0" selected>Chọn tỉnh/thành phố</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phường: *</label>
                                                <select class="form-control" aria-label=".form-select-sm example"
                                                    id="district">
                                                    <option value="" selected>Chọn quận/huyện</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Địa chỉ: *</label>
                                                <select class="form-control" aria-label=".form-select-sm example"
                                                    id="ward">
                                                    <option value="" selected>Chọn phường/xã</option>
                                                </select>
                                            </div>
                                            <input type="hidden" id="cityName" name="cityName" value="">
                                            <input type="hidden" id="districtName" name="districtName"
                                                value="">
                                            <input type="hidden" id="wardName" name="wardName" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="addtype">Đường*</label>
                                                <input type="text" class="form-control" name="street"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Ghi chú: *</label>
                                                <textarea class="form-control" name="note" rows="5" style="line-height: 22px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button id="savenddeliver" type="button" onclick="saveAndSendRequest()"
                                                class="btn btn-primary">
                                                Lưu thông tin
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <div class="shipping-address">
                                    <h4 class="mb-2">Tên: {{ $user->name }}</h4>
                                    <p class="mb-0">Số điện thoại: {{ $user->phone }} </p>
                                    <p>Địa chỉ:</p>
                                    <p>Ghi chú: </p>
                                </div>
                                <hr>
                                <a id="deliver-address" href="javascript:void();"
                                    class="btn btn-primary d-block mt-1 next disabled" style="pointer-events: none;">
                                    Tiếp tục
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="payment" class="card-block p-0 col-12">
                <div class="row align-item-center">
                    <div class="col-lg-8">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Lựa chọn thanh toán</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form class="mt-3">
                                    <div class="d-flex align-items-center">
                                        <span>Mã giảm giá: </span>
                                        <div class="cvv-input ml-3 mr-3">
                                            <input type="text" class="form-control" required="">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tiếp tục</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="card-lists">
                                    <form action="{{ route('checkout') }}" method="POST"
                                        onsubmit="handleSubmit(event)">
                                        @csrf
                                        <input type="hidden" id="hiddenFname" name="hiddenFname" value="">
                                        <input type="hidden" id="hiddenPhone" name="hiddenPhone" value="">
                                        <input type="hidden" id="hiddenCity" name="hiddenCity" value="">
                                        <input type="hidden" id="hiddenDistrict" name="hiddenDistrict"
                                            value="">
                                        <input type="hidden" id="hiddenWard" name="hiddenWard" value="">
                                        <input type="hidden" id="hiddenStreet" name="hiddenStreet" value="">
                                        <input type="hidden" id="hiddenNote" name="hiddenNote" value="">

                                        <div class="form-group">
                                            @foreach ($paymentMethods as $method)
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="payment_method_{{ $method->id }}"
                                                        name="payment_method" value="{{ $method->id }}"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="payment_method_{{ $method->id }}">{{ $method->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <input type="hidden" name="finalTotal" id=""
                                            value="{{ $finalTotal }}">
                                        <button type="submit" id="paymentButton" method="POST" name="redirect"
                                            class="btn btn-primary d-block mt-1 next">Thanh
                                            toán</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <h4 class="mb-2">Chi tiết</h4>
                                <div class="d-flex justify-content-between">
                                    <span>Giá {{ $totalQuantity }} sản phẩm</span>
                                    <span><strong>{{ $finalTotal }} đ</strong></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Phí vận chuyển</span>
                                    <span class="text-success">Miễn phí</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Số tiền phải trả</span>
                                    <span><strong>{{ $finalTotal }} đ</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<script>
    function removeFromCart(cartId) {
        fetch(`/shopping-cart/cart/remove/${cartId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })

            .then(response => response.json())
            .then(data => data.success && Livewire.dispatch('cartUpdated'))
    }
</script>
