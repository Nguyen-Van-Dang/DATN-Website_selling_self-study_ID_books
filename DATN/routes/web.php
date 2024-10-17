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

Route::get('/', function () {
    return view('client.home');
})->name('homeClient');

Route::get('/admin', function () {
    return view('admin.home');
})->name('homeAdmin');

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

//user
Route::resource('nguoi-dung', controller: UserController::class)->names('nguoi-dung');

Route::get('user-list', [UserController::class, 'index'])->name('listUser');

Route::get('/user-add', function () {
    return view('admin.user.addUser');
})->name('addUser');

Route::get('/user-update', function () {
    return view('admin.user.updateUser');
})->name('updateUser');

Route::get('/user-detail', function () {
    return view('admin.user.detailUser');
})->name('detailUser');

Route::get('/user-info', function () {
    return view('admin.user.userInfo');
})->name('userInfo');

// Route::get('user-list/{id}',[UserController::class, 'destroy'])->name('deleteUser');
Route::get('user-deleted', [UserController::class, 'getDestroyUser'])->name('deleteUser');

//course
Route::get('list-CategoryCourse', [CourseCateController::class, 'getAllCourseCate'])->name('listCategoryCourse');

Route::get('/add-CategoryCourse', function () {
    return view('admin.categoryCourse.addCategoryCourse');
})->name('addCategoryCourse');

Route::get('/detail-CategoryCourse', function () {
    return view('admin.categoryCourse.detailCategoryCourse');
})->name('detailCategoryCourse');

Route::get('/update-CategoryCourse', function () {
    return view('admin.categoryCourse.updateCategoryCourse');
})->name('updateCategoryCourse');

// Route::get('/list-Course', function () {
//     return view('admin.course.listCourse');
// })->name('listCourse');

Route::get('list-Course', [CourseController::class, 'getAllCourse'])->name('listCourse');


Route::get('/add-Course', function () {
    return view('admin.course.addCourse');
})->name('addCourse');

Route::get('/update-Course', function () {
    return view('admin.course.updateCourse');
})->name('updateCourse');

Route::get('/detail-Course', function () {
    return view('admin.course.updateCourse');
})->name('detailCourse');


//book
Route::get('list-CategoryBook', [BookCateController::class, 'getAllBookCate'])->name('listCategoryBook');


Route::get('/add-CategoryBook', function () {
    return view('admin.categoryBook.addCategoryBook');
})->name('addCategoryBook');

Route::get('/detail-CategoryBook', function () {
    return view('admin.categoryBook.detailCategoryBook');
})->name('detailCategoryBook');

Route::get('/update-CategoryBook', function () {
    return view('admin.categoryBook.updateCategoryBook');
})->name('updateCategoryBook');

Route::get('list-book', [BookController::class, 'getAllBook'])->name('listBook');

Route::get('/add-Book', function () {
    return view('admin.book.addBook');
})->name('addBook');

Route::get('/update-Book', function () {
    return view('admin.book.updateBook');
})->name('updateBook');

Route::get('/detail-Book', function () {
    return view('admin.book.detailBook');
})->name('detailBook');

//lecture
Route::get('/list-Lecture', function () {
    return view('admin.lecture.listLecture');
})->name('listLecture');

Route::get('/add-Lecture', function () {
    return view('admin.lecture.addLecture');
})->name('addLecture');

Route::get('/update-Lecture', function () {
    return view('admin.lecture.updateLecture');
})->name('updateLecture');

Route::get('/detail-Lecture', function () {
    return view('admin.lecture.detailLecture');
})->name('detailLecture');

//exercise
Route::get('/list-Exercise', function () {
    return view('admin.exercise.listExercise');
})->name('listExercise');

Route::get('/add-Exercise', function () {
    return view('admin.exercise.addExercise');
})->name('addExercise');

Route::get('/update-Exercise', function () {
    return view('admin.exercise.updateExercise');
})->name('updateExercise');

Route::get('/detail-Exercise', function () {
    return view('admin.exercise.detailExercise');
})->name('detailExercise');

//document

//order

Route::get('order-list', [OrderController::class, 'getAllOrder'])->name('listOrder');


Route::get('/detail-Order', function () {
    return view('admin.order.detailOrder');
})->name('detailOrder');

Route::get('/update-Order', function () {
    return view('admin.order.updateOrder');
})->name('updateOrder');

//notification

Route::get('list-Notification', [NotificationController::class, 'getAllNotification'])->name('listNotification');

Route::get('/detail-Notification', function () {
    return view('admin.notification.detailNotification');
})->name('detailNotification');

Route::get('/add-Notification', function () {
    return view('admin.notification.addNotification');
})->name('addNotification');

//contact
Route::get('Contact-list', [ContactController::class, 'getAllContact'])->name('listContact');

Route::get('/detail-Contact', function () {
    return view('admin.contact.detailContact');
})->name('detailContact');

Route::get('/add-Contact', function () {
    return view('admin.contact.addContact');
})->name('addContact');

//Abc
Route::get('/admin/abc/abc', [AbcController::class, 'getAllAbc'])->name('getAllAbc');

Route::get('admin/abc/addAbc', [AbcController::class, 'CreateAbc'])->name('CreateAbc');
Route::post('admin/abc/addAbc', [AbcController::class, 'handleImage'])->name('handleImage');

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


Route::get('/reelsUpload', function () {
    return view('client.reels.reelsUpload');
})->name('reelsUpload');

Route::get('/reels', function () {
    return view('client.reels.reels');
})->name('reals');

//chat
Route::prefix('chat')->name('chat')->group(function () {
    Route::controller(ChatController::class)->group(function () {
        Route::get('/', 'index');
        // Route::get('/orders/{id}', 'show');
        // Route::post('/orders', 'store');
    });
});

//course 
// mail
Route::get('send-mail', [MailController::class, 'SendEmail'])->name('SendEmail');
