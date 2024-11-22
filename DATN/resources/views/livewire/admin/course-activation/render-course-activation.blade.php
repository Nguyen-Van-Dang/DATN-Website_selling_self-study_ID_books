<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Thông tin Sách kích hoạt Khoá Học</h4>
            </div>
            <div class="iq-search-bar" style="margin-left: 30%;">
                <form class="searchbox" style="width: 150%;">
                    <input type="text" class="text search-input" placeholder="Tìm kiếm sách..."
                        wire:model.live.debounce.10ms="search">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a href="{{ route('admin.kich-hoat-sach.create') }}" class="btn btn-primary">Tạo mới liên kết kích
                    hoạt</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 20%;">Sách</th>
                            <th style="width: 20%;">Khoá học</th>
                            <th style="width: 15%;">Giảng viên</th>
                            <th style="width: 5%;">Trạng thái</th>
                            <th style="width: 10%;">Số lượng mã</th>
                            <th style="width: 10%;">Đã kích hoạt</th>
                            <th style="width: 10%;">Tỷ lệ kích hoạt</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    @if (sizeof($courseActivations) > 0)
                        <tbody class="text-center">
                            @foreach ($courseActivations as $item)
                                <tr>
                                    <td>{{ $item->book->name }}</td>
                                    <td>{{ $item->course->name }}</td>
                                    <td>{{ $item->course->user->name }}</td>
                                    <td>
                                        <span class="badge {{ $item->status == 0 ? 'badge-primary' : 'badge-danger' }}">
                                            {{ $item->status == 0 ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->codes_count }} <a
                                            href="{{ route('admin.export-course-activation', $item->id) }}"
                                            alt="Tải xuống"><i class="ri-file-fill text-secondary font-size-18"></i></a>
                                    </td>
                                    @php
                                        // Tính tỷ lệ kích hoạt
                                        $totalCodes = $item->codes_count;
                                        $activatedCodes = $item->codes()->whereNotNull('activation_date')->count();
                                        $activationRate = $totalCodes > 0 ? ($activatedCodes / $totalCodes) * 100 : 0;
                                    @endphp
                                    <td>{{ $activatedCodes }} </td>
                                    <td>
                                        <span
                                            style="background-color: #f44336; color: white; padding: 5px; border-radius: 5px;">
                                            {{ number_format($activationRate, 2) }}%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a class="bg-primary" data-toggle="tooltip" title="Chỉnh sửa"
                                                href="{{ route('admin.kich-hoat-sach.edit', $item->id) }}"><i
                                                    class="ri-pencil-line"></i></a>
                                            <a id="deleteButton-{{ $item->id }}" class="bg-primary text-white"
                                                href="" data-toggle="tooltip" title="Xóa"><i
                                                    class="ri-delete-bin-line"></i></a>
                                        </div>
                                        <form action="{{ route('admin.kich-hoat-sach.destroy', $item->id) }}"
                                            method="POST" id="delete-form-{{ $item->id }}" style="display:none">
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
                {{ $courseActivations->links() }}
            </div>
        </div>
    </div>
    <!-- Popup xác nhận -->
    <div id="confirmPopup"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
        <p>Bạn có chắc chắn muốn xóa liên kết kích hoạt này không?</p>
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
            const userId = this.id.split('-')[1];
            document.getElementById('confirmPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('yesButton').onclick = function() {
                document.getElementById(`delete-form-${userId}`).submit();
            };
        });
    });
    document.getElementById('noButton').addEventListener('click', function() {
        document.getElementById('confirmPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    });
</script>
