<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Phê duyệt</h4>
                    </div>
                </div>
                <div class="iq-card-body p-0">
                    <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills w-100">

                            <li class="col-md-4 p-0">
                                <a class="nav-link active" data-toggle="pill" href="#Book">
                                    Sách
                                </a>
                            </li>
                            <li class="col-md-4 p-0">
                                <a class="nav-link" data-toggle="pill" href="#Course">
                                    Khóa Học
                                </a>
                            </li>
                            <li class="col-md-4 p-0">
                                <a class="nav-link" data-toggle="pill" href="#User">
                                    Người dùng
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">

                    {{-- couse --}}

                    <div class="tab-pane fade" id="Course" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Danh sách duyệt khóa học</h4>
                                <div class="iq-search-bar">
                                    <form class="searchbox">
                                        <input type="text" class="text search-input" placeholder="Tìm khóa học..."
                                            wire:model.live.debounce.100ms="searchCourse">
                                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                    </form>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive">
                                    <table class="data-tables table table-striped table-bordered" style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th style="width: 5%;">STT</th>
                                                {{-- <th style="width: 10%;">Ảnh</th> --}}
                                                <th style="width: 10%;">Tên khóa học</th>
                                                <th style="width: 10%;">Giá</th>
                                                {{-- <th style="width: 10%;">Email</th> --}}
                                                <th style="width: 10%;">Mô tả</th>

                                                {{-- <th style="width: 10%;">Yêu cầu</th> --}}

                                                <th style="width: 10%;">Trạng thái</th>
                                                <th style="width: 10%;">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @livewire('admin.course.course-approve')
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- sách --}}

                    <div class="tab-pane fade active show" id="Book" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Danh sách duyệt sách</h4>
                                <div class="iq-search-bar">
                                    <form class="searchbox">
                                        <input type="text" class="text search-input" placeholder="Tìm sách..."
                                            wire:model.live.debounce.100ms="searchBooks">
                                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                    </form>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive">
                                    <table class="data-tables table table-striped table-bordered" style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th style="width: 5%;">STT</th>
                                             
                                                <th style="width: 10%;">Tên sách</th>
                                                <th style="width: 10%;">Tác giả</th>
                                                <th style="width: 10%;">Giá</th>
                                                <th style="width: 10%;">Giảm giá</th>
                                                <th style="width: 10%;">Mô tả</th>
                                                
                                                <th style="width: 10%;">Trạng thái</th>
                                                <th style="width: 10%;">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @livewire('admin.book.book-approve')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- người dùng --}}
                    <div class="tab-pane fade" id="User" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Danh sách duyệt người dùng</h4>
                                <div class="iq-search-bar">
                                    <form class="searchbox">
                                        <input type="text" class="text search-input" placeholder="Tìm sách..."
                                            wire:model.live.debounce.100ms="searchBooks">
                                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                    </form>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive">
                                    <table class="data-tables table table-striped table-bordered" style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th style="width: 5%;">STT</th>
                                                <th style="width: 10%;">Tên người dùng</th>
                                                <th style="width: 10%;">Số điện thoại</th>
                                                <th style="width: 10%;">Email</th>
                                                <th style="width: 10%;">Yêu cầu</th>
                                                {{-- <th style="width: 10%;">Trạng thái</th> --}}
                                                <th style="width: 10%;">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @livewire('admin.user.user-approve')
                                            {{-- @livewire('admin.course.course-approve') --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
