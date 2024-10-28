<?php

namespace App\Livewire\CourseCate;

use App\Models\CategoryCourse;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderCourseCate extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (Auth::user()->role_id == 1) {
            $courseCate = CategoryCourse::paginate(10);
        } else {
            $courseCate = CategoryCourse::where('user_id', Auth::id())->paginate(10);
        }
        return view('livewire.courseCate.render-courseCate', [
            'courseCate' => $courseCate,
        ]);

    }
}