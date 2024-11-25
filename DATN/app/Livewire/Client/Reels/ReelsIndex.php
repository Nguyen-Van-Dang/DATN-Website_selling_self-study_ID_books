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
    public $selectedReelId = null, $reelVideo;

    // Hàm load bình luận theo reels_id
    public function loadComments($reelsId)
    {
        $this->selectedReelId = $reelsId;
        $this->comments = ReelComment::where('reel_id', $this->selectedReelId)->get();
    }

    public function convertLink($url)
    {
        // truyền link vô để đổi thành link xem được
        if (strpos($url, 'drive.google.com') !== false) {
            preg_match('/\/d\/(.*?)\//', $url, $matches);
            if (!empty($matches[1])) {
                return "https://drive.google.com/file/d/{$matches[1]}/preview";
            }
        }
        return $url;
    }
    public function render()
    {
        $reels = Reels::getAll()->map(function ($reel) {
            if ($reel->images()->where('image_name', 'reelsVideo')->first()) {
                $reel->preview_url = $this->convertLink($reel->images()->where('image_name', 'reelsVideo')->first()->image_url);
            }
            return $reel;
            // gán link mới truyền vào biến preview_url

        });
        return view('livewire.client.reels.reels-index', [
            'reels' => $reels,
            'comments' => $this->comments
        ]);
    }
}
