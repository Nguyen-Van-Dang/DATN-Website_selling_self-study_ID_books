<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderCourse  extends Component
{
    use WithPagination;
    public $editingId, $deletedId, $search='';
    public $isEditPopupOpen = false;
    public $isDeletePopupOpen = false;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (strlen($this->search) >= 1) {
            $Course = Course::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', $this->search)
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            if (Auth::user()->role_id == 1) {
                $Course = Course::paginate(10);
            } else {
                $Course = Course::where('user_id', Auth::id())->paginate(10);
            }
        }

        return view('livewire.course.render-course', [
            'Course' => $Course,
        ]);
    }
    public function openPopup($type, $id = null)
    {
        $this->deletedId = null;
        if ($type === 'edit' && $id) {
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
