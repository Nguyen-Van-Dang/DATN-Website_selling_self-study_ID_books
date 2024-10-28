<?php

namespace App\Livewire\Reels;

use Livewire\Component;
use Livewire\WithPagination;

class ReelsUpload1  extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.reels.render-reelsUpload1');
    }
}