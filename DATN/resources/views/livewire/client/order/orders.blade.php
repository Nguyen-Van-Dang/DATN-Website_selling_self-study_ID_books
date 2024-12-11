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
                                <div class="d-flex justify-content-between">
                                    <span><b>Tổng</b></span>
                                    <span><b>0 đ</b></span>
                                </div>
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
                                                        <div class="col-sm-7">
                                                            <div class="checkout-product-details">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="d-flex align-items-center"
                                                                        style="width: 100%;">
                                                                        @if ($detail->book)
                                                                            <h6 class="text-black mb-0 me-2"><strong>Đơn
                                                                                    Sách</strong></h6>
                                                                        @elseif ($detail->course)
                                                                            <h6 class="text-black mb-0 me-2"><strong>Đơn
                                                                                    Khóa Học</strong></h6>
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 text-center"
                                                                        style="width: 100%;">
                                                                        <span
                                                                            style="font-weight: 500">#{{ $order->id }}</span>
                                                                    </div>
                                                                    <div class="text-center" style="width: 100%;">
                                                                        @if ($order->payment_status == 0)
                                                                            <p class="text-danger mb-0"><strong>Chưa
                                                                                    Thanh Toán</strong></p>
                                                                        @elseif ($order->payment_status == 2)
                                                                            <p class="text-warning mb-0">
                                                                                <strong>Đang Giao</strong>
                                                                            </p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-5">
                                                            <div class="row">
                                                                <div class="col-sm-6 text-right">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="orderId {{ $order->id }}"
                                                                        wire:click="openDetailPopup({{ $order->id }})">
                                                                        Chi Tiết Đơn Hàng
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-6 text-left">
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
                                    <span><b>Tổng</b></span>
                                    <span><b>{{ number_format($totalPrice) }}đ</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="backdrop-filter: blur(1px);" class="modal fade {{ $isPaymentPopupOpen ? 'show d-block' : '' }}"
                tabindex="-1" role="dialog">
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
                                                class="custom-control-input" wire:model="selectedPaymentMethod"
                                                value="{{ $method->id }}">
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
            <div style="backdrop-filter: blur(1px);" class="modal fade {{ $isDetailPopupOpen ? 'show d-block' : '' }}"
                tabindex="-1" role="dialog">
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
                                                                        $bookImage = $detail->book->images
                                                                            ->where('image_name', 'thumbnail')
                                                                            ->first();
                                                                    @endphp
                                                                    @if ($bookImage)
                                                                        <img src="{{ $bookImage->image_url }}"
                                                                            class="img-thumbnail">
                                                                    @endif
                                                                @elseif ($detail->course)
                                                                    @php
                                                                        $courseImage = $detail->course->images
                                                                            ->where('image_name', 'thumbnail')
                                                                            ->first();
                                                                    @endphp
                                                                    @if ($courseImage)
                                                                        <img src="{{ $courseImage->image_url }}"
                                                                            style="height:70px;"
                                                                            class="img-thumbnail">
                                                                    @endif
                                                                @endif
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @if ($detail->book)
                                                            <div class="checkout-product-details">
                                                                <h5>{{ $detail->book->name }}</h5>
                                                                <div class="price">
                                                                    <h5>{{ number_format($detail->book->price) }}đ</h5>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="checkout-product-details">
                                                                <h5>{{ $detail->course->name }}</h5>
                                                                <div class="price">
                                                                    <h5>{{ number_format($detail->course->price) }}đ
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        @endif
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
                                                                    <div class="col-md-7 text-center">
                                                                        <h5>Tổng Tiền</h5>
                                                                        @if ($detail->book)
                                                                            <span class="product-price">
                                                                                {{ number_format($detail->book->price * $detail->quantity) }}đ</span>
                                                                        @else
                                                                            <span class="product-price">
                                                                                {{ number_format($detail->course->price) }}đ</span>
                                                                        @endif
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
