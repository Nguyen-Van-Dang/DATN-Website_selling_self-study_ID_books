<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\LectureRepository;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Lecture;

class LectureController extends Controller
{
    private LectureRepository $lectureRepository;

    public function __construct(LectureRepository $lectureRepository)
    {
        $this->lectureRepository = $lectureRepository;
    }

}
