<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ReelsRepository;
use Illuminate\Http\Request;
use App\Models\Reels;
use App\Jobs\UploadFileJob;
use Illuminate\Support\Facades\Auth;

class ReelsController extends Controller
{
    private ReelsRepository $reelsRepository;

    public function __construct(ReelsRepository $reelsRepository)
    {
        $this->reelsRepository = $reelsRepository;
    }
    public function index()
    {
        return view('client.reels.reelsUpload');
    }
    public function submit(Request $request)
    {
        $reelsImg = null;

        $reels = new Reels();
        $reels->user_id = Auth::id();
        $reels->title = $request->title;
        $reels->save();


        // Lưu ảnh lên Google Drive
        if ($request->hasFile('reelsImg')) {
            $imagePath = $request->file('reelsImg')->store('temp');
            UploadFileJob::dispatch($reels, '1tBSCtPIIFXHrfXq4CZCDvAFfyG9g9UAI', $imagePath, 'reelsImg');
        }

        // Lưu video lên Google Drive
        if ($request->hasFile('reelsVideo')) {
            $videoPath = $request->file('reelsVideo')->store('temp');
            UploadFileJob::dispatch($reels, '1lal7kv8uiBTmLjm8Br1ktYlkn2DqSdfW', $videoPath, 'reelsVideo');
        }

        return redirect()->route('tai-video.index')->with('success', 'Thêm mới reels thành công');
    }


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

    public function destroy($id)
    {
        $reel = Reels::findOrFail($id);
        if ($reel->video_url) {
        }
        $reel->delete();

        return redirect()->back()->with('success', 'Video đã được xóa thành công!');
    }

    public function show($id)
    {
        $reel = Reels::findOrFail($id);
    
        // Lấy khóa học của giảng viên liên kết với reel
        $userCourses = $reel->user->courses;
    
        // Lấy ảnh của reel
        $reelsImage = $reel->images()->where('image_name', 'reelsImg')->first();
    
        return view('client.reels.reelsDetail', compact('reel', 'reelsImage', 'userCourses'));
    }
    
}
