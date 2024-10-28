<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderCourse  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (Auth::user()->role_id == 1) {
            $Course = Course::paginate(10);
        } else {
            $Course = Course::where('user_id', Auth::id())->paginate(10);
        }
        return view('livewire.course.render-course', [
            'Course' => $Course,
        ]);
    }
}