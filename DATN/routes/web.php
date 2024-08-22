<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.home');
})->name('homeClient');
Route::get('/admin', function () {
    return view('admin.home');
})->name('homeAdmin');

// thông tin người dùng
Route::get('/user-information', function () {
    return view('client.user.userInformation');
})->name('userInformation');

//giỏ hàng
Route::get('/shopping-cart', function () {
    return view('client.payment.shoppingCart');
})->name('shoppingCart');

//chi tiết sách
Route::get('/book-detail', function () {
    return view('client.book.bookDetail');
})->name('bookDetail');

//danh sách cuốn sách
Route::get('/book-list', function () {
    return view('client.book.bookList');
})->name('bookList');
