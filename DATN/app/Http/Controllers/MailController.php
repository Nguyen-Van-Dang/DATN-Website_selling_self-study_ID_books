<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Mail\OrderMail;
use App\Mail\ContactMail;

class MailController extends Controller
{
    public function SendEmail()
    {
        $mailData = [
            'name' => env('MAIL_FROM_NAME'),
            'title' => 'Mail from Website khóa học BookStore',
            'body' => 'Đây là nội dung của mail',
            'user' => env('MAIL_FROM_ADDRESS'),

        ];
        Mail::to('infoBookStoreFpt@gmail.com')->send(new DemoMail($mailData));
    }
    public function orderMail($orderEmail)
    {
        $mailData = [
            'name' => env('MAIL_FROM_NAME'),
            'title' => 'Mail from Website khóa học BookStore',
            'body' => 'Đây là nội dung của mail',
            'user' => env('MAIL_FROM_ADDRESS'),
        ];
    
        Mail::to($orderEmail)->send(new OrderMail($mailData));
    }
    public function contactMail($email)
    {
        $mailData = [
            'name' => env('MAIL_FROM_NAME'),
            'title' => 'Mail from Website khóa học BookStore',
            'body' => 'Đây là nội dung của mail',
            'user' => $email,
        ];

        Mail::to($email)->send(new ContactMail($mailData));
    }
    
}
