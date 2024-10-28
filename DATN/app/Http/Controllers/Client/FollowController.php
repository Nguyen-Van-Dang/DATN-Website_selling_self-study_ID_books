<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    private FollowRepository $followRepository;
    public function __construct(FollowRepository $followRepository)
    {
        $this->followRepository = $followRepository;
    }
    public function follow(Request $request)
    {
        return $this->followRepository->follow($request);
    }
    
}
