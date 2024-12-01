<div>
    <div class="container-fluid">
        <div class="slider" style="position: relative;">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 h-50"
                            src="https://mshoagiaotiep.com/uploads/images/resize/900x900/2020/08/lotrinhkhtructuyen.png"
                            alt="First slide" style="width:100%; height:400px!important">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 h-50"
                            src="https://hoctot.hocmai.vn/wp-content/uploads/2021/09/188771577_171199578338164_5563194315142148917_n-8.png"
                            alt="Second slide" style="width:100%; height:400px!important">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 h-50" src="https://i.ytimg.com/vi/0yE64-0U1IE/maxresdefault.jpg"
                            alt="Third slide" style="width:100%; height:400px!important">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Button to trigger modal -->
            @if (Auth::check() && Auth::user()->role_id == 1)
                <button id="editIcon" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#imageUploadModal">
                    <i class="ri-pencil-line" style="margin-right: 0"></i>
                </button>
            @endif
        </div>
        <style>
            #editIcon {
                display: flex;
                align-items: center;
                /* Căn giữa theo chiều dọc */
                justify-content: center;
                /* Căn giữa theo chiều ngang */
                position: absolute;
                bottom: 10px;
                right: 10px;
                border-radius: 50%;
                height: 35px;
                width: 35px;
            }
        </style>
        <!-- Modal for image upload -->
        <div class="modal fade" id="imageUploadModal" tabindex="-1" aria-labelledby="imageUploadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageUploadModalLabel">Cập nhật banner khóa học</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="border: none; background: none">X</button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updateBanner">
                            <div class="form-group mb-3">
                                <input type="file" wire:model="image1" accept="image/*" class="form-control mb-3">
                                @error('image1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" wire:model="image2" accept="image/*" class="form-control mb-3">
                                @error('image2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" wire:model="image3" accept="image/*" class="form-control mb-3">
                                @error('image3')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
