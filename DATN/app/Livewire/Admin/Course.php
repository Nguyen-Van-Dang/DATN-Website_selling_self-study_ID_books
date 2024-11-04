<?php

namespace App\Livewire\Admin;

use App\Models\Courses;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Course extends Component
{
    use WithPagination;

    public $editingId, $deletedId, $search = '';
    public $isAddPopupOpen = false;
    public $isEditPopupOpen = false;
    public $isDeletePopupOpen = false;
    protected $paginationTheme = 'bootstrap';

    // public function render()
    // {
    //     if (strlen($this->search) >= 1) {
    //         $Course = Courses::where('name', 'like', '%' . $this->search . '%')
    //             ->orWhere('id', $this->search)
    //             ->orWhereHas('user', function ($query) {
    //                 $query->where('name', 'like', '%' . $this->search . '%');
    //             })
    //             ->paginate(10);
    //     } else {
    //         if (Auth::user()->role_id == 1) {
    //             $Course = Courses::paginate(10);
    //         } else {
    //             $Course = Courses::where('user_id', Auth::id())->paginate(10);
    //         }
    //     }
    //     $hasTempData = session()->has('course_name') || session()->has('course_description');
    //     return view('livewire.admin.course', compact('hasTempData'), [
    //         'Course' => $Course,
    //     ]);
    // }

    public function render()
    {
        if (strlen($this->search) >= 1) {
            $Course = Courses::with('media') // Tải các tệp liên quan tới khóa học
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', $this->search)
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            if (Auth::user()->role_id == 1) {
                $Course = Courses::with('media')->paginate(10); // Tải các tệp cho tất cả khóa học
            } else {
                $Course = Courses::with('media')->where('user_id', Auth::id())->paginate(10); // Tải các tệp cho khóa học của người dùng
            }
        }

        $hasTempData = session()->has('course_name') || session()->has('course_description');

        return view('livewire.admin.course', [
            'hasTempData' => $hasTempData,
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
            $Course = Courses::find($id);
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
        $Course = Courses::find($this->deletedId);

        if ($Course) {
            $Course->delete();
            session()->flash('message', 'Danh mục đã được xóa thành công.');
        } else {
            session()->flash('error', 'Danh mục không tồn tại.');
        }

        $this->closePopup();
    }
}
