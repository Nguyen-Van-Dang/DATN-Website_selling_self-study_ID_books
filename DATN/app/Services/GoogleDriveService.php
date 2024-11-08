<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Storage;


class GoogleDriveService
{


    public function uploadAndGetFileId($file, $folderId)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $service = new Google_Service_Drive($client);

        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $file->getClientOriginalName(),
            'parents' => [$folderId],
        ]);
        $content = file_get_contents($file->getRealPath());
        $uploadedFile = $service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $file->getMimeType(),
            'uploadType' => 'multipart',
        ]);

        $permission = new \Google_Service_Drive_Permission();
        $permission->setType('anyone');
        $permission->setRole('reader');
        $service->permissions->create($uploadedFile->getId(), $permission);

        return $uploadedFile->getId();
    }

    public function getFileIdFromUrl($url)
    {
        if (preg_match('/https:\/\/drive\.google\.com\/(?:file\/d\/|thumbnail\?id=)([^\/&]+)/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    public function deleteFileById($fileId)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $service = new Google_Service_Drive($client);

        $service->files->delete($fileId);
        return true;
    }

    public function UpdateFile($oldFileUrl, $newFile, $folderId)
    {
        // tìm file cũ có url và xoá 
        $oldFileId = $this->getFileIdFromUrl($oldFileUrl);
        if ($oldFileId) {
            $this->deleteFileById($oldFileId);
        }
        // gọi hàm thêm file mới
        return $this->uploadAndGetFileId($newFile, $folderId);
    }
}
