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
use Illuminate\Support\Facades\Log;



class UserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
    //đăng xuất
    public function logout(\Illuminate\Http\Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

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

            return redirect()->intended('/');
        } catch (Exception $e) {
            Log::error('Error during Google callback: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to login with Google']);
        }
    }



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

    // đăng nhập bằng Zalo
    // public function handleZaloCallback(\Illuminate\Http\Request $request)
    // {
    //     $user = Socialite::driver('zalo')->user();
    //     // $phone = $user->user['phone'] ?? null; 
    //     $email = $user->email ?: uniqid() . '@zalo.com';
    //     $findUser = User::where('email', $user->email)->first();

    //     if ($findUser) {
    //         Auth::login($findUser);
    //     } else {
    //         $newUser = User::create([
    //             'name' => $user->name,
    //             // 'image_url' => $user->image_url,
    //             'email' => $email,
    //             'zalo_id' => $user->id, // Giữ zalo_id nếu cần cho các mục đích khác
    //             'password' => Hash::make(Str::random(16)),
    //             // 'phone' => $phone,
    //             'loginType' => 3,
    //             'role_id' => 3,
    //         ]);

    //         Auth::login($newUser);
    //     }
    //     // dd($newUser);
    //     return redirect()->intended('/');
    // }
    public function handleZaloCallback(\Illuminate\Http\Request $request)
    {
        $user = Socialite::driver('zalo')->user();

        // Thử lấy email và phone từ dữ liệu người dùng
        // $email = $user->email ?: uniqid() . '@zalo.com'; // Tạo email ngẫu nhiên nếu không có
        $email = $user->getEmail() ?: uniqid() . '@zalo.com';

        $phone = $user->user['phone'] ?? null; // Kiểm tra nếu có phone, nếu không thì để null
        

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


    // // upload image_url
    // public function userUpload1($data)
    // {
    //     // Xác thực dữ liệu đầu vào
    //     $validatedData = $data->validate([
    //         'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm xác thực cho thumbnail
    //         'title' => 'required|string|max:255', // Thêm xác thực cho title
    //         'video_url' => 'required|file|mimes:mp4,mov,avi,wmv|max:51200', // Xác thực cho video_url
    //     ]);

    //     // Xử lý tệp thumbnail
    //     $thumbnail = $validatedData['thumbnail'];
    //     $thumbnailName = $thumbnail->getClientOriginalName();
    //     $directory = 'Reels/Thumbnails';

    //     $disk = Storage::disk('google');

    //     if (!$disk->exists($directory)) {
    //         $disk->makeDirectory($directory);
    //     }

    //     $thumbnailPath = $directory . '/' . $thumbnailName;
    //     $disk->put($thumbnailPath, file_get_contents($thumbnail));
    //     $this->setFilePublic($disk, $thumbnailPath);
    //     $thumbnailMeta = $disk->getAdapter()->getMetadata($thumbnailPath)->extraMetadata()['id'];



    //     // Lưu thông tin vào cơ sở dữ liệu
    //     $video = new Reels();
    //     $video->user_id = auth()->id();
    //     $video->title = $validatedData['title'];
    //     $video->thumbnail = 'https://drive.google.com/file/d/' . $thumbnailMeta . '/preview';
    //     $video->video_url = 'https://drive.google.com/file/d/' . $videoMeta . '/preview';
    //     $video->save();

    //     return redirect()->back()->with('success', 'Video uploaded successfully!');
    // }
// UserRepository.php

public function restoreUser($id)
{
    // Khôi phục tài khoản người dùng
    $user = User::onlyTrashed()->findOrFail($id);
    $user->restore();
    return true; // Trả về true nếu khôi phục thành công
}

public function deleteUserForever($id)
{
    // Xóa tài khoản người dùng vĩnh viễn
    $user = User::onlyTrashed()->findOrFail($id);
    $user->forceDelete();
    return true; // Trả về true nếu xóa thành công
}

}
