<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ForgetPass;
use App\Models\Role;
use App\Models\User;
use Exception;

class UserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    //đăng xuất
    public function logout(\Illuminate\Http\Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    //đăng nhập bằng gg
    public function handleGoogleCallback(\Illuminate\Http\Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('id', $user->id)->first();

            if ($finduser) {
                $newUser = User::updateOrCreate(
                    [
                        'email' => $user->email
                    ],
                    [
                        'name' => $user->name,
                        'google_id' => $user->id,
                        'password' => encrypt('123456789'),
                        'loginType' => 2,
                        'role_id' => 3
                    ]
                );
                Auth::login($newUser);
                return redirect()->intended('/');
            } else {
                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'name' => $user->name,
                        'google_id' => $user->id,
                        'role_id' => 3,
                        'password' => encrypt('123456789'),
                        'loginType' => 2

                    ]
                );
                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    //đăng nhập bằng fb
    // public function handleFacebookCallback()
    // {
    //     try {
    //         $user = Socialite::driver('facebook')->user();
    //         $findUser = User::where('social_id', $user->id)->first();

    //         if ($findUser) {
    //             // Người dùng đã tồn tại, cập nhật thông tin
    //             $findUser->update([
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'image' => $user->image,
    //                 'loginType' => 'facebook',
    //             ]);

    //             // Đăng nhập người dùng đã tồn tại
    //             Auth::login($findUser);
    //             return redirect()->intended('/');
    //         } else {
    //             // Tạo người dùng mới
    //             $newUser = User::create([
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'social_id' => $user->id,
    //                 'image' => $user->image,
    //                 'loginType' => 'facebook',
    //                 'password' => encrypt('123456789'),
    //             ]);

    //             // Đăng nhập người dùng mới tạo
    //             Auth::login($newUser);
    //             return redirect()->intended('/');
    //         }
    //     } catch (Exception $e) {
    //         return redirect('/login')->withErrors(['msg' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
    //     }
    // }
////
    // public function handleFacebookCallback(\Illuminate\Http\Request $request)
    // {
    //     $checkUser = User::where('social_id', $request->uid)->first();

    //     if ($checkUser) {
    //         $checkUser->social_id = $request->uid;
    //         $checkUser->name = $request->displayName;
    //         $checkUser->image = $request->photoURL;
    //         $checkUser->email = $request->email;
    //         $checkUser->mobile_number = $request->phoneNumber;
    //         $checkUser->save();
    //         Auth::loginUsingId($checkUser->id, true);
    //         return response()->json([
    //             "status" => "success"
    //         ]);
    //     } else {
    //         $user = new User;
    //         $user->social_id = $request->uid;
    //         $user->name = $request->displayName;
    //         $user->image = $request->photoURL;
    //         $user->email = $request->email;
    //         $user->mobile_number = $request->phoneNumber;
    //         $user->user_type = "facebook";
    //         $user->save();
    //         Auth::loginUsingId($user->id, true);
    //         return response()->json([
    //             "status" => "success"
    //         ]);
    //     }
    // }

    /*-------------------------------------------------------Admin---------------------------------------------------------*/

    /*-------------------------------------------------------Client---------------------------------------------------------*/
    public function loginUser($data)
    {
        $messages = [
            'phone.required' => 'Xin vui lòng nhập số điện thoại',
            'phone.regex' => 'Xin vui lòng nhập số điện thoại hợp lệ (10 số)',
            'password.required' => 'Xin vui lòng nhập mật khẩu',
        ];

        $validator = Validator::make($data->all(), [
            'phone' => ['required', 'regex:/^([0-9]{10})$/'],
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('phone', $data->phone)->where('loginType', 1)->first();

        // if (!$user || !password_verify($data->password, $user->password)) {
        //     return redirect('/')->withErrors(['login' => 'Số điện thoại hoặc mật khẩu sai'])->withInput();
        // }

        Auth::login($user);
        return redirect()->intended('/');
    }
}
