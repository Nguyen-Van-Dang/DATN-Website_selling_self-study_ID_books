<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OtpMail extends Mailable
{
    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->view('emails.otp')
                ->with(['otp' => $this->otp])
                ->attach(public_path('assets/images/book/icon/small_logo_with_bg.png'), [
                    'as' => 'logo.png',
                    'mime' => 'image/png',
                ]);
    }
}
