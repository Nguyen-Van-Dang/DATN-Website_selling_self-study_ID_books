<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChangedNotification extends Mailable
{
    use SerializesModels;

    public $user;

    /**
     * Tạo một thể hiện của thông báo
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Xây dựng thông báo email.
     *
     * @return \Illuminate\Contracts\Mail\Mailable
     */
    public function build()
    {
        return $this->view('emails.password_changed')
                    ->subject('Mật khẩu của bạn đã được thay đổi')
                    ->with([
                'name' => $this->user->name,
            ]);
    }
}
