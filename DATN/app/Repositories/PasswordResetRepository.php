<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordResetRepository
{
    // Gửi mã OTP
    public function sendOtp($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new \Exception('Email không tồn tại trong hệ thống!');
        }

        // Tạo mã OTP gồm 6 chữ số
        $otp = sprintf("%06d", mt_rand(0, 999999));

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $otp,
            'created_at' => Carbon::now(),
            'expires_at' => Carbon::now()->addMinutes(1)

        ]);

        // Gửi email chứa OTP cho người dùng
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($email) {
            $message->to($email)
                ->subject('Mã xác thực OTP');
        });
    }


    // Xác minh mã OTP
    public function verifyOtp($email, $otp)
    {
        // Tìm bản ghi OTP trong cơ sở dữ liệu
        $record = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $otp)
            ->first();

        // Kiểm tra giá trị của $record
        if (!$record) {
            return false; // Không tìm thấy bản ghi OTP
        }

        if ($record && Carbon::parse($record->expires_at)->isAfter(Carbon::now())) {
            return true; // OTP hợp lệ và chưa hết hạn
        }

        return false; // OTP không hợp lệ hoặc đã hết hạn
    }







    // Thay đổi mật khẩu
    public function changePassword($email, $newPassword)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        // Xóa thông tin mã OTP sau khi thay đổi mật khẩu
        DB::table('password_resets')->where('email', $email)->delete();

        $user->password = bcrypt($newPassword);
        $user->save();



        return true;
    }
}
