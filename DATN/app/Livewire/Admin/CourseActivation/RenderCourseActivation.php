<?php

namespace App\Livewire\Admin\CourseActivation;

use App\Models\CourseActivation;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RenderCourseActivation  extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $query = CourseActivation::query();

        // Tìm kiếm theo tên sách hoặc khóa học
        if (strlen($this->search) >= 1) {
            $query->whereHas('book', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('course', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        }

        // Kiểm tra quyền truy cập theo user_id nếu không phải admin
        if (Auth::user()->role_id !== 1) {
            $query->whereHas('book', function ($query) {
                $query->where('user_id', Auth::id());
            })->orWhereHas('course', function ($query) {
                $query->where('user_id', Auth::id());
            });
        }

        // Lấy dữ liệu các cặp sách và khóa học, nhóm chúng lại
        $courseActivations = $query->withCount('codes') // Đếm số lượng mã kích hoạt
            ->paginate(10);

        return view('livewire.admin.course-activation.render-course-activation', [
            'courseActivations' => $courseActivations,
        ]);
    }
}
