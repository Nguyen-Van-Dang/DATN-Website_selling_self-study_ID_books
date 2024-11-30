<?php

namespace App\Livewire\Client\Course;

use Livewire\Component;
use App\Models\EnrollCourse;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class MyCourse extends Component
{
    public $enrolledCourses = [];
    public $selectedClass = null;
    public $selectedSubject = null;

    public function mount()
    {
        $this->loadCourses();
    }

    public function loadCourses()
    {
        $query = EnrollCourse::with(['course' => function ($query) {
            $query->withCount('lectures'); // Đếm số bài giảng
        }])
            ->where('user_id', Auth::id());

        // Lọc theo class_id (lớp học)
        if ($this->selectedClass) {
            $query->whereHas('course', function ($query) {
                $query->where('class_id', $this->selectedClass);
            });
        }

        // Lọc theo subject_id (môn học)
        if ($this->selectedSubject) {
            $query->whereHas('course', function ($query) {
                $query->where('subject_id', $this->selectedSubject);
            });
        }

        $this->enrolledCourses = $query->get();
    }

    public function filterByClass($classId = null)
    {
        $this->selectedClass = $classId;
        $this->loadCourses();
    }

    public function filterBySubject($subjectId = null)
    {
        $this->selectedSubject = $subjectId;
        $this->loadCourses();
    }

    public function render()
    {
        return view('livewire.client.course.my-course', [
            'courses' => $this->enrolledCourses,
        ]);
    }
}
