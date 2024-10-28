<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh sách bài giảng</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a href="{{ route('addLecture') }}" class="btn btn-primary">Thêm bài giảng</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">STT</th>
                            <th style="width: 22.5%;">Tên bài giảng</th>
                            <th style="width: 20%;">Khóa Học</th>
                            <th style="width: 20%;">Người Tạo</th>
                            <th style="width: 20%;">Video</th>
                            <th style="width: 11%;">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($Lecture as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="mb-0">{{ $item->name }}</td>
                                @php
                                    $user = $item->user;
                                    $course = $item->course;
                                @endphp
                                <td>{{ $course ? optional($item->course)->name : 'Không có khóa học' }}</td>
                                <td>{{ $user ? optional($item->user)->name : 'Không có người dùng' }}</td>
                                <td>{{ $item->video_url ? $item->video_url : 'Không có video' }}</td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top"
                                            title="Xem chi tiết" href="{{ route('detailLecture') }}"><i
                                                class="ri-eye-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Sửa"
                                            href="{{ route('updateLecture') }}"><i class="ri-pencil-line"></i></a>
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Xóa"
                                            href="#"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-end">
                {{ $Lecture->links() }}
            </div>
        </div>
    </div>
</div>
