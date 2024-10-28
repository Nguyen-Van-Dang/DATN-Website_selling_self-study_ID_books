<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ReelsRepository;
use Illuminate\Http\Request;
use App\Models\Reels;

class ReelsController extends Controller
{
    private ReelsRepository $reelsRepository;

    public function __construct(ReelsRepository $reelsRepository)
    {
        $this->reelsRepository = $reelsRepository;
    }
    //reelsUpload
    public function upload(Request $request)
    {
        return $this->reelsRepository->upload($request);
    }

    //reelsUpload1
    public function reelsUpload1(Request $request)
    {
        return $this->reelsRepository->reelsUpload1($request);
    }

    public function showVideo(Request $request)
    {
        $videoURL = $request->get('videoURL'); // Lấy video URL từ request
        return view('client.reels.reelsUpload1', ['videoURL' => $videoURL]); // Chuyển biến videoURL vào view}
    }

    // public function showVideo(Request $request)
    // {
    //     $videoInfo = $request->input('videoInfo');

    //     return view('reelsUpload1', compact('videoInfo'));
    // }  

    //view
    public function incrementViewCount($reelId)
    {
        $reels = Reels::find($reelId);

        if ($reels) {
            $reels->increment('views_count'); // Tăng cột views_count lên 1
            return response()->json(['success' => true, 'views_count' => $reels->views_count]);
        }

        return response()->json(['success' => false, 'message' => 'Reel not found'], 404);
    }
}
