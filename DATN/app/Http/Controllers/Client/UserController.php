<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->getAllUser();
    }

    public function create()
    {
        echo 'Tạo mới người dùng';
    }
    public function store(Request $request)
    {
        echo 'xu ly luu tru';
    }

    public function edit($id)
    {
        echo 'chỉnh sửa người dùng có id là ' . $id . '';
    }
    public function update(Request $request)
    {
        echo 'xu ly update';
    }


    public function logout(Request $request)
    {
        return $this->userRepository->logout($request);
    }
    public function handleLogin(Request $request)
    {
        return $this->userRepository->loginUser($request);
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(Request $request)
    {
        return $this->userRepository->handleGoogleCallback($request);
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    // public function handleFacebookCallback(Request $request)
    // {
    //     return $this->userRepository->handleFacebookCallback($request);
    // }

// UserController.php

public function restoreUser($id)
{
    // Gọi phương thức restoreUser từ repository
    $this->userRepository->restoreUser($id);

    return redirect()->route('deletedUsers')->with('success', 'Khôi phục tài khoản thành công!');
}

public function deleteUserForever($id)
{
    // Gọi phương thức deleteUserForever từ repository
    $this->userRepository->deleteUserForever($id);

    return redirect()->route('deletedUsers')->with('success', 'Đã xóa tài khoản vĩnh viễn!');
}



    // public function redirectToZalo()
    // {
    //     return Socialite::driver('zalo')->redirect();
    public function redirectToZalo()
    {
    // }
        return Socialite::driver('zalo')
            ->scopes(['email', 'phone']) // Thêm phạm vi quyền
            ->redirect();
    }
    public function handleZaloCallback(Request $request)
    {
        return $this->userRepository->handleZaloCallback($request);
    }
}
