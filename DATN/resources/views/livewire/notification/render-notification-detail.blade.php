<div class="col-sm-12">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Chi tiết thông báo</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-borderless">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 7%;">tiêu đề</th>
                            <th style="width: 20%;">Nội dung</th>
                            <th style="width: 5%;">Trạng thái</th>
                            <th style="width: 3%;" class="text-center">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Notification as $item)
                            <tr>
                                <td class="text-center">{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
                                <td class="text-center">{{ $item->status == 1 ? 'Đã Gửi' : 'Chưa Gửi' }}</td>
                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a id="deleteButton-{{ $item->id }}" class="bg-primary text-white"
                                            href="" data-toggle="tooltip" title="Xóa"><i
                                                class="ri-delete-bin-line"></i></a>
                                    </div>
                                    <form action="{{ route('nguoi-dung.destroy', $item->id) }}" method="POST"
                                        id="delete-form-{{ $item->id }}" style="display:none">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="text-end">
                {{ $Notification->links() }}
            </div>
        </div>
    </div>
        <!-- Popup xác nhận -->
        <div id="confirmPopup"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
        <p>Bạn có chắc chắn muốn xóa thông báo này không?</p>
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
            const notificationId = this.id.split('-')[1];
            // Hiển thị popup và màn che
            document.getElementById('confirmPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            // Gán sự kiện cho nút Xác nhận
            document.getElementById('yesButton').onclick = function() {
                // Gửi form xóa tài khoản
                document.getElementById(`delete-form-${notificationId}`).submit();
            };
        });
    });
    // Ẩn popup khi nhấn nút "Trở về"
    document.getElementById('noButton').addEventListener('click', function() {
        document.getElementById('confirmPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    });
</script>