<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required'
    ];

    public function render()
    {
        return view('livewire.contact.contact-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName); // Chỉ validate khi cập nhật
    }

    public function send()
    {
        // Xác thực dữ liệu
        $validatedData = $this->validate();

        try {
            // Gửi email
            Mail::to('infobookstorefpt@gmail.com')->send(new ContactUsMail($validatedData));

            // Hiển thị thông báo thành công
            session()->flash('message', 'Bạn đã gửi thông tin liên hệ thành công !!');
        } catch (\Throwable $th) {
            // Hiển thị thông báo thất bại
            session()->flash('message', 'Bạn đã gửi thông tin liên hệ thất bại !!');
        }

        // Reset form
        $this->reset();
    }
}
