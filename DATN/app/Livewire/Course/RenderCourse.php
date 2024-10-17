<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class RenderCourse  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $Course = Course::paginate(5);

        return view('livewire.course.render-course', [
            'Course' => $Course,
        ]);
    }
}