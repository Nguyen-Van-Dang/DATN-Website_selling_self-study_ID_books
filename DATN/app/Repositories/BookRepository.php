<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Session;

class BookRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllBook()
    {
        $Book = Book::getAll();
        return view('admin.book.listBook', ['Book' => $Book]);
    }
    public function getAllBookClient()
    {
        return view('client.book.book');
    }
    public function getAllBookFavorite()
    {
        return view('client.book.bookFavorite');
    }

    public function getBookDetailClient($id) {}
}
