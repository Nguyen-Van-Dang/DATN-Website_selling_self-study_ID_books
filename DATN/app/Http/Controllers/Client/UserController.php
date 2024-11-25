<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Course;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /*-------------------Admin-----------------*/
    public function getAllUserList()
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
        $popularBooks = Book::orderBy('views', 'desc')->take(6)->get();
        $popularCourses = Course::orderBy('views', 'desc')->take(6)->get();
        $favBook = Book::withCount('favorites')->orderByDesc('favorites_count')->limit(6)->get();
        $Book = Book::orderBy('created_at', 'desc')->limit(4)->get();
        foreach ($teachers as $teacher) {
            $teacher->total_courses = $teacher->courses ? $teacher->courses->count() : 0;
            $teacher->total_books = $teacher->books ? $teacher->books->count() : 0;
        }

        return view('client.home', compact('teachers', 'popularBooks', 'popularCourses', 'favBook', 'Book'));
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
    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function handleFacebookCallback(Request $request)
    // {
    //     return $this->userRepository->handleFacebookCallback($request);
    // }
    public function authProviderRedirect($provider)
    {
        if ($provider) {
            return Socialite::driver($provider)->redirect();
        }
    }
    public function socialAuthentication($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        dd($socialUser);
        $user = User::where('social_id', $socialUser->id)->first();

        if ($user) {
            Auth::login($user);
        } else {
            $userData = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('Password@1234'),
                'social_id' => $socialUser->id,
                'auth_provider' => $provider,
            ]);
            Auth::login($userData);
        }
        return redirect()->route('homeClient');
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
    public function showUser()
    {
        $user = auth::user();
        return view('client.user.userInformation', compact('user'));
    }
}
