@extends('layouts.admin.admin')

@section('title', 'Danh sách liên hệ')

@section('content')
    <div class="container-fluid">
        <form method="GET" action="{{ route('listContact') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="filterRole">Lọc theo vai trò:</label>
                    <select name="role" id="filterRole" class="form-control">
                        <option value="">Tất cả</option>
                        <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Giảng viên</option>
                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Học sinh</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="filterDate">Lọc theo thời gian:</label>
                    <input type="date" name="date" id="filterDate" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary mt-4 w-100">Lọc</button>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button" id="deleteAllBtn" class="btn btn-danger w-100">Xóa tất cả</button>
                </div>
            </div>
        </form>


        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header">
                        <h4 class="card-title">Danh sách liên hệ</h4>
                    </div>
                    <div class="iq-card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th> <!-- Checkbox "Check All" -->
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Nội dung</th>
                                    <th>Vai trò</th>
                                    <th>Ngày gửi</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td><input type="checkbox" class="contact-checkbox" value="{{ $contact->id }}">
                                        </td>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($contact->message, 50, '...') }}</td>
                                        <td>
                                            @if (optional($contact->user)->role)
                                                @if ($contact->user->role->id == 2)
                                                    <span style="background-color: #2196F3; color: white; padding: 5px; border-radius: 5px;">
                                                        Giáo viên
                                                    </span>
                                                @elseif ($contact->user->role->id == 3)
                                                    <span style="background-color: #4CAF50; color: white; padding: 5px; border-radius: 5px;">
                                                        Học sinh
                                                    </span>
                                                @else
                                                    <span style="background-color: #9E9E9E; color: white; padding: 5px; border-radius: 5px;">
                                                        Không xác định
                                                    </span>
                                                @endif
                                            @else
                                                <span style="background-color: #9E9E9E; color: white; padding: 5px; border-radius: 5px;">
                                                    Không xác định
                                                </span>
                                            @endif
                                        </td>
                                        
                                        
                                    
                                    
                                    
                                        <td>{{ $contact->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td class="{{ $contact->is_replied ? 'text-success' : 'text-danger' }}">
                                            {{ $contact->is_replied ? 'Đã trả lời' : 'Chưa trả lời' }}
                                        </td>
                                        <td>
                                            <div class="btn-group d-flex justify-content-center gap-2" role="group"
                                                aria-label="Hành động">
                                                <a href="{{ route('replyContact', $contact->id) }}"
                                                    class="btn btn-primary btn-sm" title="Trả lời liên hệ">
                                                    <i class="fas fa-reply mr-1"></i> Trả lời
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal{{ $contact->id }}" title="Xóa liên hệ">
                                                    <i class="fas fa-trash-alt mr-1"></i> Xóa
                                                </button>
                                            </div>

                                            <!-- Modal xác nhận xóa -->
                                            <div class="modal fade" id="deleteModal{{ $contact->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $contact->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $contact->id }}">Xác nhận xóa</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn có chắc chắn muốn xóa liên hệ này không?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Hủy</button>
                                                            <form action="{{ route('contacts.destroy', $contact->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Khi nhấn nút "Xóa tất cả"
        document.getElementById('deleteAllBtn').addEventListener('click', function() {
            const selectedContacts = [];
            document.querySelectorAll('.contact-checkbox:checked').forEach(function(checkbox) {
                selectedContacts.push(checkbox.value);
            });

            if (selectedContacts.length > 0) {
                if (confirm('Bạn có chắc chắn muốn xóa các liên hệ đã chọn không?')) {
                    fetch('{{ route('contacts.bulkDelete') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({
                                ids: selectedContacts
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Xóa thành công!');
                                location.reload();
                            } else {
                                alert('Có lỗi xảy ra khi xóa!');
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Có lỗi xảy ra!');
                        });
                }
            } else {
                alert('Vui lòng chọn ít nhất một liên hệ để xóa.');
            }
        });

        // Chọn hoặc bỏ chọn tất cả các checkbox khi nhấn vào "Check All"
        document.getElementById('checkAll').addEventListener('click', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.contact-checkbox').forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });
        // Thiết lập giá trị min cho trường ngày để không cho phép chọn ngày trong quá khứ
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;

            document.getElementById('filterDate').setAttribute('min', today);
        });
    </script>
@endsection
