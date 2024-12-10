<?php

namespace App\Livewire\Client\Reels;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reels;
use App\Models\ReelComment;
use App\Models\ReelLike;
use Illuminate\Support\Facades\Auth;

class ReelsIndex extends Component
{
    use WithPagination;

    public $comments, $user, $newReply, $selectedReel, $reelVideo, $commentCount;
    public $replyParentId = null, $showRepliesId = null, $isEditingCommentId = null, $isEditingReplyId = null, $selectedReelId = null;
    public $newComment = '', $editComment = '', $editReply = '';
    public $isLiked = false;
    public $likeCount = 0;


    protected $listeners = [
        'reelSelected' => 'loadComments'
    ];
    public function mount()
    {
        $this->comments = collect();
        $this->user = Auth::user();
    }
    // Hàm load bình luận theo reels_id
    public function loadComments($reelId)
    {
        $this->selectedReelId = $reelId;
        $this->selectedReel = Reels::find($this->selectedReelId);
        $this->comments = ReelComment::where('reel_id', $this->selectedReelId)
            ->whereNull('parent_id')
            ->with(['user', 'replies' => function ($query) {
                $query->oldest();
            }])
            ->oldest()
            ->get();
        $this->commentCount = ReelComment::where('reel_id', $this->selectedReelId)->count();
        $this->loadLikes();
    }

    public function addComment()
    {
        if (empty(trim($this->newComment))) {
            return;
        }
        if (strlen($this->newComment) > 150) {
            return session()->flash('error', 'Bình luận quá dài!');
        }
        if ($this->newComment && $this->selectedReelId) {
            $comment = ReelComment::create([
                'reel_id' => $this->selectedReelId,
                'user_id' => $this->user->id,
                'content' => $this->newComment,
            ]);

            $this->comments->push($comment);
            $this->newComment = '';
        }
    }
    public function toggleReplies($commentId)
    {
        if ($this->showRepliesId === $commentId) {
            $this->showRepliesId = null;
            $this->replyParentId = null;
        } else {
            $this->showRepliesId = $commentId;
            $this->replyParentId = $commentId;
        }
    }
    public function toggleEdit($commentId)
    {
        $this->isEditingCommentId = $commentId;

        $comment = ReelComment::find($commentId);
        $this->editComment = $comment ? $comment->content : '';
    }
    public function toggleEditReply($replyId)
    {
        $this->isEditingReplyId = $replyId;

        $reply = ReelComment::find($replyId);
        $this->editReply = $reply ? $reply->content : '';
    }
    public function updateComment()
    {
        if ($this->isEditingCommentId) {
            $comment = ReelComment::find($this->isEditingCommentId);

            if ($comment) {
                if (empty(trim($this->editComment))) {
                    return;
                }
                if (strlen($this->editComment) > 150) {
                    return session()->flash('error', 'Bình luận quá dài!');
                }
                $comment->content = $this->editComment;
                $comment->save();
                $this->isEditingCommentId = null;
                $this->editComment = '';
                $this->loadComments($this->selectedReelId);
            }
        }
    }
    public function updateReply()
    {
        if ($this->isEditingReplyId) {
            $reply = ReelComment::find($this->isEditingReplyId);

            if ($reply) {
                if (empty(trim($this->editReply))) {
                    return;
                }
                if (strlen($this->editReply) > 150) {
                    return session()->flash('error', 'Bình luận quá dài!');
                }
                $reply->content = $this->editReply;
                $reply->save();

                $this->isEditingReplyId = null;
                $this->editReply = '';
                $this->loadComments($this->selectedReelId);
            }
        }
    }

    public function deleteComment($commentId)
    {
        $comment = ReelComment::find($commentId);
        if ($comment) {
            ReelComment::where('parent_id', $commentId)->delete();
            $comment->delete();
            $this->loadComments($this->selectedReelId);
        }
    }

    public function cancelEdit()
    {
        $this->isEditingCommentId = null;
        $this->editComment = '';
    }
    public function cancelEditReply()
    {
        $this->isEditingReplyId = null;
        $this->editReply = '';
    }
    public function addReply()
    {

        if (empty(trim($this->newReply))) {
            return;
        }

        if (strlen($this->newReply) > 150) {
            return session()->flash('error', 'Bình luận quá dài!');
        }
        if ($this->newReply && $this->replyParentId) {
            $reply = ReelComment::create([
                'reel_id' => $this->selectedReelId,
                'user_id' => $this->user->id,
                'content' => $this->newReply,
                'parent_id' => $this->replyParentId,
            ]);
            $this->newReply = '';
            $this->replyParentId = null;
            $this->loadComments($this->selectedReelId);
        }
    }
    public function loadLikes()
    {
        $this->likeCount = ReelLike::where('reel_id', $this->selectedReelId)->count();
        if ($this->user) {
            $this->isLiked = ReelLike::where('reel_id', $this->selectedReelId)
                ->where('user_id', $this->user->id)
                ->exists();
        }
    }
    public function toggleLike()
    {
        $like = ReelLike::where('reel_id', $this->selectedReelId)
            ->where('user_id', $this->user->id)
            ->first();

        if ($like) {
            // Nếu đã like -> unlike
            $like->delete();
            $this->isLiked = false;
            $this->likeCount--;
        } else {
            // Nếu chưa like -> like
            ReelLike::create([
                'reel_id' => $this->selectedReelId,
                'user_id' => $this->user->id,
            ]);
            $this->isLiked = true;
            $this->likeCount++;
        }
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
        ]);
    }
}
