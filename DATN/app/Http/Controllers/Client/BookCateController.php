<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\BookCateRepository;
use Illuminate\Http\Request;

class BookCateController extends Controller
{
    private BookCateRepository $bookCateRepository;

    public function __construct(BookCateRepository $bookCateRepository)
    {
        $this->bookCateRepository = $bookCateRepository;
    }

    public function getAllBookCate()
    {
        return $this->bookCateRepository->getAllBookCate();
    }
}
