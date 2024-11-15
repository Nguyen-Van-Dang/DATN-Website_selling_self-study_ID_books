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

use App\Models\Book; // Thêm các model cần thiết

class UpdateFileJob implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    protected $model;
    protected $oldFileUrl;
    protected $newFile;
    protected $folderId;
    protected $fileName;

    public function __construct($model, $oldFileUrl, $newFile, $folderId, $fileName)
    {
        $this->model = $model;
        $this->oldFileUrl = $oldFileUrl;
        $this->newFile = $newFile;
        $this->folderId = $folderId;
        $this->fileName = $fileName;
    }

    // Phương thức handle sẽ xử lý việc cập nhật file
    public function handle(GoogleDriveService $googleDriveService)
    {
        $filePath = storage_path('app/' . $this->newFile);

        $fileUpload = new UploadedFile(
            $filePath,
            $this->fileName, // Tên file
            mime_content_type($filePath), // MIME type
            null, // Không cần size vì Google Drive sẽ tính toán
            true // Đánh dấu là file
        );

        // tìm file cũ bằng url và xoá
        $deleteOldFile = $googleDriveService->deleteFile($this->oldFileUrl);
        if (!$deleteOldFile) {
            Log::error("Xóa file cũ thất bại: $this->oldFileUrl");
            return;
        }
        // thêm file mới nếu xoá thành công
        $fileId = $googleDriveService->uploadAndGetFileId($fileUpload, $this->folderId);
        if (!$fileId) {
            Log::error("Tải file mới lên Google Drive thất bại.");
            return;
        }

        $mimeType = mime_content_type($filePath);
        $imageUrl = $this->generateFileUrl($fileId, $mimeType);
        // Lưu dữ liệu vào database
        try {
            $existingImage = $this->model->images()
                ->where('image_url', $this->oldFileUrl)
                ->first();
            if ($existingImage) {
                $existingImage->delete();
            }
            $this->model->images()->create([
                'image_url' => $imageUrl,
                'image_name' => $this->fileName,
            ]);
        } catch (\Exception $e) {
            Log::error("Lưu thông tin file vào database thất bại: " . $e->getMessage());
        }

        // Xóa file tạm trong storage
        Storage::delete($this->newFile);
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
