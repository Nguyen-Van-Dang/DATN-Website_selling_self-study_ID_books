<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use Illuminate\Http\Request;
use App\Repositories\PasswordResetRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class ForgotPasswordController extends Controller
{
    protected $passwordResetRepository;

    // Inject Repository
    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    // Phương thức hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {

        $email = session('email'); // Lấy giá trị email từ session
        return view('admin.user.userInfo', compact('email')); // Đường dẫn đầy đủ đến view


    }
    public function showForgotPasswordForm1()
    {

        $email = session('email'); // Lấy giá trị email từ session
        return view('client.user.userInformation', compact('email')); // Đường dẫn đầy đủ đến view


    }
    public function showNewPasswordForm()
    {
        // Trả về view nhập mật khẩu mới với thông báo (nếu có)
        return view('new-password');
    }
    // Phương thức gửi mã OTP
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $email = $request->email;
        $this->passwordResetRepository->sendOtp($email);
        return redirect()->route('forgot-password')->with('email', $email)->with('message', 'OTP đã được gửi qua email!');
    }




    public function verifyOtp(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $email = $request->email;
        $otp = $request->otp;

        // Tìm OTP từ cơ sở dữ liệu
        $otpRecord = DB::table('password_resets')->where('email', $email)->where('token', $otp)->first();

        if (!$otpRecord) {
            return redirect()->back()->with('error', 'OTP không hợp lệ hoặc đã hết hạn!');
        }

        // Kiểm tra thời gian hết hạn của OTP
        if (now()->greaterThan($otpRecord->expires_at)) {
            return redirect()->back()->with('error', 'OTP đã hết hạn!');
        }

        // OTP hợp lệ và chưa hết hạn
        return redirect()->route('new-password-form')->with('message', 'OTP hợp lệ, bạn có thể đổi mật khẩu!');
    }






    // Phương thức thay đổi mật khẩu
    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $email = $request->email;
        $newPassword = $request->new_password;

        if ($this->passwordResetRepository->changePassword($email, $newPassword)) {
            // Đăng xuất người dùng sau khi thay đổi mật khẩu
            auth()->logout();

            return redirect()->back()->with('success', 'Mật khẩu đã được cập nhật thành công.');
        } else {

            return redirect()->back()->with('error', 'Không thể thay đổi mật khẩu!');
        }
    }

}
