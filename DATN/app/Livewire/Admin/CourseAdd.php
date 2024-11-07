<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use App\Models\Documents;
use App\Models\LectureCategories;
use App\Models\Lecture;
use Livewire\Component;
use Livewire\WithFileUploads;
use Google\Service\Drive\Permission as Google_Service_Drive_Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class CourseAdd extends Component
{
    use WithFileUploads;
    public $courseId;
    public $courseName;
    public $price;
    public $description;
    public $courseImage;
    public $discount;
    public $documentFile;
    public $lectureCategories = [];
    public $lectures = [];
    public $lectureVideo = [];
    protected $listeners = ['restoreData'];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.course-add');
    }

    protected $rules = [
        'courseName' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'courseImage' => 'required',
        'discount' => 'nullable|numeric',
        'documentFile' => 'required',
        'lectureCategories.*' => 'required',
        'lectures.*' => 'required',
        'lectureVideo.*' => 'required',
    ];
    // public function storeCourse()
    // {
    //     $this->validate();

    //     // Tạo khóa học
    //     $course = Courses::create([
    //         'name' => $this->courseName,
    //         'description' => $this->description,
    //         'price' => $this->price,
    //         'discount' => $this->discount,
    //         'user_id' => auth::id(),
    //     ]);

    //     // Xử lý upload ảnh khóa học
    //     if ($this->courseImage) {
    //         $filename = now()->format('Ymd_His') . '_' . $this->courseImage->getClientOriginalName();
    //         $fileContent = file_get_contents($this->courseImage->getRealPath());
    //         Storage::disk('google')->put('Courses/' . $filename, $fileContent, 'public');
    //         $course->update([
    //             'courseImage' => Storage::disk('google')->url('Courses/' . $filename)
    //         ]);
    //     }

    //     // Tạo tài liệu cho khóa học
    //     Documents::create([
    //         'created_by' => auth::id(),
    //         'course_id' => $course->id,
    //     ]);

    //     // Xử lý upload tài liệu cho khóa học
    //     if ($this->documentFile) {
    //         $filename = now()->format('Ymd_His') . '_' . $this->documentFile->getClientOriginalName();
    //         $fileContent = file_get_contents($this->documentFile->getRealPath());
    //         Storage::disk('google')->put('Documents/' . $filename, $fileContent, 'public');

    //         $course->update([
    //             'documentFile' => Storage::disk('google')->url('Documents/' . $filename)
    //         ]);
    //     }

    //     // Xử lý các danh mục bài giảng và bài giảng
    //     $totalLectures = 0;

    //     foreach ($this->lectureCategories as $index => $categoryName) {
    //         if (isset($this->lectureCategories[$index]) && !isset($this->lectureCategories[$index]['deleted'])) {
    //             $lectureCategory = LectureCategories::create([
    //                 'name' => $categoryName,
    //                 'created_by' => auth::id(),
    //             ]);

    //             if (isset($this->lectures[$index])) {
    //                 foreach ($this->lectures[$index] as $lectureIndex => $lectureName) {
    //                     if (!isset($this->lectures[$index][$lectureIndex]['deleted'])) {
    //                         $lecture = Lecture::create([
    //                             'name' => $lectureName,
    //                             'course_id' => $course->id,
    //                             'lecture_categories_id' => $lectureCategory->id,
    //                         ]);
    //                         $totalLectures++;

    //                         if (isset($this->lectureVideo[$index][$lectureIndex])) {
    //                             $videoFile = $this->lectureVideo[$index][$lectureIndex];
    //                             $filename = $videoFile->getClientOriginalName();
    //                             $fileContent = file_get_contents($videoFile->getRealPath());

    //                             // Upload the video to Google Drive and get the file ID
    //                             $path = Storage::disk('google')->put('Lectures/' . $filename, $fileContent, 'public');
    //                             $fileId = $this->getFileIdFromPath($path);

    //                             // Set file to public and get the URL
    //                             if ($fileId) {
    //                                 $this->setFilePublic($fileId);
    //                                 $fileUrl = 'https://drive.google.com/uc?export=view&id=' . $fileId;

    //                                 $lecture->update([
    //                                     'video_url' => $fileUrl,
    //                                 ]);
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }


    //     $course->amount_lecture = $totalLectures;
    //     $course->save();

    //     session()->flash('message', 'Thêm khóa học và các danh mục bài giảng thành công.');
    //     $this->reset(['courseName', 'description', 'price', 'discount', 'lectureCategories', 'lectures', 'lectureVideo']);
    // }

    public function storeCourse()
    {
        // Validate the input data
        $this->validate();

        // Create a new course
        $course = Course::create([
            'name' => $this->courseName,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'user_id' => auth()->id(),
        ]);

        // Handle course image upload
        if ($this->courseImage) {
            $this->uploadFile($this->courseImage, 'Courses', 'courseImage', $course);
        }

        // Create a document for the course
        Documents::create([
            'created_by' => auth()->id(),
            'course_id' => $course->id,
        ]);

        // Handle document file upload
        if ($this->documentFile) {
            $this->uploadFile($this->documentFile, 'Documents', 'documentFile', $course);
        }

        // Handle lecture categories and lectures
        $totalLectures = 0;

        foreach ($this->lectureCategories as $index => $categoryName) {
            if (!empty($categoryName) && !isset($this->lectureCategories[$index]['deleted'])) {
                $lectureCategory = LectureCategories::create([
                    'name' => $categoryName,
                    'created_by' => auth()->id(),
                ]);

                if (isset($this->lectures[$index])) {
                    foreach ($this->lectures[$index] as $lectureIndex => $lectureName) {
                        if (!empty($lectureName) && !isset($this->lectures[$index][$lectureIndex]['deleted'])) {
                            $lecture = Lecture::create([
                                'name' => $lectureName,
                                'course_id' => $course->id,
                                'lecture_categories_id' => $lectureCategory->id,
                            ]);
                            $totalLectures++;

                            if (isset($this->lectureVideo[$index][$lectureIndex])) {
                                // Make sure $this->lectureVideo[$index][$lectureIndex] is an array
                                foreach ($this->lectureVideo[$index][$lectureIndex] as $videoFile) {
                                    if ($videoFile) { // Ensure the file is present
                                        $this->uploadLectureVideo($videoFile, $lecture);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // Update the total number of lectures in the course
        $course->amount_lecture = $totalLectures;
        $course->save();

        // Flash success message and reset input fields
        session()->flash('message', 'Thêm khóa học và các danh mục bài giảng thành công.');
        $this->reset(['courseName', 'description', 'price', 'discount', 'lectureCategories', 'lectures', 'lectureVideo']);
    }

    // Upload a generic file to Google Drive
    private function uploadFile($file, $folder, $columnName, $course)
    {
        $filename = now()->format('Ymd_Hisv') . '_' . $file->getClientOriginalName();
        $fileContent = file_get_contents($file->getRealPath());
        $path = Storage::disk('google')->put("$folder/$filename", $fileContent, 'public');

        // Update the course with the file URL
        $course->update([
            $columnName => Storage::disk('google')->url("$folder/$filename"),
        ]);
    }

    // Upload a lecture video and set it to public
    private function uploadLectureVideo($videoFile, $lecture)
    {
        $filename = now()->format('Ymd_Hisv') . '_' . $videoFile->getClientOriginalName();
        $fileContent = file_get_contents($videoFile->getRealPath());

        // Upload the video to Google Drive
        $path = Storage::disk('google')->put("Lectures/$filename", $fileContent, 'public');
        $fileId = $this->getFileIdFromPath($path);

        // Set the file to public and get the URL
        if ($fileId) {
            $this->setFilePublic(Storage::disk('google'), $path);
            $fileUrl = 'https://drive.google.com/uc?export=view&id=' . $fileId;

            // Update the lecture with the video URL
            $lecture->update([
                'video_url' => $fileUrl,
            ]);
        }
    }


    private function setFilePublic($disk, $path)
    {
        $service = $disk->getAdapter()->getService();
        $file = $disk->getAdapter()->getMetadata($path);

        if (isset($file['extraMetadata']['id'])) {
            $fileId = $file['extraMetadata']['id'];
            $service->permissions->create($fileId, new Google_Service_Drive_Permission([
                'role' => 'writer',
                'type' => 'anyone',
            ]));
        } else {
            // Xử lý lỗi nếu không tìm thấy ID
            throw new \Exception('File ID not found.');
        }
    }


    private function getFileIdFromPath($path)
    {
        $pathParts = explode('/', $path);
        return end($pathParts); // Retrieves the last segment, which should be the file ID
    }
}
