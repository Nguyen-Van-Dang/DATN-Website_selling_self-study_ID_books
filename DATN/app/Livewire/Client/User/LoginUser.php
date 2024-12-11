<?php

namespace App\Livewire\Client\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginUser extends Component
{
    public $phone;
    public $password;

    public function render()
    {
        return view('livewire.client.user.login-user');
    }

    public function handleLogin()
    {
        $rules = [
            'phone' => [
                'required',
                'numeric',
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
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có đúng 10 chữ số.',
            'phone.digits' => 'Số điện thoại phải có đúng 10 chữ số.',
            'password.regex' => 'Mật khẩu ít nhất 1 chữ cái in hoa, 1 chữ cái thường, và có 1 số.',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 25 ký tự.',

        ];

        $this->validate($rules, $messages);
        $user = \App\Models\User::where('phone', $this->phone)->first();

        if ($user) {
            if ($user->active == 1) {
                $this->addError('loginError', 'Tài khoản của bạn đang bị khóa.');
                return;
            }
        
            if (Auth::attempt(['phone' => $this->phone, 'password' => $this->password])) {
                return redirect()->route('homeClient')->with('success', 'Đăng nhập thành công!');
            }
        }
        
        $this->addError('loginError', 'Số điện thoại hoặc mật khẩu không đúng.');
    }
}
