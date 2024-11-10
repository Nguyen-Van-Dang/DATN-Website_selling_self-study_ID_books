<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\LectureRepository;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    private LectureRepository $lectureRepository;

    public function __construct(LectureRepository $lectureRepository)
    {
        $this->lectureRepository = $lectureRepository;
    }

    public function show($id)
    {
        return $this->lectureRepository->showLecture($id);
    }
}
