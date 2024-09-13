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

//course


//book


//lecsson


//order


//notification


//contact

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

//reals
Route::get('/reels', function () {
    return view('client.reels.reels');
})->name('reals');

//chat

//reals
Route::get('/chat', function () {
    return view('client.chat.chat');
})->name('chat');

// mail
Route::get('send-mail', [MailController::class, 'SendEmail'])->name('SendEmail');
