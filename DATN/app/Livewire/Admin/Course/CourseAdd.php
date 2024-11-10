<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use App\Models\Documents;
use App\Models\LectureCategories;
use App\Models\Lecture;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleDriveService;

class CourseAdd extends Component
{
    use WithFileUploads;
    public $courseId;
    public $courseName;
    public $price;
    public $description;
    public $image_url;
    public $discount;
    public $document_url;
    public $lectureCategories = [];
    public $lectures = [];
    public $lectureVideo = [];
    protected $listeners = ['restoreData'];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.course.course-add');
    }

    public function addChapter()
    {
        $this->lectureCategories[] = '';
    }

    public function addLecture($chapterIndex)
    {
        $this->lectures[$chapterIndex][] = '';
    }

    public function removeLecture($chapterIndex, $lectureIndex)
    {
        unset($this->lectures[$chapterIndex][$lectureIndex]);
        unset($this->lectureVideo[$chapterIndex][$lectureIndex]);
        $this->lectures[$chapterIndex] = array_values($this->lectures[$chapterIndex]);
    }
    protected $rules = [
        'courseName' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'image_url' => 'required',
        'discount' => 'nullable|numeric',
        'document_url' => 'required',
        'lectureCategories.*' => 'required',
        'lectures.*' => 'required',
        'lectureVideo.*' => 'required',
    ];
    public function storeCourse()
    {
        // $this->validate();

        $course = Course::create([
            'name' => $this->courseName,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'user_id' => auth::id(),
        ]);

        if ($this->image_url) {
            $folderId = '1WHXXlWVN3xx0XHbyWu9L7Lz3kg_qmmfB';
            $googleDriveService = new GoogleDriveService();
            $fileId = $googleDriveService->uploadAndGetFileId($this->image_url, $folderId);
            $course->update([
                'image_url' => "https://drive.google.com/thumbnail?id=" . $fileId,
            ]);
        }

        $document = Documents::create([
            'created_by' => auth::id(),
            'course_id' => $course->id,
        ]);

        if ($this->document_url) {
            $folderId = '11tDxNBN4OkVJUEPAqLvej2Ure4sjCLAF';
            $fileId = $googleDriveService->uploadAndGetFileId($this->document_url, $folderId);
            $course->update([
                'document_url' => "https://drive.google.com/thumbnail?id=" . $fileId,
            ]);
        }

        $totalLectures = 0;

        foreach ($this->lectureCategories as $index => $categoryName) {
            if (isset($this->lectureCategories[$index]) && !isset($this->lectureCategories[$index]['deleted'])) {
                $lectureCategory = LectureCategories::create([
                    'name' => $categoryName,
                    'created_by' => auth::id(),
                ]);

                if (isset($this->lectures[$index])) {
                    foreach ($this->lectures[$index] as $lectureIndex => $lectureName) {
                        if (!isset($this->lectures[$index][$lectureIndex]['deleted'])) {
                            $lecture = Lecture::create([
                                'name' => $lectureName,
                                'course_id' => $course->id,
                                'lecture_categories_id' => $lectureCategory->id,
                            ]);
                            $totalLectures++;

                            if (isset($this->lectureVideo[$index][$lectureIndex])) {
                                $videoFile = $this->lectureVideo[$index][$lectureIndex];

                                $lectureFolderId = '1FzxoMolrO4KcFsDyDLSx1oh9oIEMftwv';

                                $fileId = $googleDriveService->uploadAndGetFileId($videoFile, $lectureFolderId);

                                if ($fileId) {
                                    $videoUrl = 'https://drive.google.com/uc?export=view&id=' . $fileId;
                                    $lecture->update([
                                        'video_url' => $videoUrl,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }

        $course->amount_lecture = $totalLectures;
        $course->save();

        toastr()->success('<p>Thêm khóa học và các danh mục bài giảng thành công!</p>');
        session()->flash('message', 'Thêm khóa học và các danh mục bài giảng thành công.');
        $this->reset(['courseName', 'description', 'price', 'discount', 'image_url', 'document_url', 'lectureCategories', 'lectures', 'lectureVideo']);
    }
}
