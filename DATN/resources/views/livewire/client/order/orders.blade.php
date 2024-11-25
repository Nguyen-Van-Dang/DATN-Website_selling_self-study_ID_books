<div class="container-fluid">

    @if ($Order->isEmpty())
        <div class="row">
            <div id="cart" class="card-block show p-0 col-12">
                <div class="row align-item-center">
                    <div class="col-lg-8">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex iq-border-bottom mb-0">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Bạn không có đơn hàng chưa thanh toán</h4>
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
                                    <h4 class="card-title">Đơn Hàng</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <ul class="list-inline p-0 m-0">
                                    @php
                                        $displayedOrderIds = [];
                                    @endphp
                                    @foreach ($Order as $order)
                                        @foreach ($order->orderDetails as $detail)
                                            @if (!in_array($order->id, $displayedOrderIds))
                                                <li class="checkout-product">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-4">
                                                            <div class="checkout-product-details">
                                                                @if ($detail->book)
                                                                    <h6>Đơn Sách</h6>
                                                                    <h5>{{ $order->id }}</h5>
                                                                @elseif ($detail->course)
                                                                    <h6>Đơn Khóa Học</h6>
                                                                    <h5>{{ $order->id }}</h5>
                                                                @endif

                                                                @if ($order->payment_status == 0)
                                                                    <p class="text-danger">Chưa Thanh Toán</p>
                                                                @else
                                                                    <p class="text-success">Đã Thanh Toán</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="row align-items-center mt-2">
                                                                        <div class="col-sm-12">
                                                                            <span class="product-price text-white">
                                                                                {{ number_format($order->price) }}
                                                                                đ
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 text-right">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="orderId {{ $order->id }}"
                                                                        wire:click="openDetailPopup({{ $order->id }})">
                                                                        Chi Tiết Đơn Hàng
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-4 text-left">
                                                                    @if ($order->payment_status == 0)
                                                                        <button type="button" class="btn btn-primary"
                                                                            wire:click="openPaymentPopup({{ $order->id }})">
                                                                            Thanh Toán
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @php
                                                    $displayedOrderIds[] = $order->id;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <div class="d-flex justify-content-between">
                                    <span class="text-dark"><strong>Tổng</strong></span>
                                    <span class="text-dark"><strong>{{ number_format($totalPrice) }}đ</strong></span>
                                </div>
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
            <div class="modal fade {{ $isPaymentPopupOpen ? 'show d-block' : '' }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Lựa chọn thanh toán </h5>
                            <button type="button" class="close" wire:click="closePaymentPopup">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('orderCheckout') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    @foreach ($paymentMethods as $method)
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="payment_method_{{ $method->id }}"
                                                name="payment_method" value="{{ $method->id }}"
                                                wire:model="selectedPaymentMethod" value="{{ $method->id }}"
                                                class="custom-control-input">
                                            <label class="custom-control-label"
                                                for="payment_method_{{ $method->id }}">{{ $method->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary" name="redirect">Thanh
                                    toán</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade {{ $isDetailPopupOpen ? 'show d-block' : '' }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Chi tiết Đơn Hàng {{ $this->order ? $this->order->id : 'N/A' }} (
                                Chưa Thuế)
                            </h5>
                            <button type="button" class="close" wire:click="closeDetailPopup">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="iq-card-body">
                                <ul class="list-inline p-0 m-0">
                                    @if ($this->order)
                                        @foreach ($this->order->orderDetails as $detail)
                                            <li class="checkout-product">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-2">
                                                        <span class="checkout-product-img">
                                                            <a href="javascript:void();">
                                                                @if ($detail->book)
                                                                    @php
                                                                        $bookImage = $detail->book->images->first();
                                                                    @endphp
                                                                    @if ($bookImage)
                                                                        <img src="{{ $bookImage->image_url }}"
                                                                            class="img-thumbnail">
                                                                    @endif
                                                                @elseif ($detail->course)
                                                                    @php
                                                                        $courseImage = $detail->course->images->first();
                                                                    @endphp
                                                                    @if ($courseImage)
                                                                        <img src="{{ $courseImage->image_url }}"
                                                                            class="img-thumbnail">
                                                                    @endif
                                                                @endif
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="checkout-product-details">
                                                            <h5>{{ $detail->book->name }}</h5>
                                                            <div class="price">
                                                                <h5>{{ number_format($detail->book->price) }}đ</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row align-items-center mt-2">
                                                                    <div class="col-md-4">
                                                                        <input type="text" readonly
                                                                            id="quantity{{ $detail->id }}"
                                                                            class="quantity"
                                                                            style=" width: 30px; height: 28px;"
                                                                            value="{{ $detail->quantity }}">
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <h5>Tổng Tiền</h5>
                                                                        <span
                                                                            class="product-price pl-2">{{ number_format($detail->book->price * $detail->quantity) }}đ</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
