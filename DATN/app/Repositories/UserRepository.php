<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ForgetPass;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Flasher\Toastr\Prime\ToastrInterface;
use Flasher\Toastr\Prime\Toastr;
use Flasher\Toastr\Laravel\Flasher;
use App\Services\GoogleDriveService;
use Flasher\Laravel\Http\Request;

class UserRepository
{
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
        toastr()->success('<p>Bạn đã đăng xuất thành công!</p>');
        return redirect('/');
    }
    //đăng nhập bằng sdt
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
        toastr()->success('<p;">Bạn đã đăng nhập thành công!</p>');

        return redirect()->intended('/');
    }
    // đăng nhập bằng Zalo
    public function handleZaloCallback(\Illuminate\Http\Request $request)
    {
        $user = Socialite::driver('zalo')->user();

        $email = $user->getEmail() ?: uniqid() . '@zalo.com';

        $phone = $user->user['phone'] ?? null;

        $findUser = User::where('email', $email)->first();

        if ($findUser) {
            Auth::login($findUser);
        } else {
            $newUser = User::create([
                'name' => $user->name,
                // 'image_url' => $user->avatar, // Sử dụng trường avatar nếu cần
                'email' => $email,
                'zalo_id' => $user->id,
                'password' => Hash::make(Str::random(16)),
                'phone' => $phone, // Lưu số điện thoại nếu có
                'loginType' => 3,
                'role_id' => 3,
            ]);

            Auth::login($newUser);
        }

        return redirect()->intended('/');
    }
    //đăng nhập bằng gg
    public function handleGoogleCallback(\Illuminate\Http\Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();

            // Ghi log thông tin người dùng từ Google
            Log::info('User object from Google: ', (array)$user);

            // Kiểm tra nếu ID và Email đã được thiết lập
            if (!isset($user->id) || empty($user->email)) {
                return redirect()->back()->withErrors(['error' => 'User ID or Email not found in Google account']);
            }

            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456789'),
                    'loginType' => 2,
                    'role_id' => 3
                ]);
                Auth::login($newUser);
            }
            toastr()->success('<p;">Bạn đã đăng nhập thành công!</p>');

            return redirect()->intended('/');
        } catch (Exception $e) {
            Log::error('Error during Google callback: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to login with Google']);
        }
    }
        // đăng nhập bằng fb
    public function handleFacebookCallback(\Illuminate\Http\Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $findUser = User::where('social_id', $user->id)->first();

            dd($user);
            if ($findUser) {
                $findUser->update([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $user->image,
                    'loginType' => 'facebook',
                ]);

                Auth::login($findUser);
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'image' => $user->image,
                    'loginType' => 'facebook',
                    'password' => encrypt('123456789'),
                ]);

                // Đăng nhập người dùng mới tạo
                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            return redirect('homeClient')->withErrors(['msg' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    //hiển thịt tất cả tài khoản user bên admin
    public function getAllUser()
    {
        $User = User::getAll();
        return view('admin.user.listUser', ['User' => $User]);
    }
    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
    public function getDeletedUser()
    {
        return view('admin.user.deletedUser');
    }
}
