<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBook()
    {
        return $this->bookRepository->getAllBook();
    }

    public function getAllBookClient()
    {
        return $this->bookRepository->getAllBookClient();
    }
}
