@extends('layouts.client.client')

@section('title', 'Giỏ Hàng')

@section('content')
    <livewire:client.cart.carts />

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

@endsection
