<?php

namespace App\Repositories;

use App\Models\CategoryBook;

class BookCateRepository
{
    public function __construct()
    {
        //
    }

    public function getAllBookCate() {
        $bookCate = CategoryBook::getAll();
        return view('admin.categoryBook.listCategoryBook', ['bookCate' => $bookCate]);
    }
}
