<?php

namespace App\Livewire\Component;

use App\Models\ChatGroup;
use App\Models\Course;
use App\Models\EnrollCourse;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RenderSidebar extends Component
{
    public $books, $courses, $allTeacher, $teachers, $chatGroups;
    public $limit = 5;

    public function mount()
    {
        $this->getContent();
    }

    public function getContent()
    {
        if (Auth::user()) {
            if (Auth::user()->role_id == 3) {
                $this->courses = Course::whereHas('enrollments', function ($query) {
                    $query->where('user_id', Auth::id());
                })->get();
            } else if (Auth::user()->role_id == 2) {
                $this->courses = Course::where('user_id', Auth::id())->where('status', 0)->get();
            } else if (Auth::user()->role_id == 1) {
                $this->courses = Course::where('status', 0)->get();
            }
        } else {
            $this->courses = null;
        }

        $this->books = Favorite::where('user_id', Auth::id())
            ->with('book')
            ->get()
            ->map(function ($favorite) {
                return $favorite->book;
            });

        $this->loadTeachers();
        // $this->books = Favorite::

        $this->chatGroups = ChatGroup::whereHas('participants', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
    }

    public function loadTeachers()
    {
        $this->allTeacher = User::where('role_id', 2)->where('active', 0)->get();
        $this->teachers = User::where('role_id', 2)->where('active', 0)->take($this->limit)->get();
    }

    public function loadMore()
    {
        $this->limit += 5;
        $this->loadTeachers();
    }

    public function render()
    {
        return view('livewire.component.render-sidebar');
    }
}
