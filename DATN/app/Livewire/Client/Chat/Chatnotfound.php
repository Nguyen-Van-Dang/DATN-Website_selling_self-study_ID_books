<?php

namespace App\Livewire\Client\Chat;

use App\Jobs\UploadFileJob;
use App\Models\ChatGroup;
use App\Models\ChatParticipant;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Chatnotfound extends Component
{
    use WithFileUploads;
    public $courses, $groupName, $groupDescription, $groupCourse, $groupImage;

    public function mount()
    {
        $this->courses = Course::where('user_id', '=', Auth::id())->get();
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'groupName' => 'required',
            'groupDescription' => 'required',
            'groupCourse' => 'required',
            'groupImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'groupName.required' => 'Vui lòng nhập tên nhóm',
            'groupDescription.required' => 'Ghi rõ mô tả cho nhóm',
            'groupCourse.required' => 'Chọn một khoá học đại diện',
            'groupImage.image' => 'Hình ảnh không hợp lệ',
            'groupImage.mimes' => 'Chỉ chấp nhận định dạng JPG, JPEG, PNG',
            'groupImage.max' => 'Dung lượng hình ảnh tối đa là 2MB',
        ]);
        $createGroup = new ChatGroup;
        $createGroup->name = $this->groupName;
        $createGroup->description = $this->groupDescription;
        $createGroup->course_id = $this->groupCourse;
        $createGroup->save();

        $createMember = new ChatParticipant;
        $createMember->user_id = Auth::id();
        $createMember->group_id = $createGroup->id;
        $createMember->role = 1;
        $createMember->save();

        if ($this->groupImage) {
            $folderId = '1ccvEGR7O8_BIV5X6Kq4CSct6VviDckUz';
            $filePath = $this->groupImage->store('temp');
            UploadFileJob::dispatch($createGroup, $folderId, $filePath, 'thumbnail');
        }

        return redirect()->route('chat')->with('success', 'Tạo nhóm chat thành công.');
    }

    public function render()
    {
        return view('livewire.client.chat.chatnotfound');
    }
}
