<?php

namespace App\Livewire\Admin\Course;


use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Course;

class CourseDeleted extends Component
{
    public function render()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();
    
        if ($user->role_id == 1) {
            // Nếu là quản trị viên (role_id == 1), hiển thị tất cả các khóa học đã bị xóa
            $courseDeleted = Course::onlyTrashed()->get();
        } else {
            // Nếu là người dùng thông thường (role_id == 2), chỉ hiển thị khóa học của chính họ đã bị xóa
            $courseDeleted = Course::onlyTrashed()
                ->where('user_id', $user->id)
                ->get();
        }
    
        return view('livewire.admin.course.course-deleted', ['courseDeleted' => $courseDeleted]);
    }
    
}
