<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use App\Models\Documents;
use App\Models\LectureCategories;
use App\Models\Lecture;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Jobs\UploadFileJob;
use App\Jobs\UpdateFileJob;
use Illuminate\Support\Facades\Auth;

class CourseUpdate extends Component
{
    use WithFileUploads;
    public $subjects, $classes;
    public $subjectId, $classId;
    public $course, $teachers;
    public $documentFile, $lectureVideo;
    public $lectures = [], $newLectureName;
    public $lectureCategories = [], $newLectureCategoryId, $newLectureCategoryName;
    public $courseId, $name, $price, $discount, $description, $courseImage, $courseAuthor, $courseUpdate;

    public function mount($course, $subjects, $classes, $teachers, $lectureCategories)
    {
        $this->course = $course;
        $this->teachers = $teachers;
        $this->subjects = $subjects;
        $this->classes = $classes;
        $this->lectureCategories = $lectureCategories;

        $this->courseId = $course->id;
        $this->name = $course->name;
        $this->price = $course->price;
        $this->discount = $course->discount;
        $this->description = $course->description;
        $this->courseAuthor = $course->user_id;

        $this->subjectId = $course->subject_id;
        $this->classId = $course->class_id;

        $this->getOldImage($course);
        $this->getOldFile($course);
        $this->getOldVideo($course);

        $this->lectureCategories = $lectureCategories->filter(function ($category) {
            return $category->lectures->contains('course_id', $this->courseId);
        })->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'lectures' => $category->lectures->map(function ($lecture) {
                    return [
                        'id' => $lecture->id,
                        'name' => $lecture->name,
                        'video' => null,
                    ];
                })->toArray(),
            ];
        })->toArray();
    }

    public function submit()
    {
        if (filter_var($this->documentFile, FILTER_VALIDATE_URL)) {
            $this->documentFile = null;
        }
        if (filter_var($this->courseImage, FILTER_VALIDATE_URL)) {
            $this->courseImage = null;
        }
        $course = Course::findOrFail($this->courseId);
        $course->name = $this->name;
        $course->price = $this->price;
        $course->discount = $this->discount;
        $course->description = $this->description;
        $course->user_id = $this->courseAuthor;
        $course->subject_id = $this->subjectId  ?: null;
        $course->class_id = $this->classId  ?: null;

        if ($this->courseImage instanceof \Illuminate\Http\UploadedFile) {
            $oldImage = $course->images()->where('image_name', 'thumbnail')->first();
            $folderId = '1XrcghzBo6Y5bkV-Iasbim_ARS65ZK42R'; // Thư mục lưu hình ảnh
            $imagePath = $this->courseImage->store('temp');

            if (isset($oldImage->image_url)) {
                UpdateFileJob::dispatch($course, $oldImage->image_url, $imagePath, $folderId, 'thumbnail');
            } else {
                UploadFileJob::dispatch($course, $folderId, $imagePath, 'thumbnail');
            }
        }
        if ($this->documentFile instanceof \Illuminate\Http\UploadedFile) {
            $oldFile = $course->images()->where('image_name', 'document')->first();
            $folderId = '1G88HQ3NeBXuoIW3QbGDFQCegS73O72g1'; // Thư mục lưu trữ file PDF
            $filePath = $this->documentFile->store('temp');

            if (isset($oldFile->image_url)) {
                UpdateFileJob::dispatch($course, $oldFile->image_url, $filePath, $folderId, 'document');
            } else {
                UploadFileJob::dispatch($course, $folderId, $filePath, 'document');
            }
        }
        foreach ($this->lectureCategories as $chapterData) {
            // Nếu có ID, cập nhật danh mục
            if (!empty($chapterData['id'])) {
                $category = LectureCategories::find($chapterData['id']);
                if ($category) {
                    // Cập nhật tên danh mục và lecture_id
                    $category->update([
                        'name' => $chapterData['name'],
                        'lecture_id' => $category->lecture_id, // Liên kết với bảng lecture
                    ]);
                }
            } else {
                // Nếu không có ID, tạo mới danh mục
                $category = LectureCategories::create([
                    'name' => $chapterData['name'],
                    'lecture_id' => $this->lectureId,
                ]);
            }

            // Cập nhật hoặc thêm mới bài giảng trong danh mục
            foreach ($chapterData['lectures'] as $lectureData) {
                if (!empty($lectureData['id'])) {
                    // Cập nhật bài giảng nếu có ID
                    $lecture = Lecture::find($lectureData['id']);
                    if ($lecture) {
                        // Cập nhật tên bài giảng
                        $lecture->update([
                            'name' => $lectureData['name'], // Cập nhật tên bài giảng
                        ]);
                        // Nếu có video, xử lý video
                        if ($lectureData['video'] instanceof \Illuminate\Http\UploadedFile) {
                            $oldVideo = $lecture->images()->where('image_name', 'video')->first();
                            $folderId = '1j0kkkIFeO7qvPMhqWG4OyJUy1WGRclEf'; // Thư mục lưu trữ video
                            $videoPath = $lectureData['video']->store('temp');
                            if (isset($oldVideo->image_url)) {
                                UpdateFileJob::dispatch($lecture, $oldVideo->image_url, $videoPath, $folderId, 'video');
                            } else {
                                UploadFileJob::dispatch($lecture, $folderId, $videoPath, 'video');
                            }
                        }
                    }
                } else {
                    // Kiểm tra nếu danh mục đã tồn tại, nếu không thì tạo mới
                    $category = LectureCategories::firstOrCreate(
                        ['name' => $chapterData['name'], 'created_by' => Auth::id()],
                        ['created_by' => Auth::id()] // Chỉ tạo danh mục mới nếu chưa có
                    );

                    // Sau đó, tạo bài giảng trong danh mục đã tồn tại
                    $lecture = $category->lectures()->create([
                        'name' => $lectureData['name'],
                        'course_id' => $lectureData['course_id'],
                    ]);

                    // Nếu có video, lưu video
                    if ($lectureData['video'] instanceof \Illuminate\Http\UploadedFile) {
                        $oldVideo = $lecture->images()->where('image_name', 'video')->first();
                        $folderId = '1j0kkkIFeO7qvPMhqWG4OyJUy1WGRclEf'; // Thư mục lưu trữ video
                        $videoPath = $lectureData['video']->store('temp');

                        if (isset($oldVideo->image_url)) {
                            UpdateFileJob::dispatch($lecture, $oldVideo->image_url, $videoPath, $folderId, 'video');
                        } else {
                            UploadFileJob::dispatch($lecture, $folderId, $videoPath, 'video');
                        }
                    }
                }
            }
        }
        $course->save();

        return redirect()->route('admin.khoa-hoc.edit', ['khoa_hoc' => $course->id])
            ->with('success', 'Cập nhật khóa học thành công!');
    }

    public function getOldImage($course)
    {
        $thumbnail = $course->images()->where('image_name', 'thumbnail')->first();
        if ($thumbnail) {
            $this->courseImage = $thumbnail->image_url;
        }
    }
    public function getOldFile($course)
    {
        $document = Documents::where('course_id', $course->id)->first();
        $file = $document->images()->where('image_name', 'document')->first();
        if ($file) {
            $this->documentFile = $file->image_url;
        }
    }
    public function getOldVideo($course)
    {
        // Khởi tạo mảng lectureCategories
        $this->lectureCategories = [];

        // Lấy các bài giảng của khóa học
        $lectures = Lecture::where('course_id', $course->id)->get();

        foreach ($lectures as $lecture) {
            // Lấy danh mục của bài giảng (lecture_category)
            $category = $lecture->lectureCategory;

            // Lấy file video từ bài giảng
            $file = $lecture->images()->where('image_name', 'video')->first();

            // Nếu có video, gán dữ liệu vào mảng lectureCategories
            if ($file) {
                $this->lectureCategories[$category->id]['id'] = $category->id;
                $this->lectureCategories[$category->id]['name'] = $category->name;
                $this->lectureCategories[$category->id]['lectures'][$lecture->id] = [
                    'name' => $lecture->name,
                    'video' => $file->image_url,
                ];
            } else {
                $this->lectureCategories[$category->id]['id'] = $category->id;
                $this->lectureCategories[$category->id]['name'] = $category->name;
                $this->lectureCategories[$category->id]['lectures'][$lecture->id] = [
                    'name' => $lecture->name,
                    'video' => null,
                ];
            }
        }
    }

    public function addChapter()
    {
        $this->lectureCategories[] = [
            'id' => uniqid(), // Tạo ID tạm thời cho chương
            'name' => 'Chương',
            'lectures' => [],
        ];
    }

    public function addLecture($chapterIndex)
    {
        if (isset($this->lectureCategories[$chapterIndex])) {
            $chapter = $this->lectureCategories[$chapterIndex];

            if ($this->courseId) {
                $lecture = [
                    'name' => '',
                    'lecture_category_id' => $chapter['id'], // Dùng ID tạm thời
                    'course_id' => $this->courseId,
                    'video' => null,
                    'saved' => false,
                ];

                $this->lectureCategories[$chapterIndex]['lectures'][] = $lecture;
            } else {
                session()->flash('error', 'Không tìm thấy khóa học.');
            }
        } else {
            session()->flash('error', 'Chương không hợp lệ.');
        }
    }

    public function removeLecture($chapterIndex, $lectureIndex)
    {
        // Kiểm tra xem bài giảng có tồn tại không
        if (isset($this->lectureCategories[$chapterIndex]['lectures'][$lectureIndex])) {
            // Lấy ID bài giảng cần xóa
            $lecture = $this->lectureCategories[$chapterIndex]['lectures'][$lectureIndex];
            // Xóa bài giảng khỏi cơ sở dữ liệu
            if (isset($lecture['id'])) {
                $lectureModel = \App\Models\Lecture::find($lecture['id']);
                if ($lectureModel) {
                    $lectureModel->delete(); // Xóa bài giảng trong cơ sở dữ liệu
                }
            }
            // Xóa bài giảng trong mảng
            unset($this->lectureCategories[$chapterIndex]['lectures'][$lectureIndex]);
            // Cập nhật lại chỉ số mảng sau khi xóa
            $this->lectureCategories[$chapterIndex]['lectures'] = array_values($this->lectureCategories[$chapterIndex]['lectures']);
        } else {
            session()->flash('error', 'Không tìm thấy bài giảng để xóa.');
        }
    }
    public function render()
    {
        return view('livewire.admin.course.course-update');
    }
}
