<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Course;
use App\Models\User;

class sidebar extends Component
{
    public $courses;
    public $teachers;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->courses = Course::limit(8)->get();
        $this->teachers = User::where('role_id', 2)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.sidebar', ['courses' => $this->courses]);
    }
}
