<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh sách tài khoản đã xóa</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">Mã Số</th>
                            <th style="width: 15%;">Ảnh</th>
                            <th style="width: 22.5%;">Tên người dùng</th>
                            <th style="width: 15%;">Vai trò</th>
                            <th style="width: 10%;">Số điện thoại</th>
                            <th style="width: 22.5%;">Email</th>
                            <th style="width: 10%;">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="{{ $item->image_url }}" class="img-fluid avatar-50 rounded"
                                        alt="">
                                </td>
                                <td class="mb-0">{{ $item->name }}</td>
                                @php
                                    $role = $item->role;
                                @endphp
                                <td>
                                    <p class="mb-0 text-center">{{ $role->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 text-center">{{ $item->phone }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 text-center">{{ $item->email }}</p>
                                </td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                        <a class="bg-primary" data-toggle="tooltip" data-placement="top"
                                            title="Khôi phục" href="{{ route('restoreUser', $item->id) }}"><i
                                                class="ri-restore-line"></i></a>
                                        <a class="bg-danger" data-toggle="tooltip" data-placement="top"
                                            title="Xoá Vĩnh Viễn" href="{{ route('deleteUserForever', $item->id) }}"><i
                                                class="ri-delete-bin-line"></i></a>
                                    </div>
                                 

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
