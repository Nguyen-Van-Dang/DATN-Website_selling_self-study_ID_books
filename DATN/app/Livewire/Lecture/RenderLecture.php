<?php

namespace App\Livewire\Lecture;

use App\Models\Lecture;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderLecture  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (Auth::user()->role_id == 1) {
            $Lecture = Lecture::paginate(10);
        } else {
            $Lecture = Lecture::where('user_id', Auth::id())->paginate(10);
        }
        return view('livewire.lecture.render-lecture', [
            'Lecture' => $Lecture,
        ]);
    }
}