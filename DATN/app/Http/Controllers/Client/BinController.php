<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\BinRepository;


class BinController extends Controller
{
    private BinRepository $binRepository;
    public function __construct(BinRepository $binRepository)
    {
        $this->binRepository = $binRepository;
    }

    public function checkRole()
    {
        return $this->binRepository->checkRole();
    }
}
