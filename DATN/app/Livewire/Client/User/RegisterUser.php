<?php

namespace App\Livewire\Client\User;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterUser extends Component
{
    public $editingId;
    public $name;
    public $phone;
    public $email;
    public $password;
    public $password_confirmation;

    public function render()
    {
        return view('livewire.client.user.register-user');
    }

    public function handleRegister()
    {
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $this->editingId,
            'phone' => [
                'required',
                'numeric',
                'unique:users,phone,' . $this->editingId,
                'regex:/^0[0-9]{9}$/',
                'digits:10',
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]*$/',
                'min:6',
                'max:25',
            ],
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá 50 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống',
            'password.regex' => 'Mật khẩu ít nhất 1 chữ cái in hoa, 1 chữ cái thường, và có 1 số.',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 25 ký tự.',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có đúng 10 chữ số.',
            'phone.digits' => 'Số điện thoại phải có đúng 10 chữ số.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng, vui lòng chọn số khác.',
        ];

        // Validate dữ liệu
        $this->validate($rules, $messages);
        // Create a new user
        $user = User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => 3,
        ]);

        // Automatically log in the user
        Auth::login($user);

        // Redirect to the home page
        return redirect()->route('homeClient')->with('success', 'Đăng ký thành công!');
    }
}
