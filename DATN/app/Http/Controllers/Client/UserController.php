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

    public function logout(Request $request){
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
}
