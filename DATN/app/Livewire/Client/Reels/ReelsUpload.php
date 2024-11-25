<?php

namespace App\Livewire\Client\Reels;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Reels;
use App\Jobs\UploadFileJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReelsUpload extends Component
{
    use WithFileUploads;

    public $teachers, $title, $reelsImg, $reelsVideo, $isRestoring = false;
    public function render()
    {
        return view('livewire.client.reels.reels-upload');
    }

    public function submit()
    {
        $reels = new Reels;
        $reels->user_id = Auth::id();
        $reels->title = $this->title;
        $reels->save();

        // Lưu ảnh
        $folderId = '1tBSCtPIIFXHrfXq4CZCDvAFfyG9g9UAI';
        $filePath = $this->reelsImg->store('temp');
        UploadFileJob::dispatch($reels, $folderId, $filePath, 'reelsImg');

        // Lưu video
        $folderId = '1lal7kv8uiBTmLjm8Br1ktYlkn2DqSdfW';
        $filePath = $this->reelsVideo->store('temp');
        UploadFileJob::dispatch($reels, $folderId, $filePath, 'reelsVideo');

        $this->reset(['title', 'reelsImg', 'reelsVideo']);

        return redirect()->route('tai-video.index')->with('success', 'Thêm mới reels thành công');
    }
}
