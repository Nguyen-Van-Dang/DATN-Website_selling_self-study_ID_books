<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ReelsRepository;
use Illuminate\Http\Request;

class ReelsController extends Controller
{
    private ReelsRepository $reelsRepository;

    public function __construct(ReelsRepository $reelsRepository)
    {
        $this->reelsRepository = $reelsRepository;
    }

    public function upload(Request $request)
    {
        // Kiểm tra xem có video được upload hay không
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
            $directory = 'videos'; // Thư mục trên Google Drive

            $disk = Storage::disk('google');

            // Tạo thư mục nếu nó chưa tồn tại
            if (!$disk->exists($directory)) {
                $disk->makeDirectory($directory);
            }

            // Đường dẫn lưu video
            $filePath = $directory . '/' . $fileName;

            // Tải video lên Google Drive
            $disk->put($filePath, file_get_contents($file));

            // Lấy ID của video vừa upload
            $meta = $disk->getAdapter()->getMetadata($filePath)->extraMetadata()['id'];

            // Trả về URL của video đã upload
            return response()->json(['videoURL' => 'https://drive.google.com/file/d/' . $meta . '/preview']);
        }

        return response()->json(['error' => 'No video uploaded'], 400);
    }

    public function showVideo(Request $request)
    {
        $videoURL = $request->get('videoURL'); // Lấy video URL từ request
        return view('client.reels.reelsUpload1', ['videoURL' => $videoURL]); // Chuyển biến videoURL vào view}
    }
}
