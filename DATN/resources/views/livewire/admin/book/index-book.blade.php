<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Thông tin Sách</h4>
            </div>
            <div class="iq-search-bar" style="margin-left: 30%;">
                <form class="searchbox" style="width: 150%;">
                    <input type="text" class="text search-input" placeholder="Tìm kiếm sách..."
                        wire:model.live.debounce.10ms="search">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a href="{{ route('admin.sach.create') }}" class="btn btn-primary">Thêm sách</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 5%;">Ảnh</th>
                            <th style="width: 15%;">Tên</th> 
                            <th style="width: 14%;">Giá</th> 
                            <th style="width: 6%;">Số lượng</th> 
                            <th style="width: 20%;">Khoá học</th>
                            <th style="width: 20%;">Danh Mục</th>
                            <th style="width: 5%;"></th> 
                        </tr>
                    </thead>
                    @if (sizeof($Book) > 0)
                        <tbody class="text-center">
                            @foreach ($Book as $item)
                                <tr>
                                    @php
                                        $course = $item->courseActivations->first();
                                        $user = $item->user;
                                        $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                                    @endphp
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @if ($thumbnail)
                                            <img class="img-fluid img-thumbnail" src="{{ $thumbnail->image_url }}"
                                                alt="Ảnh cuốn sách {{ $item->name }}" style="width:80px">
                                        @else
                                            <img class="img-fluid img-thumbnail"
                                                src="{{ asset('assets/images/book/book_placeholder.png') }}"
                                                alt="Ảnh cuốn sách {{ $item->name }}" style="width:80px">
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->discount)
                                            <span style="font-weight: bold">
                                                {{ number_format($item->price - ($item->price * $item->discount) / 100, 0, ',', '.') }}
                                                đ
                                            </span>
                                            <span class="text-muted" style="text-decoration-line: line-through">
                                                {{ number_format($item->price, 0, ',', '.') }} đ
                                            </span>
                                            <br>
                                            <span
                                                style="background-color: #f44336; color: white; padding: 5px; border-radius: 5px;">
                                                -{{ $item->discount }}%
                                            </span>
                                        @else
                                            <span>{{ number_format($item->price, 0, ',', '.') }} đ</span>
                                        @endif

                                    </td>

                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->courseActivations->first() ? $item->courseActivations->first()->course->name : 'Không' }}
                                    </td>


                                    <td>
                                        @foreach ($item->categories as $category)
                                            <span class="badge badge-secondary">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a class="bg-primary" data-toggle="tooltip" title="Xem chi tiết"
                                                href="#"><i class="ri-eye-line"></i></a>
                                            <a class="bg-primary" data-toggle="tooltip" title="Chỉnh sửa"
                                                href="{{ route('admin.sach.edit', $item->id) }}"><i
                                                    class="ri-pencil-line"></i></a>
                                            <a id="deleteButton-{{ $item->id }}" class="bg-primary text-white"
                                                href="" data-toggle="tooltip" title="Xóa"><i
                                                    class="ri-delete-bin-line"></i></a>
                                        </div>
                                        <form action="{{ route('admin.sach.destroy', $item->id) }}" method="POST"
                                            id="delete-form-{{ $item->id }}" style="display:none">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td colspan="9" class="text-center">Không tìm thấy cuốn sách nào.</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            <div class="text-end">
                {{ $Book->links() }}
            </div>
        </div>
    </div>
    <!-- Popup xác nhận -->
    <div id="confirmPopup"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
        <p>Bạn có chắc chắn muốn xóa tài khoản này không?</p>
        <div class="text-center">
            <button id="yesButton"
                style="width: 90px; height: 35px; border: none; color: white; background: #11e1c2; border-radius: 5px;">
                Xác nhận
            </button>
            <button id="noButton"
                style="width: 90px; height: 35px; border: none; color: black; background-color: #0000000e; border-radius: 5px;">
                Trở về
            </button>
        </div>
    </div>
    <!-- Màn che -->
    <div id="overlay"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;">
    </div>
</div>

<script>
    document.querySelectorAll('[id^=deleteButton-]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            // Lấy ID tài khoản từ nút xóa
            const userId = this.id.split('-')[1];
            // Hiển thị popup và màn che
            document.getElementById('confirmPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            // Gán sự kiện cho nút Xác nhận
            document.getElementById('yesButton').onclick = function() {
                // Gửi form xóa tài khoản
                document.getElementById(`delete-form-${userId}`).submit();
            };
        });
    });
    // Ẩn popup khi nhấn nút "Trở về"
    document.getElementById('noButton').addEventListener('click', function() {
        document.getElementById('confirmPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    });
</script>
