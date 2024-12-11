<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderDetail;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordChangedNotification;
use Exception;
use App\Mail\UserApprovedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Reels;

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
    public function getAllUserList()
    {
        return $this->userRepository->getAllUser();
    }
    /*-------------------Client-----------------*/
    public function changePassword(Request $request)
    {
        // Xác thực dữ liệu nhập vào
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8|confirmed',

        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại bằng Bcrypt
        if (!Hash::check($request->password, $user->password)) {

            return back()->with('error', 'Mật khẩu hiện tại không đúng. Vui lòng nhập lại');
        }

        // Đổi mật khẩu
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Gửi email thông báo thay đổi mật khẩu cho người dùng
        try {
            // Gửi email cho người dùng
            Mail::to($user->email)->send(new PasswordChangedNotification($user));

            // Gửi email cho admin thông báo thay đổi mật khẩu của người dùng
            $adminEmail = 'infobookstorefpt@gmail.com';
            Mail::to($adminEmail)->send(new PasswordChangedNotification($user));
        } catch (\Exception $e) {
            return back()->with('error', 'Mật khẩu đã được thay đổi, nhưng không thể gửi email thông báo.');
        }

        Auth::logout();
        return redirect()->route('handleLogin')->with('success', 'Mật khẩu đã được thay đổi thành công. Vui lòng đăng nhập lại với mật khẩu mới.');
    }
    public function HomeClient()
    {
        return view('client.home');
    }

    public function HomeAdmin()
    {
        $user = Auth::user();

        if ($user->role_id == 2) {
            $userCount = 1;
            $bookCount = Book::where('user_id', $user->id)->count();
            $orderCount = Order::where('user_id', $user->id)->count();
            $courseCount = course::where('user_id', $user->id)->count();

            $orders = Order::with('user')->where('user_id', $user->id)
                ->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get();

            $monthlyIncome = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->leftJoin('books', 'order_details.book_id', '=', 'books.id')
                ->leftJoin('courses', 'order_details.course_id', '=', 'courses.id')
                ->where('orders.payment_status', 3)
                ->whereMonth('orders.created_at', now()->month)
                ->whereYear('orders.created_at', now()->year)
                ->where(function ($query) use ($user) {
                    $query->where('books.user_id', $user->id)
                        ->orWhere('courses.user_id', $user->id);
                })
                ->sum(DB::raw('
                    (COALESCE(books.price, 0) * COALESCE(order_details.quantity, 0)) 
                    + 
                    (COALESCE(courses.price, 0) * COALESCE(order_details.quantity, 0))
                '));


            $bookSold = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('books', 'order_details.book_id', '=', 'books.id')
                ->where('orders.payment_status', 3)
                ->whereMonth('orders.created_at', now()->month)
                ->whereYear('orders.created_at', now()->year)
                ->whereNotNull('order_details.book_id')
                ->where('books.user_id', $user->id)
                ->sum('order_details.quantity');

            $courseSold = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('courses', 'order_details.course_id', '=', 'courses.id')
                ->where('orders.payment_status', 3)
                ->whereMonth('orders.created_at', now()->month)
                ->whereYear('orders.created_at', now()->year)
                ->whereNotNull('order_details.course_id')
                ->where('courses.user_id', $user->id)
                ->sum('order_details.quantity');

            $sales = DB::table('orders')
                ->select(
                    DB::raw('DAYOFWEEK(orders.created_at) as day_of_week'),
                    DB::raw('SUM(order_details.quantity * books.price) as total_sales_books'),
                    DB::raw('SUM(order_details.quantity * courses.price) as total_sales_courses')
                )
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->leftJoin('books', 'order_details.book_id', '=', 'books.id')
                ->leftJoin('courses', 'order_details.course_id', '=', 'courses.id')
                ->where('orders.payment_status', 3)
                ->whereMonth('orders.created_at', now()->month)
                ->where(function ($query) {
                    $query->whereNotNull('order_details.book_id')
                        ->orWhereNotNull('order_details.course_id');
                })
                ->where(function ($query) {
                    $query->where('books.user_id', Auth::user()->id)
                        ->orWhere('courses.user_id', Auth::user()->id);
                })
                ->groupBy(DB::raw('DAYOFWEEK(orders.created_at)'))
                ->get();

            $dailySales = [0, 0, 0, 0, 0, 0, 0];
            foreach ($sales as $sale) {
                $dailySales[$sale->day_of_week - 1] = $sale->total_sales_books + $sale->total_sales_courses;
            }
        } else {
            $userCount = User::count();
            $bookCount = Book::count();
            $orderCount = Order::count();
            $courseCount = course::count();

            $orders = Order::with('user')->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get();

            $sales = DB::table('orders')->select(DB::raw('DAYOFWEEK(created_at) as day_of_week'), DB::raw('SUM(price) as total_sales'))
                ->whereMonth('created_at', now()->month)
                ->where('payment_status', 3)
                ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
                ->get();

            $dailySales = [0, 0, 0, 0, 0, 0, 0];
            foreach ($sales as $sale) {
                $dailySales[$sale->day_of_week - 1] = $sale->total_sales;
            }

            $monthlyIncome = Order::where('payment_status', 3)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('price');

            $bookSold = DB::table('order_details')->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.payment_status', 3)
                ->whereMonth('orders.created_at', now()->month)
                ->whereYear('orders.created_at', now()->year)
                ->whereNotNull('order_details.book_id')
                ->sum('order_details.quantity');

            $courseSold = DB::table('order_details')->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.payment_status', 3)
                ->whereMonth('orders.created_at', now()->month)
                ->whereYear('orders.created_at', now()->year)
                ->whereNotNull('order_details.course_id')
                ->sum('order_details.quantity');
        }
        return view('admin.home', compact(
            'userCount',
            'bookCount',
            'orders',
            'orderCount',
            'courseCount',
            'monthlyIncome',
            'bookSold',
            'courseSold',
            'dailySales',
        ));
    }

    //render course, book, reel
    public function showUserDetail($userId)
    {
        $user = auth::user();
        $courses = Course::where('user_id', $user->id)->get();
        $books = Book::where('user_id', $user->id)->where('status', 0)->get();
        $reels = Reels::where('user_id', $user->id)->get();

        $users = User::with(['books', 'courses', 'reels'])->findOrFail($userId);
        $totalFollowers = $users->followers->count();
        $totalViews =
            $users->books->sum('views') +
            $users->courses->sum('views') +
            $users->reels->sum('views_count');
        $isFollowing = $user ? $user->followings()->where('following_id', $users->id)->exists() : false;

        return view('client.user.userDetail', compact('user', 'books', 'courses', 'reels', 'users', 'totalViews', 'totalFollowers', 'isFollowing'));
    }
    
    public function updateDescription(Request $request)
    {
        $data = $request->all();
        $user = auth::user();
        $user->description = nl2br(e($data['user_description']));
        $userId = $request->input('userId');
        $user = User::findOrFail($userId);
        $user->description = nl2br(e($request->input('user_description')));
        $user->save();

        return redirect()->route('userDetail', ['userId' => $user->id])->with('success', 'Mô tả đã được cập nhật thành công');
    }
    public function toggleFollow($userId)
    {
        $followingUser  = User::findOrFail($userId);
        $follower = Auth::user();
        if (!$follower) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập!'], 401);
        }

        $follow = $follower->followings()->where('following_id', $followingUser->id)->first();
            $is_following = true;

        $new_follower_count = $followingUser->followers()->count();

        return response()->json([
            'success' => true,
            'is_following' => $is_following,
            'new_follower_count' => $new_follower_count,
        ]);
    }

    public function logout(Request $request)
    {
        return $this->userRepository->logout($request);
    }
    // public function handleLogin(Request $request)
    // {
    //     return $this->userRepository->loginUser($request);
    // }
    // public function handleRegister(Request $request)
    // {
    //     return $this->userRepository->registerUser($request);
    // }
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
