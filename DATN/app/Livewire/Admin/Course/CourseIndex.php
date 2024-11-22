<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CourseIndex extends Component
{
    use WithPagination;

    public $editingId, $deletedId, $search = '';
    public $isAddPopupOpen = false;
    public $isEditPopupOpen = false;
    public $isDeletePopupOpen = false;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Kiểm tra nếu có từ khóa tìm kiếm
        if (strlen($this->search) >= 1) {
            // Nếu người dùng là quản trị viên (role_id == 1)
            if (Auth::user()->role_id == 1) {
                $Course = Course::withCount('lectures')
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', $this->search)
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->paginate(10);
            } else {
                // Người dùng thông thường chỉ tìm kiếm khóa học của chính họ
                $Course = Course::withCount('lectures')
                    ->where('user_id', Auth::id())
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
                $Course = Course::withCount('lectures')->paginate(10);
            } else {
                $Course = Course::withCount('lectures')
                    ->where('user_id', Auth::id())
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
        if ($type === 'add') {
            $this->isAddPopupOpen = true;
        } elseif ($type === 'edit' && $id) {
            $this->editingId = $id;
            $Course = Course::find($id);
            if ($Course) {
                // $this->name = $Course->name;
                // $this->description = $Course->description;
            }
            $this->isEditPopupOpen = true;
        } elseif ($type === 'delete' && $id) {
            $this->deletedId = $id;
            $this->isDeletePopupOpen = true;
        }
    }
    public function closePopup()
    {
        $this->isEditPopupOpen = false;
        $this->isDeletePopupOpen = false;
    }
    public function deleted()
    {
        $Course = Course::find($this->deletedId);

        if ($Course) {
            $Course->delete();
            session()->flash('message', 'Danh mục đã được xóa thành công.');
        } else {
            session()->flash('error', 'Danh mục không tồn tại.');
        }

        $this->closePopup();
    }
}
