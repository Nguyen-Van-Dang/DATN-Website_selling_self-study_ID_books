<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CourseIndex extends Component
{
    use WithPagination;

    public $deletedId, $search = '';
    public $isDeletePopupOpen = false;
    public $isEditPopupOpen = false;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Kiểm tra nếu có từ khóa tìm kiếm
        if (strlen($this->search) >= 1) {
            // Nếu người dùng là quản trị viên (role_id == 1)
            if (Auth::user()->role_id == 1) {
                $Course = Course::withCount('lectures')
                    ->where('status', '!=', 1) // Loại bỏ các khóa học có status = 0
                    ->where(function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('id', $this->search)
                            ->orWhereHas('user', function ($query) {
                                $query->where('name', 'like', '%' . $this->search . '%');
                            });
                    })
                    ->paginate(10);
            } else {
                // Người dùng thông thường chỉ tìm kiếm khóa học của chính họ
                $Course = Course::withCount('lectures')
                    ->where('user_id', Auth::id())
                    ->where('status', '!=', 1) // Loại bỏ các khóa học có status = 0
                    ->where(function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('id', $this->search)
                            ->orWhereHas('user', function ($q) {
                                $q->where('name', 'like', '%' . $this->search . '%');
                            });
                    })
                    ->paginate(10);
            }
        } else {
            // Nếu không có từ khóa tìm kiếm
            if (Auth::user()->role_id == 1) {
                $Course = Course::withCount('lectures')
                    ->where('status', '!=', 1) // Loại bỏ các khóa học có status = 0
                    ->paginate(10);
            } else {
                $Course = Course::withCount('lectures')
                    ->where('user_id', Auth::id())
                    ->where('status', '!=', 1) // Loại bỏ các khóa học có status = 0
                    ->paginate(10);
            }
        }
    
        $hasTempData = session()->has('course_name') || session()->has('course_description');
    
        return view('livewire.admin.course.course-index', compact('hasTempData'), [
            'Course' => $Course,
        ]);
    }    

    public function openPopup($type, $id = null)
    {
        $this->deletedId = null;
        if ($type === 'delete' && $id) {
            $this->deletedId = $id;
            $this->isDeletePopupOpen = true;
        }
    }
    public function closePopup()
    {
        $this->isDeletePopupOpen = false;
    }
    public function deleted()
    {
        $Course = Course::find($this->deletedId);

        if ($Course) {
            $Course->delete();
            return redirect('admin/khoa-hoc')->with('success', 'Xóa khóa học thành công!');
        } else {
            session()->flash('error', 'Danh mục không tồn tại.');
        }

        $this->closePopup();
    }
}
