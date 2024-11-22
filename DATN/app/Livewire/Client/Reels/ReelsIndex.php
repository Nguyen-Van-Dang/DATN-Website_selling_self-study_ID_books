<?php

namespace App\Livewire\Client\Reels;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reels;
use App\Models\ReelComment;

class ReelsIndex extends Component
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
        return view('livewire.client.reels.reels-index', [
            'reels' => $reels,
            'comments' => $this->comments
        ]);
    }
}
