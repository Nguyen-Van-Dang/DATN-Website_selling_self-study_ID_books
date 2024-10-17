<?php

namespace App\Livewire\CourseCate;

use App\Models\CategoryCourse;
use Livewire\Component;
use Livewire\WithPagination;

class RenderCourseCate extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $courseCate = CategoryCourse::paginate(5);

        return view('livewire.courseCate.render-courseCate', [
            'courseCate' => $courseCate,
        ]);
    }
}