<?php
namespace App\Mail;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function build()
    {
        return $this->subject('Thông báo duyệt khóa học')->view('emails.course_approval');
    }
}
