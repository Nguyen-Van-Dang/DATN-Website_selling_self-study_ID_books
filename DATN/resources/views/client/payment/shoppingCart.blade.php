@extends('layouts.client.client')

@section('title', 'Giỏ Hàng')

@section('content')
    @if ($cart->isEmpty()) <!-- Kiểm tra nếu giỏ hàng trống -->
        <h2 class="text-center">Giỏ hàng của bạn hiện đang trống. Vui lòng thêm sản phẩm vào giỏ hàng</h2>
    @else
        <div class="container-fluid">
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
                                                                <h5>${{ $item->book->price }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <div class="row align-items-center mt-2">
                                                                    <div class="col-sm-7 col-md-6">
                                                                        <button type="button" class="fa fa-minus qty-btn"
                                                                            id="btn-minus"></button>
                                                                        <input type="text" id="quantity"
                                                                            value="{{ $item->quantity }}">
                                                                        <button type="button" class="fa fa-plus qty-btn"
                                                                            id="btn-plus"></button>
                                                                    </div>
                                                                    <div class="col-sm-5 col-md-6">
                                                                        <span
                                                                            class="product-price">{{ $item->book->price * $item->quantity }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href=""
                                                                    onclick="removeFromCart({{ $item->id }})"
                                                                    class="text-dark font-size-20"><i
                                                                        class="ri-delete-bin-7-fill"></i></a>
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
                                        <span>${{ $totalPrice }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Giảm giá</span>
                                        <span class="text-success">${{ $voucher = ($totalPrice * 1) / 100 }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Thuế VAT</span>
                                        <span>${{ $total = ($totalPrice * 5) / 100 }}<span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Phí vận chuyển</span>
                                        <span class="text-success">Miễn phí</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-dark"><strong>Tổng</strong></span>
                                        <span
                                            class="text-dark"><strong>${{ $finalTotal = $total + $totalPrice - $voucher }}</strong></span>
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
                                                    <input type="text" class="form-control" value="{{ $user->name }}"
                                                        name="fname" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Số điện thoại: *</label>
                                                    <input type="text" class="form-control" value="{{ $user->phone }}"
                                                        name="mno" required="">
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
                                        <form action="{{ route('checkout') }}" method="POST">
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
                                            <button type="submit" class="btn btn-primary d-block mt-1 next">Thanh
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
                                        <span><strong>${{ $finalTotal }}</strong></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Phí vận chuyển</span>
                                        <span class="text-success">Miễn phí</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span>Số tiền phải trả</span>
                                        <span><strong>${{ $finalTotal }}</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Id);
            }
            citis.onchange = function() {
                district.length = 1; // Xóa tất cả các tùy chọn quận/huyện
                ward.length = 1; // Xóa tất cả các tùy chọn phường/xã
                if (this.value != "") {
                    const result = data.filter(n => n.Id === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Id);
                    }
                }
            };
            district.onchange = function() {
                ward.length = 1; // Xóa tất cả các tùy chọn phường/xã
                const dataCity = data.filter((n) => n.Id === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Id);
                    }
                }
            };
        }
        $('#city').change(function() {
            var cityName = $(this).find('option:selected').text();
            $('#cityName').val(cityName);
        });

        $('#district').change(function() {
            var districtName = $(this).find('option:selected').text();
            $('#districtName').val(districtName);
        });

        $('#ward').change(function() {
            var wardName = $(this).find('option:selected').text();
            $('#wardName').val(wardName);
        });
    </script>
    <script>
        function saveAndSendRequest() {
            const name = document.querySelector('input[name="fname"]').value;
            const phone = document.querySelector('input[name="mno"]').value;
            const city = document.querySelector('#city').options[document.querySelector('#city').selectedIndex].text;
            const district = document.querySelector('#district').options[document.querySelector('#district').selectedIndex]
                .text;
            const ward = document.querySelector('#ward').options[document.querySelector('#ward').selectedIndex].text;
            const street = document.querySelector('input[name="street"]').value;
            const note = document.querySelector('textarea[name="note"]').value;

            // Kiểm tra xem tất cả các trường cần thiết đều đã được điền
            if (name && phone && city && district && ward && street) {
                // Cập nhật nội dung địa chỉ
                document.querySelector('.shipping-address').innerHTML = `
                    <h4 class="mb-0">Tên: ${name}</h4>
                    <p class="mb-0">Số điện thoại: ${phone}</p>
                    <p>Địa chỉ: ${street}, ${ward}, ${district}, ${city}</p>
                    <p>Ghi chú: ${note}</p>
                `;

                // Cập nhật giá trị cho các input ẩn
                document.getElementById('hiddenFname').value = name; // Sửa từ fname thành name
                document.getElementById('hiddenPhone').value = phone;
                document.getElementById('hiddenCity').value = city;
                document.getElementById('hiddenDistrict').value = district;
                document.getElementById('hiddenWard').value = ward;
                document.getElementById('hiddenStreet').value = street;
                document.getElementById('hiddenNote').value = note;

                // Bật nút "Tiếp tục" khi lưu thành công
                const deliverAddressBtn = document.getElementById('deliver-address');
                deliverAddressBtn.style.pointerEvents = 'auto';
                deliverAddressBtn.classList.remove('disabled');
            } else {
                alert('Vui lòng điền đầy đủ thông tin.');
            }
        }
    </script>
    <script>
        function removeFromCart(id) {
            fetch(`/remove-from-cart/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật giao diện, ví dụ: reload lại giỏ hàng hoặc cập nhật số lượng
                        alert(data.message);
                        location.reload(); // Reload để cập nhật lại danh sách sản phẩm
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

@endsection
