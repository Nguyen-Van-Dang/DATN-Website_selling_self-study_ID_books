<?php

namespace App\Livewire\CourseCate;

use App\Models\CourseCategories;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderCourseCate extends Component
{
    use WithPagination;


    public $name;
    // public $isPopupOpen = false;
    public $isAddPopupOpen = false;
public $isEditPopupOpen = false;
    public $editingId;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        if (Auth::user()->role_id == 1) {
            $courseCate = CourseCategories::paginate(10);
        } else {
            $courseCate = CourseCategories::where('user_id', Auth::id())->paginate(10);
        }
        return view('livewire.courseCate.render-courseCate', [
            'courseCate' => $courseCate,
        ]);

    }

    public function openPopup($type, $id = null)
    {
        if ($type === 'add') {
            $this->resetInput();
            $this->isAddPopupOpen = true;
        } elseif ($type === 'edit' && $id) {
            $this->editingId = $id;
            $courseCate = CourseCategories::find($id);
            $this->name = $courseCate->name;
            $this->isEditPopupOpen = true;
        }
    }

    public function closePopup()
    {
        $this->isAddPopupOpen = false;
        $this->isEditPopupOpen = false;

    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:course_categories,name,' . $this->editingId
        ]);
    }
    public function storeCourseCate()
    {
        $this->validate([
            'name' => 'required|unique:course_categories,name',
        ]);

        $courseCate = new CourseCategories();
        $courseCate->name = $this->name;
        $courseCate->save();
        session()->flash('message', 'Thêm thành công');
        $this->name = '';
        $this->isAddPopupOpen = false;
    }

    public function updateCourseCate()
    {
        $this->validate([
            'name' => 'required|unique:course_categories,name'
        ]);

        $courseCate = CourseCategories::find($this->editingId);
        $courseCate->name = $this->name;
        $courseCate->save();
        $this->isEditPopupOpen = false;
        session()->flash('message', 'Danh mục khóa học đã được cập nhật thành công.');
        $this->name = '';
        $this->editingId = null;
    }

    // Phương thức xóa danh mục
    public function delete($id)
    {
        $courseCate = CourseCategories::where('id', $id)->first();
        $courseCate->delete();

        session()->flash('message', 'Danh mục đã được xóa thành công.');
    }
}
