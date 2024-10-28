<?php

namespace App\Livewire\CourseCate;

use App\Models\CourseCategories;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderCourseCate extends Component
{
    use WithPagination;
    public $name, $nameAdd, $description, $descriptionAdd, $editingId, $search = '';
    public $isAddPopupOpen = false;
    public $isEditPopupOpen = false;
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        if (strlen($this->search) >= 1) {
            $courseCate = CourseCategories::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', $this->search)
                ->orWhereHas('user', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            if (Auth::user()->role_id == 1) {
                $courseCate = CourseCategories::paginate(10);
            } else {
                $courseCate = CourseCategories::where('user_id', Auth::id())->paginate(10);
            }
        }

        return view('livewire.courseCate.render-courseCate', [
            'courseCate' => $courseCate,
        ]);
    }

    public function openPopup($type, $id = null)
    {
        if ($type === 'add') {
            // $this->resetInput();
            $this->isAddPopupOpen = true;
        } elseif ($type === 'edit' && $id) {
            $this->editingId = $id;
            $courseCate = CourseCategories::find($id);
            $this->name = $courseCate->name;
            $this->description = $courseCate->description;
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
            'nameAdd' => 'required|unique:course_categories,name',
            'descriptionAdd' => 'required|unique:course_categories,descriptionAdd',
        ]);

        $courseCate = new CourseCategories();
        $courseCate->name = $this->nameAdd;
        $courseCate->description = $this->descriptionAdd;
        $courseCate->user_id = auth()->id();
        $courseCate->save();

        session()->flash('message', 'Thêm thành công');
        $this->nameAdd = '';
        $this->descriptionAdd = '';
        $this->isAddPopupOpen = false;
    }

    public function updateCourseCate()
    {
        $this->validate([
            'name' => 'required|unique:course_categories,name',
            'description' => 'required|unique:course_categories,description',
        ]);

        $courseCate = CourseCategories::find($this->editingId);
        $courseCate->name = $this->name;
        if (isset($this->description)) {
            $courseCate->description = $this->description;
        }
        $courseCate->description = $this->description;
        $courseCate->user_id = auth()->id();
        $courseCate->save();
        $this->isEditPopupOpen = false;

        session()->flash('message', 'Danh mục khóa học đã được cập nhật thành công.');
        $this->name = '';
        $this->description = '';
        $this->editingId = null;
    }
    public function delete($id)
    {
        $courseCate = CourseCategories::where('id', $id)->first();
        $courseCate->delete();

        session()->flash('message', 'Danh mục đã được xóa thành công.');
    }
}
