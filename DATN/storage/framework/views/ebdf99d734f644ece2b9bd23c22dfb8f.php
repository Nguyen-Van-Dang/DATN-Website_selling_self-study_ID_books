<?php $__env->startSection('title', 'Trang Chủ'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height rounded">
                    <div class="newrealease-contens">
                        <ul id="newrealease-slider" class="list-inline p-0 m-0 d-flex align-items-center">
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/01.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/02.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/03.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/04.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/12.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/18.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/25.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/32.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/41.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:void(0);">
                                    <img src="<?php echo e(asset('assets/images/book/book/21.jpg')); ?>" class="img-fluid w-100 rounded"
                                        alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Sách Mới Nhất</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="<?php echo e(route('bookList')); ?>" class="btn btn-sm btn-primary view-more">Xem Thêm</a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="row">
                            <?php $__currentLoopData = $Book; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                                ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                        <div class="iq-card-body p-0">
                                            <div class="d-flex align-items-center">
                                                <div class="col-6 p-0 position-relative image-overlap-shadow">
                                                    <img class="img-fluid rounded w-100"
                                                        src="<?php echo e($thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/01.jpg')); ?>"
                                                        alt="">
                                                    <div class="view-book">
                                                        <a href="<?php echo e(route('bookDetail', $item->id)); ?>"
                                                            class="btn btn-sm btn-white">Mua Ngay</a>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-2">
                                                        <h6 class="mb-1"><?php echo e($item->name); ?></h6>
                                                        <p class="font-size-13 line-height mb-1"><?php echo e($item->user->name); ?>

                                                        </p>
                                                        <div class="d-block line-height">
                                                            <span class="font-size-11 text-warning">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="price d-flex align-items-center">
                                                        <h6><b><?php echo e($item->price); ?>đ</b></h6>
                                                    </div>
                                                    <div class="iq-product-action">
                                                        <a href="javascript:void(0);"
                                                            onclick="addToCart(<?php echo e($item->id); ?>)" class="ml-2">
                                                            <i class="ri-shopping-cart-2-fill text-primary"></i>
                                                        </a>
                                                        <a href="javascript:void(0);"
                                                            onclick="toggleFavorite(<?php echo e($item->id); ?>)">
                                                            <i class="heart-icon-<?php echo e($item->id); ?> ri-heart-fill"
                                                                style="<?php echo e($item->favorites()->where('user_id', auth()->id())->exists() ? 'color: red;' : 'color: pink;'); ?>"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between mb-0">
                        <div class="iq-header-title">
                            <h4 class="card-title">Sách Thịnh Thành</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle p-0 text-body" id="dropdownMenuButton2"
                                    data-toggle="dropdown">
                                    Trong ngày<i class="ri-arrow-down-s-fill"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton2">
                                    <a class="dropdown-item" href="#">Ngày</a>
                                    <a class="dropdown-item" href="#">Tuần</a>
                                    <a class="dropdown-item" href="#">Tháng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <?php $__currentLoopData = $popularBooks->slice(0, 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $thumbnail = $item->images()->where('image_name', 'thumbnail')->first();
                            ?>
                            <div class="row align-items-center">
                                <div class="col-sm-5 pr-0">
                                    <img class="img-fluid rounded w-100"
                                        src="<?php echo e($thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/01.jpg')); ?>"alt="">
                                </div>
                                <div class="col-sm-7 mt-3 mt-sm-0">
                                    <h4 class="mb-2"><?php echo e($item->name); ?></h4>
                                    <p class="mb-2">Tác Giả <?php echo e($item->user->name); ?></p>
                                    <div class="mb-2 d-block">
                                        <span class="font-size-12 text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                    <span class="text-dark mb-3 d-block"><?php echo e($item->description); ?></span>
                                    <a href="<?php echo e(route('bookDetail', $item->id)); ?>" class="btn btn-primary learn-more">Chi
                                        Tiết</a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between mb-0">
                        <div class="iq-header-title">
                            <h4 class="card-title">Giáo Viên</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle p-0 text-body" id="dropdownMenuButton3"
                                    data-toggle="dropdown">
                                    Ngày<i class="ri-arrow-down-s-fill"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton3">
                                    <a class="dropdown-item" href="#">Tuần</a>
                                    <a class="dropdown-item" href="#">Theo Tháng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="list-inline row mb-0 iq-scrollable-block">
                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $avatar = $teacher->images()->where('image_name', 'avatar')->first();
                                ?>
                                <li class="col-sm-6 d-flex mb-3">
                                    <div class="icon iq-icon-box mr-3">
                                        <a href="javascript:void();">
                                            <img class="img-fluid avatar-60 rounded-circle"
                                                src="<?php echo e($avatar ? $avatar->image_url : asset('assets/images/book/user/3.jpg')); ?>"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="mt-1">
                                        <a href="">
                                            <h6><?php echo e($teacher->name); ?></h6>
                                        </a>
                                        <p class="mb-0 text-primary">Số lượng sách:
                                            <span class="text-body"><?php echo e($teacher->total_books); ?></span>
                                        </p>
                                        <p class="mb-0 text-primary">Số lượng khóa học:
                                            <span class="text-body"><?php echo e($teacher->total_courses); ?></span>
                                        </p>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Sách yêu thích</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="<?php echo e(route('bookList')); ?>" class="btn btn-sm btn-primary view-more">Xem thêm</a>
                        </div>
                    </div>
                    <div class="iq-card-body favorites-contens">
                        <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                            <?php $__currentLoopData = $favBook; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <div class="col-5 p-0 position-relative">
                                            <a href="javascript:void();">
                                                <img class="img-fluid rounded w-100"
                                                    src="<?php echo e($thumbnail ? $thumbnail->image_url : asset('assets/images/book/book/01.jpg')); ?>">
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <h5 class="mb-2"><?php echo e($item->name); ?></h5>
                                            <p class="mb-2">Tác giả : <?php echo e($item->user->name); ?></p>
                                            <div
                                                class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                                <span>Lượt Thích</span>
                                                <span class="mr-4"
                                                    id="favorite-count-<?php echo e($item->id); ?>"><?php echo e($item->favorites()->count()); ?></span>
                                            </div>
                                            <div class="iq-progress-bar-linear d-inline-block w-100">
                                                <div class="iq-progress-bar iq-bg-primary">
                                                    <span class="bg-primary" data-percent="65"></span>
                                                </div>
                                            </div>
                                            <a href="<?php echo e(route('bookDetail', $item->id)); ?>" class="text-dark">Xem Ngay<i
                                                    class="ri-arrow-right-s-line"></i></a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Khóa Học Hấp Dẫn</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="<?php echo e(route('khoa-hoc.index')); ?>" class="btn btn-sm btn-primary view-more">Xem thêm</a>
                        </div>
                    </div>
                    <div class="iq-card-body favorites-contens">
                        <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                            <?php $__currentLoopData = $popularCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $courseImage = $item->images()->where('image_name', 'course')->first();
                                ?>
                                <li class="col-md-2">
                                    <a href="<?php echo e(route('khoa-hoc.show', $item->id)); ?>">
                                        <div class="trendy-course card h-100 pt-3"
                                            style=" transition: transform 0.3s ease;">
                                            <img src="<?php echo e($courseImage ? $courseImage->image_url : asset('assets/images/book/book/01.jpg')); ?>"
                                                class="card-img-top img-fluid rounded course-image" alt="Product 3">
                                            <div class="card-body border pt-1">
                                                <div>
                                                    <h5 class="card-title course-title"><?php echo e($item->name); ?></h5>
                                                    <h7 class="card-title course-teacher" style="font-size: 13px">
                                                        
                                                </div>
                                                <div class="d-flex justify-content-evenly mt-3 flex-nowrap"
                                                    style="font-size: 13px">
                                                    <span class="text-danger font-weight-bold"><?php echo e($item->price); ?>đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .trendy-course {
            transition: transform 0.3s ease;
        }

        .trendy-course:hover {
            transform: scale(1.05);
        }

        .course-image {
            aspect-ratio: 1.5/1;
            object-fit: cover
        }
    </style>
    <script>
        function toggleFavorite(bookId) {
            fetch(`/sach/${bookId}/toggle-favorite`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const heartIcons = document.querySelectorAll(`.heart-icon-${bookId}`);
                    heartIcons.forEach(icon => {
                        icon.style.color = data.is_favorite ? 'red' : 'pink';
                    });
                    const favoriteCountElement = document.querySelector(`#favorite-count-${bookId}`);
                    if (favoriteCountElement) {
                        favoriteCountElement.textContent = data.new_favorite_count;
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function addToCart(bookId) {
            fetch(`/gio-hang/cart/add/${bookId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => data.success && Livewire.dispatch('cartUpdated'))
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/client/home.blade.php ENDPATH**/ ?>