<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllBook() {
        $Book = Book::getAll();
        return view('admin.book.listBook', ['Book' => $Book]);
    }
}
