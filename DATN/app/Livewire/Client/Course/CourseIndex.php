<?php

namespace App\Livewire\Client\Course;

use Livewire\Component;
use App\Models\Course;
use App\Models\User;
use Livewire\WithPagination;

class CourseIndex extends Component
{
    use WithPagination;

    public $courseList;
    public $courseTrending;
    public $popularCourses;
    public $teachers;
    public $date_filter = 'latest';
    public $price_filter = null;
    public $teacher_filter = null;
    public $name_filter = '';

    public function updated($propertyName)
    {
        $this->loadCourses();
    }

    public function mount()
    {
        $this->popularCourses = Course::orderBy('views', 'desc')->take(6)->get();
        $this->teachers = User::where('role_id', 2)->get();
        $this->courseTrending = Course::limit(12)->get();
        $this->loadCourses();
    }

    public function loadCourses()
    {
        $query = Course::query();

        if (strlen($this->name_filter) >= 1) {
            $query->where('name', 'like', '%' . $this->name_filter . '%')
                ->orWhere('id', $this->name_filter)
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->name_filter . '%');
                });
        }

        if ($this->teacher_filter) {
            $query->where('user_id', $this->teacher_filter);
        }

        if ($this->price_filter) {
            $query->orderBy('price', $this->price_filter);
        }

        if ($this->date_filter === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($this->date_filter === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        $this->courseList = $query->get();
    }

    public function goToCourseDetail($id)
    {
        return redirect()->route('khoa-hoc.show', $id);
    }

    public function render()
    {
        return view('livewire.client.course.course-index', [
            'courses' => $this->courseList,
            'teachers' => $this->teachers,
            'courseTrending' => $this->courseTrending,
            'popularCourses' => $this->popularCourses,
        ]);
    }
}
