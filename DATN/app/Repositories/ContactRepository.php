<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
// use Illuminate\Support\Facades\Mail;

class ContactRepository
{
    public function store($data)
    {
        // Tìm liên hệ gần nhất dựa trên email
        $recentContact = Contact::where('email', $data['email'])->latest('created_at')->first();
        // Tạo hoặc cập nhật liên hệ
        return Contact::create($data);
    }
}