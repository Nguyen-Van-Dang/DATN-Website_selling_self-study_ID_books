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

    public function destroy($id)
    {
        $this->userRepository->softDelete($id);
        return redirect()->back();
    }

    public function getDestroyUser()
    {
        return $this->userRepository->getDeletedUser();
    }
}
