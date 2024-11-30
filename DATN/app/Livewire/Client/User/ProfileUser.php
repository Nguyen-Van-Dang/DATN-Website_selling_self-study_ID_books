<?php

namespace App\Livewire\Client\User;

use App\Jobs\UpdateFileJob;
use App\Jobs\UploadFileJob;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileUser extends Component
{
    use WithFileUploads;

    public $user, $name, $email, $phone, $gender, $image;

    public function mount()
    {
        $this->user = User::findOrFail(Auth::id());

        $this->name = $this->user->name;
        $this->email =  $this->user->email;
        $this->phone =  $this->user->phone;
        $this->gender = $this->user->sex;

        if ($this->user->images()->where('image_name', 'thumbnail')->first()) {
            $this->image = $this->user->images()->where('image_name', 'thumbnail')->first()->image_url;
        } else {
            $this->image = '';
        }
    }

    public function updateProfile()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:10',
            'gender' => 'nullable|in:0,1',
        ]);

        $user = User::findOrFail(Auth::id());

        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->sex = $this->gender;
        $user->save();
        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            $oldFile = $user->images()->where('image_name', 'thumbnail')->first();
            $folderId = '1yTTs0XKjped0ut_wTQ4riFPyxYv948A-';
            $filePath = $this->image->store('temp');

            if (isset($oldFile->image_url)) {
                UpdateFileJob::dispatch($user, $oldFile->image_url, $filePath, $folderId, 'thumbnail');
            } else {
                UploadFileJob::dispatch($user, $folderId, $filePath, 'thumbnail');
            }
        }
        return redirect()->route('userInformation')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function resetForm()
    {
        $user = Auth::user();

        // Reset form về dữ liệu ban đầu
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->gender = $user->gender;
        $this->image = null;
    }
    public function messages()
    {
        return [
            'name.required' => 'Họ và tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'phone.max' => 'Số điện thoại tối đa 10 ký tự.',
        ];
    }
    public function render()
    {
        return view('livewire.client.user.profile-user');
    }
}
