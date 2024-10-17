<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\CourseCateRepository;
use Illuminate\Http\Request;

class CourseCateController extends Controller
{
    private CourseCateRepository $courseCateRepository;

    public function __construct(CourseCateRepository $courseCateRepository)
    {
        $this->courseCateRepository = $courseCateRepository;
    }

    public function getAllCourseCate()
    {
        return $this->courseCateRepository->getAllCourseCate();
    }
}
