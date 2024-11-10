<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Flasher\Toastr\Laravel\Facades\Toastr;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /*-------------------Admin-----------------*/
    public function index()
    {
        return $this->userRepository->getAllUser();
    }
    // public function changePassword(Request $request)
    // {
    //     try {
    //         $this->userRepository->changePassword($request);
    //         return back()->with('success', 'Đổi mật khẩu thành công');
    //     } catch (ValidationException $e) {
    //         return back()->withErrors($e->errors());
    //     }
    // }

    /*-------------------Client-----------------*/
    public function HomeClient()
    {
        $teachers = User::where('role_id', 2)->with(['courses', 'books'])->get();

        foreach ($teachers as $teacher) {
            $teacher->total_courses = $teacher->courses ? $teacher->courses->count() : 0;
            $teacher->total_books = $teacher->books ? $teacher->books->count() : 0;
        }

        return view('client.home', compact('teachers'));
    }
    //render course, book, reel
    public function showUserDetail()
    {
        $user = auth::user();

        $courses = $user->courses ?: [];
        $books = $user->books ?: [];
        $reels = $user->reels ?: [];

        return view('client.user.userDetail', compact('user', 'books', 'courses', 'reels'));
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

    public function destroy($id)
    {
        $this->userRepository->softDelete($id);
        return redirect()->back();
    }
    public function getDestroyUser()
    {
        return $this->userRepository->getDeletedUser();
    }
    public function redirectToZalo()
    {
        return Socialite::driver('zalo')
            ->scopes(['email', 'phone']) // Thêm phạm vi quyền
            ->redirect();
    }
    public function handleZaloCallback(Request $request)
    {
        return $this->userRepository->handleZaloCallback($request);
    }
    public function updateUser()
    {
        return $this->userRepository->updateUser();
    }
    public function showUser()
    {
        $user = auth::user();
        return view('client.user.userInformation', compact('user'));
    }
}
