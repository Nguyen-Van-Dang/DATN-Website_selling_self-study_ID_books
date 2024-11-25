<?php

use App\Http\Controllers\Admin\BookCategoryController;
use App\Http\Controllers\Client\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\ReelsController;
use App\Http\Controllers\Client\BinController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Client\BookController as ClientBookController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Client\CartDetailController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\CourseCateController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Client\FollowController;
use App\Http\Controllers\Client\NotificationUserController;
use App\Http\Controllers\CourseActivationController;
use App\Http\Middleware\CheckLoggedIn;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\AutoLogout;
use App\Livewire\Client\Book\Books;
use App\Livewire\Client\Book\BookDetail;
use App\Http\Controllers\Client\LectureController;
use App\Livewire\Client\Cart\Carts;
use App\Livewire\Client\Order\Orders;

/* --------------- HOME CLIENT --------------- */

Route::get('/', [UserController::class, 'HomeClient'])->name('homeClient');

/* --------------- hOME ADMIN --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.home');
    })->name('homeAdmin');
    Route::get('/admin/thong-tin-nguoi-dung', function () {
        return view('admin.user.userInfo');
    })->name('userInfo');
    Route::post('/admin/thong-tin-nguoi-dung', [UserController::class, 'changePassword'])->name('userInfo');
});
/* --------------- LOGIN GG --------------- */
Route::get('auth/google', [UserController::class, 'redirectToGoogle'])->name('login-by-google');
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);

/* --------------- LOGIN ZL --------------- */
Route::get('/auth/zalo', [UserController::class, 'redirectToZalo'])->name('login-by-zalo');
Route::get('auth/zalo/callback', [UserController::class, 'handleZaloCallback']);

/* -------------- LOGIN FB --------------- */
// Route::get('auth/facebook', [UserController::class, 'redirectToFacebook'])->name('login-by-facebook');
// Route::get('auth/facebook/callback', [UserController::class, 'handleFacebookCallback']);

Route::get('auth/{provider}', [UserController::class, 'authProviderRedirect'])->name('login-by-provider');
Route::get('auth/{provider}/callback', [UserController::class, 'socialAuthentication']);


/* -------------- LOGIN PHONE --------------- */
Route::post('/', [UserController::class, 'handleLogin'])->name('handleLogin');

/* -------------- REGISTER --------------- */

/* -------------- LOGOUT--------------- */
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

/* --------------- ERROR --------------- */
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

/* --------------- ORDER GROUP ------------------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/danh-sach-don-hang', [OrderController::class, 'getAllOrder'])->name('listOrder');
    Route::get('/admin/chi-tiet-don-hang', function () {
        return view('admin.order.detailOrder');
    })->name('detailOrder');
    Route::get('/admin/chinh-sua-don-hang', function () {
        return view('admin.order.updateOrder');
    })->name('updateOrder');
});
/* --------------- CATEGORY-COURSE GROUP --------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/danh-muc-khoa-hoc', [CourseCateController::class, 'getAllCourseCate'])->name('listCategoryCourse');
});
/* --------------- COURSE GROUP ------------------------ */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/khoa-hoc/danh-sach-khoa-hoc', [CourseController::class, 'getAllCourse'])->name('listCourse');
    Route::get('/admin/khoa-hoc/them-khoa-hoc', function () {
        return view('admin.course.addCourse');
    })->name('addCourse');
});
/* --------------- CATEGORY-BOOK GROUP ------------------*/
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('danh-muc-sach', BookCategoryController::class);
    });
});
/* --------------- BOOK GROUP -------------------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('sach', AdminBookController::class);
    });
});
/* --------------- EXERCISE GROUP ----------------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/list-Exercise', function () {
        return view('admin.exercise.listExercise');
    })->name('listExercise');
    Route::get('/admin/add-Exercise', function () {
        return view('admin.exercise.addExercise');
    })->name('addExercise');
    Route::get('/admin/update-Exercise', function () {
        return view('admin.exercise.updateExercise');
    })->name('updateExercise');
    Route::get('/admin/detail-Exercise', function () {
        return view('admin.exercise.detailExercise');
    })->name('detailExercise');
});
/* --------------- NOTIFICATION GROUP ------------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/list-Notification', [NotificationUserController::class, 'getAllNotificationUser'])->name('listNotificationUser');
    Route::get('/admin/list-Notification-Detail/{id}', [NotificationController::class, 'getNotificationById'])->name('listNotification');
    Route::get('/admin/detail-Notification', function () {
        return view('admin.notification.detailNotification');
    })->name('detailNotification');
    Route::get('/admin/add-Notification', function () {
        return view('admin.notification.addNotification');
    })->name('addNotification');
});
/* --------------- BIN GROUP ---------------------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::get('/admin/thung-rac', [BinController::class, 'checkRole'])->name('bin');
});
/* --------------- ACCOUNT GROUP ------------------------ */
Route::middleware([CheckRole::class . ':1'])->group(function () {
    Route::resource('/admin/nguoi-dung', UserController::class)->names('nguoi-dung');
    Route::get('/admin/danh-sach-nguoi-dung', [UserController::class, 'getAllUserList'])->name('listUser');
    Route::get('/admin/them-nguoi-dung', function () {
        return view('admin.user.addUser');
    })->name('addUser');
    Route::get('/admin/sua-nguoi-dung', function () {
        return view('admin.user.updateUser');
    })->name('updateUser');
    Route::get('/admin/chi-tiet-nguoi-dung', function () {
        return view('admin.user.detailUser');
    })->name('detailUser');
    Route::get('/admin/xoa-nguoi-dung', [UserController::class, 'getDestroyUser'])->name('deleteUser');
    // Route::get('user-list/{id}',[UserController::class, 'destroy'])->name('deleteUser');
});
/* --------------- CONTACT GROUP ------------------------ */
Route::middleware([CheckRole::class . ':1'])->group(function () {
    Route::get('/admin/danh-sach-lien-he', [ContactController::class, 'getAllContact'])->name('listContact');
    Route::get('/admin/chi-tiet-lien-he', function () {
        return view('admin.contact.detailContact');
    })->name('detailContact');
    Route::get('/admin/gui-lien-he', function () {
        return view('admin.contact.addContact');
    })->name('addContact');
});

/*-------------------------------------------------CLIENT--------------------------------------------------*/

//danh sách cuốn sách
Route::prefix('/sach')->group(
    function () {
        Route::get('/', [ClientBookController::class, 'getAllBookClient'])->name('bookList');
        Route::post('/{id}/toggle-favorite', [Books::class, 'toggleFavorite'])->name('toggleFavorite');
        Route::get('/yeu-thich', [ClientBookController::class, 'getAllBookFavorite'])->name('getAllBookFavorite');
        Route::get('/{id}', [ClientBookController::class, 'getBookDetailClient'])->name('bookDetail');
    }
);

Route::prefix('khoa-hoc')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('khoa-hoc.index');
    Route::get('/{id}', [CourseController::class, 'show'])->name('khoa-hoc.show');
    Route::post('/', [Orders::class, 'courseCheckout'])->name('courseCheckout');
});
// thông tin người dùng

Route::get('/user-information', [UserController::class, 'showUser'])->name('userInformation');
Route::post('/user-information', [UserController::class, 'updateUser'])->name('userInformation');


// Route::get('/user-information', function () {
//     return view('client.user.userInformation');
// })->name('userInformation');
// Route::pots('/user-information', [UserController::class, 'updateUser'])->name('userInformation');
// thông tin chi tiết người dùng
Route::get('/user-detail', [UserController::class, 'showUserDetail'])->name('userDetail');

//giỏ hàng
Route::prefix('/gio-hang')->group(function () {
    Route::get('/', function () {
        return view('client.payment.shoppingCart');
    })->name('shoppingCart');
    Route::post('/cart/add/{id}', [Books::class, 'addToCart'])->name('addToCart');
    Route::post('/cart/remove/{id}', [Carts::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/', [Carts::class, 'checkout'])->name('checkout');
    Route::match(['get', 'post'], '/vnpay-callback', [Carts::class, 'vnpayCallback'])->name('vnpayCallback');
    Route::match(['get', 'post'], '/momo-callback', [Carts::class, 'momoCallback'])->name('momoCallback');
});
Route::prefix('/don-hang')->group(
    function () {
        Route::get('/', [OrderController::class, 'orderList'])->name('orderList');
        Route::post('/', [Orders::class, 'orderCheckout'])->name('orderCheckout');
        Route::match(['get', 'post'], '/vnpay-callback', [Carts::class, 'vnpayCallback'])->name('vnpayCallback');
        Route::match(['get', 'post'], '/momo-callback', [Carts::class, 'momoCallback'])->name('momoCallback');
    }
);


// tất cả thông báo
Route::get('/notification-list', function () {
    return view('client.notification.notification');
})->name('notificationList');

//kích hoạt sách
Route::prefix('kich-hoat-sach')->group(function () {
    Route::get('/', [CourseActivationController::class, 'index'])->name('kich-hoat-sach');
    Route::post('/redirect', [CourseActivationController::class, 'redirect'])->name('kich-hoat-sach.redirect');
    Route::get('/{book_id}', [CourseActivationController::class, 'checkBook'])->name('kich-hoat-sach.checkBook');
    Route::post('/activate', [CourseActivationController::class, 'activate'])->name('kich-hoat-sach.activate');
});

//danh sách khóa học
Route::prefix('khoa-hoc')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('khoa-hoc.index');
    Route::get('/{id}', [CourseController::class, 'show'])->name('khoa-hoc.show');
    Route::post('/', [Orders::class, 'courseCheckout'])->name('courseCheckout');
});

//reels
Route::post('/reelsUpload', [ReelsController::class, 'upload'])->name('reelsUpload');
Route::get('/reelsUpload1', [ReelsController::class, 'showVideo'])->name('reelsUpload1');
Route::post('/reelsUpload1', [ReelsController::class, 'reelsUpload1'])->name('reelsUpload1');
Route::get('/reelsUpload', function () {
    return view('client.reels.reelsUpload');
})->name('reelsUpload');

Route::get('/reels', function () {
    return view('client.reels.reels');
})->name('reals');

//follow
Route::post('/follow/{userId}', [FollowController::class, 'follow'])->name('follow');
Route::delete('/unfollow/{userId}', [FollowController::class, 'unfollow'])->name('unfollow');
//view
Route::post('/reels/view/{reelId}', [ReelsController::class, 'incrementViewCount']);

Route::middleware([CheckLoggedIn::class])->group(function () {
    Route::prefix('chat')->name('chat')->group(function () {
        Route::controller(ChatController::class)->group(function () {
            Route::get('/', 'index');
        });
    });
});
Route::delete('/leave-group/{id}', [ChatController::class, 'leaveGroup'])->name('leaveGroup');

// mail
Route::get('send-mail', [MailController::class, 'SendEmail'])->name('SendEmail');

//học tập
Route::get('/hoc-tap', function () {
    return view('client.course.myCourses');
})->name('hoc-tap');

Route::get('/hoc-khoa-hoc', function () {
    return view('client.lecture.lecture');
})->name('lecture');
