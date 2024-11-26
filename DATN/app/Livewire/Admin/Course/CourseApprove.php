<?php

namespace App\Livewire\Admin\Course;

use Livewire\Component;
use App\Models\Course;
class CourseApprove extends Component
{

    public function render()
    {
        $courses = Course::where('status', 1)->get();
        return view('livewire.admin.course.course-approve', ['courses' => $courses]);
    }
}
