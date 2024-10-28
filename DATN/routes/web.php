<?php

use App\Http\Controllers\Client\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\ReelsController;
use App\Http\Controllers\Admin\AbcController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Client\BookCateController;
use App\Http\Controllers\Client\BookController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\CourseCateController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Client\FollowController;
use App\Http\Controllers\Client\NotificationUserController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('client.home');
})->name('homeClient');

//Abc
Route::get('/admin/abc/abc', [AbcController::class, 'getAllAbc'])->name('getAllAbc');
Route::get('admin/abc/addAbc', [AbcController::class, 'CreateAbc'])->name('CreateAbc');
Route::post('admin/abc/addAbc', [AbcController::class, 'handleImage'])->name('handleImage');

// Login Google
Route::get('auth/google', [UserController::class, 'redirectToGoogle'])->name('login-by-google');
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);

// Login Zalo

// Login FaceBook
Route::get('auth/facebook', [UserController::class, 'redirectToFacebook'])->name('login-by-facebook');
Route::get('auth/facebook/callback', [UserController::class, 'handleFacebookCallback']);

// Login Phone
Route::post('/', [UserController::class, 'handleLogin'])->name('handleLogin');

// Register Phone

//Log Out
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//error
Route::get('/404', function () {
    return view('error.404');
})->name('404');

Route::get('/500', function () {
    return view('error.500');
})->name('500');

Route::get('/maintenance', function () {
    return view('error.maintenance');
})->name('maintenance');
/*-------------------------------------------------ADMIN--------------------------------------------------*/

/* --------------- ADMIN GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin', function () { return view('admin.home');})->name('homeAdmin');
    Route::get('/admin/user-info', function () { return view('admin.user.userInfo');})->name('userInfo');
});
/* --------------- ORDER GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/order-list', [OrderController::class, 'getAllOrder'])->name('listOrder');
    Route::get('/admin/detail-Order', function () { return view('admin.order.detailOrder');})->name('detailOrder');
    Route::get('/admin/update-Order', function () { return view('admin.order.updateOrder');})->name('updateOrder');
});

/* --------------- CATEGORY-COURSE GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('list-CategoryCourse', [CourseCateController::class, 'getAllCourseCate'])->name('listCategoryCourse');
});

/* --------------- COURSE GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/list-Course', [CourseController::class, 'getAllCourse'])->name('listCourse');
    Route::get('/admin/add-Course', function () { return view('admin.course.addCourse');})->name('addCourse');
    Route::get('/admin/update-Course', function () { return view('admin.course.updateCourse');})->name('updateCourse');
    Route::get('/admin/detail-Course', function () { return view('admin.course.updateCourse');})->name('detailCourse');
});

/* --------------- CATEGORY-BOOK GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/list-CategoryBook', [BookCateController::class, 'getAllBookCate'])->name('listCategoryBook');
    Route::get('/admin/add-CategoryBook', function () { return view('admin.categoryBook.addCategoryBook');})->name('addCategoryBook');
    Route::get('/admin/detail-CategoryBook', function () { return view('admin.categoryBook.detailCategoryBook');})->name('detailCategoryBook');
    Route::get('/admin/update-CategoryBook', function () { return view('admin.categoryBook.updateCategoryBook');})->name('updateCategoryBook');
});

/* --------------- BOOK GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/list-book', [BookController::class, 'getAllBook'])->name('listBook');
    Route::get('/admin/add-Book', function () { return view('admin.book.addBook');})->name('addBook');
    Route::get('/admin/update-Book', function () { return view('admin.book.updateBook');})->name('updateBook');
    Route::get('/admin/detail-Book', function () { return view('admin.book.detailBook');})->name('detailBook');
});

/* --------------- LECTURE GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/list-Lecture', function () { return view('admin.lecture.listLecture');})->name('listLecture');
    Route::get('/admin/add-Lecture', function () { return view('admin.lecture.addLecture');})->name('addLecture');
    Route::get('/admin/update-Lecture', function () { return view('admin.lecture.updateLecture');})->name('updateLecture');
    Route::get('/admin/detail-Lecture', function () { return view('admin.lecture.detailLecture');})->name('detailLecture');
});

//Abc
Route::get('/admin/abc/abc', [AbcController::class, 'getAllAbc'])->name('getAllAbc');
Route::get('admin/abc/addAbc', [AbcController::class, 'CreateAbc'])->name('CreateAbc');
Route::post('admin/abc/addAbc', [AbcController::class, 'handleImage'])->name('handleImage');

/* --------------- EXERCISE GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/list-Exercise', function () { return view('admin.exercise.listExercise');})->name('listExercise');
    Route::get('/admin/add-Exercise', function () { return view('admin.exercise.addExercise');})->name('addExercise');
    Route::get('/admin/update-Exercise', function () { return view('admin.exercise.updateExercise');})->name('updateExercise');
    Route::get('/admin/detail-Exercise', function () { return view('admin.exercise.detailExercise');})->name('detailExercise');
});

/* --------------- NOTIFICATION GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/list-Notification', [NotificationUserController::class, 'getAllNotificationUser'])->name('listNotificationUser');
    Route::get('/admin/list-Notification-Detail/{id}', [NotificationController::class, 'getNotificationById'])->name('listNotification');
    Route::get('/admin/detail-Notification', function () { return view('admin.notification.detailNotification');})->name('detailNotification');
    Route::get('/admin/add-Notification', function () { return view('admin.notification.addNotification');})->name('addNotification');
});

// role 2 không vào được các trang này
Route::middleware([CheckRole::class . ':1'])->group(function () {
    Route::resource('/admin/nguoi-dung', UserController::class)->names('nguoi-dung');
    Route::get('/admin/user-list', [UserController::class, 'index'])->name('listUser');
    Route::get('/admin/user-add', function () { return view('admin.user.addUser');})->name('addUser');
    Route::get('/admin/user-update', function () { return view('admin.user.updateUser');})->name('updateUser');
    Route::get('/admin/user-detail', function () { return view('admin.user.detailUser');})->name('detailUser');
    Route::get('/admin/user-deleted', [UserController::class, 'getDestroyUser'])->name('deleteUser');
    // Route::get('user-list/{id}',[UserController::class, 'destroy'])->name('deleteUser');
});

/* --------------- CONTACT GROUP --------------- */
Route::middleware([CheckRole::class . ':1'])->group(function () {
    Route::get('/admin/Contact-list', [ContactController::class, 'getAllContact'])->name('listContact');
    Route::get('/admin/detail-Contact', function () { return view('admin.contact.detailContact');})->name('detailContact');
    Route::get('/admin/add-Contact', function () { return view('admin.contact.addContact');})->name('addContact');
});
/*-------------------------------------------------CLIENT--------------------------------------------------*/

// thông tin người dùng
Route::get('/user-information', function () {
    return view('client.user.userInformation');
})->name('userInformation');

// thông tin chi tiết người dùng
Route::get('/user-detail', function () {
    return view('client.user.userDetail');
})->name('userDetail');

//giỏ hàng
Route::get('/shopping-cart', function () {
    return view('client.payment.shoppingCart');
})->name('shoppingCart');

//danh sách cuốn sách
Route::get('/book-list', function () {
    return view('client.book.book');
})->name('bookList');

// tất cả thông báo
Route::get('/notification-list', function () {
    return view('client.notification.notification');
})->name('notificationList');

//chi tiết sách
Route::get('/book-detail', function () {
    return view('client.book.bookDetail');
})->name('bookDetail');

//kích hoạt sách
Route::get('/book-id', function () {
    return view('client.book.bookID');
})->name('bookID');

//danh sách khóa học
Route::prefix('khoa-hoc')->name('khoa-hoc')->group(function () {
    Route::controller(CourseController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id?}', 'show')->name('khoa-hoc.show');
        // Route::post('/orders', 'store');
    });
});

//chi tiết khóa học
Route::get('/course-detail', function () {
    return view('client.course.courseDetail');
})->name('courseDetail');

//reels
Route::post('/reelsUpload', [ReelsController::class, 'upload'])->name('reelsUpload');
Route::get('/reelsUpload1', [ReelsController::class, 'showVideo'])->name('reelsUpload1');
Route::post('/reelsUpload1', [ReelsController::class, 'reelsUpload1'])->name('reelsUpload1');
Route::get('/reelsUpload', function () {return view('client.reels.reelsUpload');})->name('reelsUpload');

Route::get('/reels', function () {
    return view('client.reels.reels');
})->name('reals');

//follow
Route::post('/follow/{userId}', [FollowController::class, 'follow'])->name('follow');
Route::delete('/unfollow/{userId}', [FollowController::class, 'unfollow'])->name('unfollow');
//view
Route::post('/reels/view/{reelId}', [ReelsController::class, 'incrementViewCount']);

//chat
Route::prefix('chat')->name('chat')->middleware('auth')->group(function () {
    Route::controller(ChatController::class)->group(function () {
        Route::get('/', 'index');
    });
});

//course 
// mail
Route::get('send-mail', [MailController::class, 'SendEmail'])->name('SendEmail');

//học tập
Route::get('/hoc-tap', function () {
    return view('client.course.myCourses');
})->name('hoc-tap');

Route::get('/test', function () {
    return view('welcome');
});