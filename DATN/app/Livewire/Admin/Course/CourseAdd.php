<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use App\Models\Documents;
use App\Models\LectureCategories;
use App\Models\Lecture;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleDriveService;
use App\Jobs\UploadFileJob;
use App\Models\User;


class CourseAdd extends Component
{
    use WithFileUploads;
    public $teachers;
    public $courseAuthor;
    public $courseId;
    public $courseName;
    public $price;
    public $description;
    public $image_url;
    public $discount;
    public $document_url;
    public $filePreviewUrl;
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
    public function mount()
    {
        if (Auth::user()->id == 1) {
            $this->teachers = User::where('role_id', 2)->get();
        } else {
            $this->teachers = collect(); // Trả về mảng rỗng nếu không phải admin
        }
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
        $course = new Course;
        $course->name = $this->courseName;
        $course->price = $this->price;
        $course->discount = $this->discount ?? 0;
        $course->description = $this->description;
        $course->user_id = $this->courseAuthor;
        $course->user_id = Auth::id();
        $course->status = Auth::user()->role_id == 1 ? 0 : 1;
        $course->save();

        $document = new Documents;
        $document->created_by = Auth::id();
        $document->course_id = $course->id;
        $document->save();

        if ($this->image_url) {
            $folderId = '1XrcghzBo6Y5bkV-Iasbim_ARS65ZK42R';
            $filePath = $this->image_url->store('temp');
            UploadFileJob::dispatch($course, $folderId, $filePath, 'thumbnail');
        }

        if ($this->document_url) {
            $folderId = '1G88HQ3NeBXuoIW3QbGDFQCegS73O72g1';
            $filePath = $this->document_url->store('temp');
            UploadFileJob::dispatch($document, $folderId, $filePath, 'document');
        }

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

                            if (isset($this->lectureVideo[$index][$lectureIndex])) {
                                $videoFile = $this->lectureVideo[$index][$lectureIndex];

                                $folderId = '1j0kkkIFeO7qvPMhqWG4OyJUy1WGRclEf';
                                $filePath = $videoFile->store('temp');
                                UploadFileJob::dispatch($lecture, $folderId, $filePath, 'video');
                            }
                        }
                    }
                }
            }
        }

        toastr()->success('<p>Thêm khóa học và các danh mục bài giảng thành công!</p>');
        $this->reset([
            'courseName', 'description', 'price', 'discount', 
            'image_url', 'document_url', 'lectureCategories', 
            'lectures', 'lectureVideo'
        ]);
    }
}
