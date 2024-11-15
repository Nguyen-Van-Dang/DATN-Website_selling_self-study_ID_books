<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use App\Models\Book;
use App\Models\Course;
use App\Models\User;
use App\Models\ChatGroup;
// Truyền thêm các model cần upload


class UploadFileJob implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    protected $model;
    protected $folderId;
    protected $file;
    protected $fileName;

    public function __construct($model, $folderId, $file, $fileName)
    {
        $this->model = $model;
        $this->folderId = $folderId;
        $this->file = $file;
        $this->fileName = $fileName;
    }

    // Phương thức handle sẽ xử lý việc upload file
    public function handle(GoogleDriveService $googleDriveService)
    {
        Log::info('Job started with file path: ' . $this->file);
        try {
            $filePath = storage_path('app/' .  $this->file);
            $fileUpload = new UploadedFile(
                $filePath,
                $this->fileName, // Tên file
                mime_content_type($filePath), // MIME type
                null, // Không cần size vì Google Drive sẽ tính toán
                true // Đánh dấu là file
            );
            $fileId = $googleDriveService->uploadAndGetFileId($fileUpload, $this->folderId);
            // Kiểm tra loại file vừa up để lấy link xem phù hợp
            $mimeType = mime_content_type($filePath);
            $imageUrl = $this->generateFileUrl($fileId, $mimeType);
            // Lưu dữ liệu vào database
            $this->model->images()->create([
                'image_url' => $imageUrl,
                'image_name' => $this->fileName,
            ]);

            Storage::delete($this->file);
        } catch (\Exception $e) {
            Log::error("Job failed with error: " . $e->getMessage());
            throw $e;
        }
    }

    private function generateFileUrl($fileId, $mimeType)
    {
        if (strpos($mimeType, 'image') !== false) {
            // Nếu là file ảnh
            return "https://drive.google.com/thumbnail?id=" . $fileId;
        } elseif (strpos($mimeType, 'pdf') !== false || strpos($mimeType, 'spreadsheet') !== false) {
            // Nếu là PDF hoặc Excel 
            return "https://drive.google.com/file/d/{$fileId}/view";
        } elseif (strpos($mimeType, 'video') !== false) {
            // Nếu là video
            return "https://drive.google.com/file/d/{$fileId}/view";
        } else {
            // Nếu không phải các loại trên, trả về một đường dẫn mặc định hoặc thông báo
            return "https://drive.google.com/file/d/{$fileId}/view";
        }
    }
}
