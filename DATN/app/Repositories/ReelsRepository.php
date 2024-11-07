<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Models\Reels;
use Google\Service\Drive\Permission as Google_Service_Drive_Permission;
use Illuminate\Support\Facades\Auth;

class ReelsRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    private function setFilePublic($disk, $path)
    {
        $service = $disk->getAdapter()->getService();
        $file = $disk->getAdapter()->getMetadata($path);
        $service->permissions->create($file['extraMetadata']['id'], new Google_Service_Drive_Permission([
            'role' => 'writer',
            'type' => 'anyone',
        ]));
    }

    public function upload($data)
    {
        $file = $data->file('video');
        $fileName = $file->getClientOriginalName();
        $directory = 'Reels';

        $disk = Storage::disk('google');

        if (!$disk->exists($directory)) {
            $disk->makeDirectory($directory);
        }

        $filePath = $directory . '/' . $fileName;
        $disk->put($filePath, file_get_contents($file));
        $this->setFilePublic($disk, $filePath);
        $meta = $disk->getAdapter()->getMetadata($filePath)->extraMetadata()['id'];
        return response()->json(['videoURL' => 'https://drive.google.com/file/d/' . $meta . '/preview']);
    }
    public function showVideo()
    {
        $videoUrl = session('videoUrl');
        return view('reels.reelsUpload1', compact('videoUrl'));
    }

    public function reelsUpload1($data)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $data->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm xác thực cho thumbnail
            'title' => 'required|string|max:255', // Thêm xác thực cho title
            'video_url' => 'required|file|mimes:mp4,mov,avi,wmv|max:51200', // Xác thực cho video_url
        ]);

        // Xử lý tệp thumbnail
        $thumbnail = $validatedData['thumbnail'];
        $thumbnailName = $thumbnail->getClientOriginalName();
        $directory = 'Reels/Thumbnails';

        $disk = Storage::disk('google');

        if (!$disk->exists($directory)) {
            $disk->makeDirectory($directory);
        }

        $thumbnailPath = $directory . '/' . $thumbnailName;
        $disk->put($thumbnailPath, file_get_contents($thumbnail));
        $this->setFilePublic($disk, $thumbnailPath);
        $thumbnailMeta = $disk->getAdapter()->getMetadata($thumbnailPath)->extraMetadata()['id'];

        // Lưu video
        $videoFile = $validatedData['video_url'];
        $videoName = $videoFile->getClientOriginalName();
        $videoDirectory = 'Reels/Videos';

        if (!$disk->exists($videoDirectory)) {
            $disk->makeDirectory($videoDirectory);
        }

        $videoPath = $videoDirectory . '/' . $videoName;
        $disk->put($videoPath, file_get_contents($videoFile));
        $this->setFilePublic($disk, $videoPath);
        $videoMeta = $disk->getAdapter()->getMetadata($videoPath)->extraMetadata()['id'];

        // Lưu thông tin vào cơ sở dữ liệu
        $video = new Reels();
        $video->user_id = auth::id();
        $video->title = $validatedData['title'];
        $video->thumbnail = 'https://drive.google.com/file/d/' . $thumbnailMeta . '/preview';
        $video->video_url = 'https://drive.google.com/file/d/' . $videoMeta . '/preview';
        $video->save();

        return redirect()->back()->with('success', 'Video uploaded successfully!');
    }
}
