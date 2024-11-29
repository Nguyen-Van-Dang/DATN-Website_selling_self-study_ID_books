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
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Client\FollowController;
use App\Http\Controllers\Client\NotificationUserController;
use App\Http\Controllers\Client\CourseActivationController;
use App\Http\Controllers\Admin\CourseActivationController as AdminCourseActivationController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Client\ExamController as ClientExamController;
use App\Http\Middleware\CheckLoggedIn;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\AutoLogout;
use App\Livewire\Client\Book\Books;
use App\Http\Controllers\client\ApproveController;
use App\Livewire\Client\Cart\Carts;
use App\Livewire\Client\Order\Orders;
use App\Http\Controllers\ForgotPasswordController;
use App\Livewire\Client\User\LoginUser;
use App\Livewire\Client\User\RegisterUser;

/* --------------- HOME CLIENT --------------- */

Route::get('/', [UserController::class, 'HomeClient'])->name('homeClient');

/* --------------- hOME ADMIN --------------- */
Route::middleware([CheckRole::class . ':1'])->group(function () {
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
// Route::post('/', [UserController::class, 'handleLogin'])->name('handleLogin');
Route::prefix('/dang-nhap')->group(function () {
    Route::get('/', [LoginUser::class, 'handleLogin'])->name('handleLogin');
});
Route::prefix('/dang-nhap')->group(function () {
    Route::get('/', [RegisterUser::class, 'handleRegister'])->name('handleRegister');
});
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
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('khoa-hoc', AdminCourseController::class);
    });
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
/* --------------- COURSE-ACTIVATION GROUP -------------------------- */
Route::middleware([CheckRole::class . ':1'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kich-hoat-sach', controller: AdminCourseActivationController::class);
        Route::get('/export-course-activation/{courseActivationId}', [AdminCourseActivationController::class, 'export'])->name('export-course-activation');
    });
});
/* --------------- EXAM GROUP ----------------------- */
Route::middleware([CheckRole::class . ':1,2'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('de-thi', controller: AdminExamController::class);
        Route::get('admin/de-thi/{id}/export', [AdminExamController::class, 'download'])->name('de-thi.download');
        // Route::get('/export-course-activation/{courseActivationId}', [AdminCourseActivationController::class, 'export'])->name('export-course-activation');
    });
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
    Route::get('/admin/danh-sach-nguoi-dung', [UserController::class, 'index'])->name('listUser');
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
/* --------------- CONTACT GROUP ---------------------------- */
Route::middleware([CheckRole::class . ':1'])->group(function () {
    Route::get('/admin/danh-sach-lien-he', [ContactController::class, 'getAllContact'])->name('listContact');
    Route::get('phan-hoi/{id}', [ContactController::class, 'replyContactForm'])->name('replyContact');
    Route::post('phan-hoi/{id}', [ContactController::class, 'sendReply'])->name('sendReply');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts/bulk-delete', [ContactController::class, 'bulkDelete'])->name('contacts.bulkDelete');
});
// reset mail

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('forgot-password/send-otp', [ForgotPasswordController::class, 'se`ndOtp'])->name('send-otp');
Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verify-otp');
Route::post('change-password', [ForgotPasswordController::class, 'changePassword'])->name('change-password');
Route::get('/new-password', [ForgotPasswordController::class, 'showNewPasswordForm'])->name('new-password-form');
Route::post('/change-password', [ForgotPasswordController::class, 'changePassword'])->name('change-password');



/* --------------- APPROVE GROUP ---------------------------- */
Route::middleware([CheckRole::class . ':1'])->group(function () {
    Route::get('/admin/kiem-duyet', [ApproveController::class, 'index'])->name('approve');
    Route::patch('/{model}/{id}/approve', [ApproveController::class, 'approve'])->name('model.approve');
    Route::delete('/{model}/{id}/reject', [ApproveController::class, 'reject'])->name('model.reject');
});
/* --------------- reset mail client ---------------------------- */

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
Route::middleware([CheckLoggedIn::class])->group(function () {
    Route::prefix('kich-hoat-sach')->group(function () {
        Route::get('/', [CourseActivationController::class, 'index'])->name('kich-hoat-sach');
        Route::post('/redirect', [CourseActivationController::class, 'redirect'])->name('kich-hoat-sach.redirect');
        Route::get('/{book_id}', [CourseActivationController::class, 'checkBook'])->name('kich-hoat-sach.checkBook');
        Route::post('/activate', [CourseActivationController::class, 'activate'])->name('kich-hoat-sach.activate');
    });
});

//danh sách khóa học
Route::prefix('khoa-hoc')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('khoa-hoc.index');
    Route::get('/{id}', [CourseController::class, 'show'])->name('khoa-hoc.show');
    Route::get('/{course_id}/bai-giang/{lecture_id}', [CourseController::class, 'detail'])->name('khoa-hoc.chitiet');
    Route::post('/', [Orders::class, 'courseCheckout'])->name('courseCheckout');
});

//reels
Route::prefix('tai-video')->group(function () {
    Route::get('/', [ReelsController::class, 'index'])->name('tai-video.index');
    Route::post('/', [ReelsController::class, 'submit'])->name('tai-video.submit');
});

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
            Route::get('/{groupChatId}',  'show')->name('chat.show');
        });
    });
});
Route::middleware([CheckLoggedIn::class])->group(function () {
    Route::get('chat/{id}', [ChatController::class, 'show'])->name('chat.show');
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

//đề thi
Route::middleware([CheckLoggedIn::class])->group(function () {
    Route::prefix('de-thi')->group(function () {
        Route::get('/', [ClientExamController::class, 'index'])->name('de-thi.index');
        Route::get('/{exam_id}', [ClientExamController::class, 'doExam'])->name('de-thi.doExam');
        Route::get('/ket-qua/{result_id}', [ClientExamController::class, 'showExam'])->name('de-thi.showExam');
    });
});

Route::prefix('lien-he')->group(function () {
    Route::get('gui-lien-he', function () {
        return view('client.contact.addContact');
    })->name('addContact');
    Route::post('gui-lien-he', [ContactController::class, 'storeContact'])->name('storeContact');
});



Route::get('/user/thong-tin-nguoi-dung', function () {
    return view('client.user.userInformation');
})->name('userInformation');
Route::post('/user/thong-tin-nguoi-dung', [UserController::class, 'changePassword'])->name('userInformation');


Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm1'])->name('forgot-password');
Route::post('forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('send-otp');
