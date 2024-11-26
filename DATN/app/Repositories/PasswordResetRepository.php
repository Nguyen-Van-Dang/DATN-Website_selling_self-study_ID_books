<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        // Lưu mã OTP vào database (tạo bảng password_resets nếu cần thiết)
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $otp,
            'created_at' => Carbon::now(),
            'expires_at' => now()->addMinutes(1) // Thời gian hết hạn 1 phút
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
        $record = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $otp)
            ->first();

        if (!$record || Carbon::parse($record->created_at)->addMinutes(10)->isPast()) {
            return false; // OTP không hợp lệ hoặc đã hết hạn
        }

        return true;
    }

    // Thay đổi mật khẩu
    public function changePassword($email, $newPassword)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        $user->password = bcrypt($newPassword);
        $user->save();

        // Xóa thông tin mã OTP sau khi thay đổi mật khẩu
        DB::table('password_resets')->where('email', $email)->delete();

        return true;
    }
}
