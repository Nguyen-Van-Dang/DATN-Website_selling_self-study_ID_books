<?php

use Illuminate\Support\Facades\Route;

/*-------------------------------------------------ADMIN--------------------------------------------------*/

/*-------------------------------------------------CLIENT--------------------------------------------------*/
//đăng nhập
Route::get('/login', function () {
    return view('client.user.login');
})->name('register');

//đăng ký
Route::get('/register', function () {
    return view('client.user.register');
})->name('register');

//thông tin người dùng
Route::get('/user-information', function () {
    return view('client.user.userInformation');
})->name('userInformation');
