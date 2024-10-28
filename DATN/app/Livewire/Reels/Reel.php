<?php

namespace App\Livewire\Reels;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reels;
use App\Models\ReelComment;

class Reel extends Component
{
    use WithPagination;

    public $comments = [];
    public $selectedReelId = null;

    // Hàm load bình luận theo reels_id
    public function loadComments($reelsId)
    {
        $this->selectedReelId = $reelsId;
        $this->comments = ReelComment::where('reel_id', $this->selectedReelId)->get(); 
    }

    public function render()
    {
        $reels = Reels::getAll();
        return view('livewire.reels.render-reels', [
            'reels' => $reels,
            'comments' => $this->comments
        ]);
    }
}
