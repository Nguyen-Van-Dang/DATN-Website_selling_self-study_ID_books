<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use Illuminate\Http\Request;
use App\Repositories\PasswordResetRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    protected $passwordResetRepository;

    // Inject Repository
    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    // Phương thức hiển thị form quên mật khẩu
    // public function showForgotPasswordForm()
    // {

    //     $email = session('email'); // Lấy giá trị email từ session
    //     return view('admin.user.userInfo', compact('email')); // Đường dẫn đầy đủ đến view


    // }
    // public function showForgotPasswordForm1()
    // {

    //     $email = session('email'); // Lấy giá trị email từ session
    //     return view('client.user.userInformation', compact('email')); // Đường dẫn đầy đủ đến view


    // }
    public function showForgotPasswordFormLogin()
    {
        $email = session('email');
        // Lưu email vào session trước khi gửi OTP
        // session(['email' => $request->email]);

        return view('client.user.pagePassword', compact('email')); // Đường dẫn đầy đủ đến view
    }

    public function showNewPasswordForm()
    {
        // Trả về view nhập mật khẩu mới với thông báo (nếu có)
        return view('new-password');
    }
    // Phương thức gửi mã OTP
    public function sendOtp(Request $request, PasswordResetRepository $repository)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Lưu email vào session để dùng trong các bước tiếp theo
        session(['email' => $request->email]);
        try {
            $repository->sendOtp($request->email);  // pass $request->email here
            return redirect()->route('forgot-passwordLogin')->with([
                'success' => 'Mã OTP đã được gửi tới email của bạn!',
                'step' => 'otp'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function verifyOtp(Request $request, PasswordResetRepository $repository)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric', // Kiểm tra OTP là số
        ]);

        if (empty($request->email) || empty($request->otp)) {
            return redirect()->back()->with('error', 'Vui lòng nhập đầy đủ thông tin.');
        }

        $isOtpValid = $repository->verifyOtp($request->email, $request->otp);

        if ($isOtpValid) {
            session(['email' => $request->email]);
            return redirect()->route('forgot-passwordLogin')->with([
                'success' => 'Xác minh thành công, hãy đặt lại mật khẩu.',
                'step' => 'password',
            ]);
        }

        return redirect()->back()->with('error', 'Mã OTP không hợp lệ hoặc đã hết hạn.');
    }







    public function changePassword(Request $request, PasswordResetRepository $repository)
    {
        // Lấy email từ session
        $email = session('email');

        if (!$email) {
            return redirect()->route('forgot-passwordLogin')->with('error', 'Email không hợp lệ hoặc đã hết hạn.');
        }

        // Cập nhật mật khẩu người dùng
        $isPasswordChanged = $repository->changePassword($email, $request->new_password);

        if ($isPasswordChanged) {
            // Xóa email khỏi session sau khi đổi mật khẩu
            session()->forget('email');

            return redirect()->route('homeClient')->with('success', 'Mật khẩu của bạn đã được thay đổi thành công.');
        }

        return redirect()->route('forgot-passwordLogin')->with('error', 'Có lỗi xảy ra khi thay đổi mật khẩu.');
    }
}
