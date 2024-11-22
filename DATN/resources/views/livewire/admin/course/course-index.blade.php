<div class="col-sm-12">
    @if (session()->has('message'))
        <div class="">{{ session('message') }}</div>
    @endif
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Danh khóa học khóa học</h4>
            </div>
            <div class="iq-search-bar" style="margin-left: 30%;">
                <form class="searchbox" style="width: 150%;">
                    <input type="text" class="text search-input" placeholder="Tìm kiếm khóa học..."
                        wire:model.live.debounce.10ms="search">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                </form>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <a href="{{ route('admin.khoa-hoc.create') }}" class="btn btn-primary">Thêm khóa học</a>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table class="data-tables table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 3%;">STT</th>
                            <th style="width: 10%;">Hình ảnh</th>
                            <th style="width: 15%;">Tên khóa học</th>
                            <th style="width: 6%;">Số bài giảng</th>
                            <th style="width: 6%;">Giá</th>
                            <th style="width: 10%;">Người tạo</th>
                            <th style="width: 7%;">Hoạt động</th>
                        </tr>
                    </thead>
                    @if (sizeof($Course) > 0)
                        <tbody class="text-center">
                            @foreach ($Course as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td style="width: 10%;">
                                        @php
                                            $firstImage = $item->images->first();
                                        @endphp

                                        @if ($firstImage)
                                            <img src="{{ $firstImage->image_url }}" alt="Image"
                                                class="img-fluid avatar-100 rounded" />
                                        @else
                                            <img src="{{ asset('assets/images/book/user/course.jpg') }}" alt="No Image"
                                                class="img-fluid avatar-100 rounded" />
                                        @endif
                                    </td>
                                    <td>{{ strlen($item->name) > 100 ? substr($item->name, 0, 100) . '...' : $item->name }}
                                    </td>
                                    <td>{{ $item->lectures_count }}</td>
                                    <td>
                                        @if ($item->discount > 0)
                                            <span class="fw-bold text-danger">
                                                {{ number_format($item->price - $item->discount, 0, ',', '.') }} đ
                                            </span>
                                            <br>
                                            <span class="text-muted"
                                                style="text-decoration: line-through; margin-left: 8px;">
                                                {{ number_format($item->price, 0, ',', '.') }} đ
                                            </span>
                                            <br>
                                            @php
                                                $discountPercent = round(($item->discount / $item->price) * 100, 2);
                                            @endphp
                                            <div
                                                style="background-color: #f44336; color: white; padding: 3px 8px; border-radius: 5px; display: inline-block; margin-top: 5px;">
                                                -{{ $discountPercent }}%
                                            </div>
                                        @else
                                            <span class="fw-bold">{{ number_format($item->price, 0, ',', '.') }}
                                                đ</span>
                                        @endif
                                    </td>
                                    @php
                                        $user = $item->user;
                                    @endphp
                                    <td>{{ $user ? optional($item->user)->name : 'Không có người tạo' }}</td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a class="bg-primary" data-toggle="tooltip" title="Xem chi tiết"
                                                href="#"><i class="ri-eye-line"></i></a>
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Chỉnh sửa"
                                                href="{{ route('admin.khoa-hoc.edit', $item->id) }}">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <a class="bg-primary text-white" data-toggle="tooltip" title="Xóa"
                                                wire:click="openPopup('delete', {{ $item->id }})">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">Không tìm thấy khóa học nào.</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            <div class="text-end">
                {{ $Course->links() }}
            </div>
        </div>
    </div>
    <!-- Popup sửa danh mục -->
    <div class="modal {{ $isEditPopupOpen ? 'is-open' : '' }}" id="editCourseCateModal" wire:click="closePopup()">
        <div class="modal-content" wire:click.stop>
            <span class="close" wire:click="closePopup()">&times;</span>
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Sửa khóa học</h4>
                        </div>
                    </div>
                    <div class="iq-card-body modal-body-scrollable">
                        <form action="admin-books.html">
                            <div class="form-group">
                                <label>Tên khóa học:</label>
                                <input type="text" class="form-control" placeholder="Tên khóa học">
                            </div>
                            <div class="form-group">
                                <label>Danh mục khóa học:</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option selected="" disabled="">Danh mục khóa học</option>
                                    <option>General Books</option>
                                    <option>History Books</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tác gải khóa học:</label>
                                <select class="form-control" id="exampleFormControlSelect2">
                                    <option selected="" disabled="">Tác giả khóa học</option>
                                    <option>Jhone Steben</option>
                                    <option>John Klok</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/png, image/jpeg">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>khóa học pdf:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        accept="application/pdf, application/vnd.ms-excel">
                                    <label class="custom-file-label">Chọn file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Giá khóa học:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mô tả khóa học:</label>
                                <textarea class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tên bài giảng:</label>
                                <input type="text" class="form-control" placeholder="Tên khóa học">
                            </div>
                            <div class="form-group">
                                <label>Video khóa học:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/png, image/jpeg">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                            <button type="reset" class="btn btn-danger">Trở lại</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup xóa danh mục -->
    <div class="modal {{ $isDeletePopupOpen ? 'is-open' : '' }}" id="deletedCourseModal" wire:click="closePopup()">
        <div class="modal-content text-center" style="width: 30%;" wire:click.stop>
            <div class="iq-card-header">
                <div class="iq-header-title">
                    <h4 class="card-title">Bạn có chắc chắn xóa hay không?</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <form wire:submit.prevent="deleted" style="padding: 15px;">
                    <button type="submit" class="btn btn-primary" style="width: 100px; height: 40px;">Xác
                        Nhận</button>
                    <button type="reset" class="btn btn-danger" wire:click="closePopup()"
                        style="width: 100px; height: 40px;">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
