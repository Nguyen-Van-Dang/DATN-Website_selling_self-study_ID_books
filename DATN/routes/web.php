<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\UserController;
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

// Login Phone
Route::post('/', [UserController::class, 'handleLogin'])->name('handleLogin');

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
Route::get('/user-list', function () {
    return view('admin.user.listUser');
})->name('listUser');

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

//course
Route::get('/list-CategoryCourse', function () {
    return view('admin.categoryCourse.listCategoryCourse');
})->name('listCategoryCourse');

Route::get('/add-CategoryCourse', function () {
    return view('admin.categoryCourse.addCategoryCourse');
})->name('addCategoryCourse');

Route::get('/detail-CategoryCourse', function () {
    return view('admin.categoryCourse.detailCategoryCourse');
})->name('detailCategoryCourse');

Route::get('/update-CategoryCourse', function () {
    return view('admin.categoryCourse.updateCategoryCourse');
})->name('updateCategoryCourse');

Route::get('/list-Course', function () {
    return view('admin.course.listCourse');
})->name('listCourse');

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
Route::get('/list-CategoryBook', function () {
    return view('admin.categoryBook.listCategoryBook');
})->name('listCategoryBook');

Route::get('/add-CategoryBook', function () {
    return view('admin.categoryBook.addCategoryBook');
})->name('addCategoryBook');

Route::get('/detail-CategoryBook', function () {
    return view('admin.categoryBook.detailCategoryBook');
})->name('detailCategoryBook');

Route::get('/update-CategoryBook', function () {
    return view('admin.categoryBook.updateCategoryBook');
})->name('updateCategoryBook');

Route::get('/list-Book', function () {
    return view('admin.book.listBook');
})->name('listBook');

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

//exeture

//document

//order
Route::get('/list-Order', function () {
    return view('admin.order.listOrder');
})->name('listOrder');

Route::get('/detail-Order', function () {
    return view('admin.order.detailOrder');
})->name('detailOrder');

Route::get('/update-Order', function () {
    return view('admin.order.updateOrder');
})->name('updateOrder');

//notification
Route::get('/list-Notification', function () {
    return view('admin.notification.listNotification');
})->name('listNotification');

Route::get('/detail-Notification', function () {
    return view('admin.notification.detailNotification');
})->name('detailNotification');

Route::get('/add-Notification', function () {
    return view('admin.notification.addNotification');
})->name('addNotification');

//contact
Route::get('/list-Contact', function () {
    return view('admin.contact.listContact');
})->name('listContact');

Route::get('/detail-Contact', function () {
    return view('admin.contact.detailContact');
})->name('detailContact');

Route::get('/add-Contact', function () {
    return view('admin.contact.addContact');
})->name('addContact');

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

//chi tiết sách
Route::get('/book-detail', function () {
    return view('client.book.bookDetail');
})->name('bookDetail');

//kích hoạt sách
Route::get('/book-id', function () {
    return view('client.book.bookID');
})->name('bookID');

//danh sách khóa học
Route::get('/course-list', function () {
    return view('client.course.course');
})->name('courseList');

//chi tiết khóa học
Route::get('/course-detail', function () {
    return view('client.course.courseDetail');
})->name('courseDetail');

//reels
Route::get('/reels', function () {
    return view('client.reels.reels');
})->name('reals');

//chat
Route::get('/chat', function () {
    return view('client.chat.chat');
})->name('chat');

//course 
// mail
Route::get('send-mail', [MailController::class, 'SendEmail'])->name('SendEmail');
