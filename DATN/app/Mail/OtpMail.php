<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    // Khởi tạo OTP
    public function __construct($otp)
    {
        $this->otp = $otp;

    }

    // Build email
    public function build()
    {
        return $this->view('emails.otp')
                    ->subject('Mã OTP để thay đổi mật khẩu, mã này có thời gian sử dụng là 60s !!!')
                    ->with('otp', $this->otp);
    }
}
