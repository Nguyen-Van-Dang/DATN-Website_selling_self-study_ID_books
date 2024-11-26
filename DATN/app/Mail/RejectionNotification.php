<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\User; 
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectionNotification extends Mailable
{
    use SerializesModels;

    public $user;



    // Constructor nhận người dùng
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // Xây dựng email thông báo từ chối
        return $this->subject('Thông báo từ chối duyệt tài khoản')
                    ->view('emails.rejection-notification') // View chứa nội dung email
                    ->with([
                        'name' => $this->user->name,
                    ]);
    }
}
