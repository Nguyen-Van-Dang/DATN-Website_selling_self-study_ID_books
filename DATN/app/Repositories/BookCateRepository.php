<?php

namespace App\Repositories;

use App\Models\BookCategories;
use App\Models\CategoryBook;

class BookCateRepository
{
    public function __construct()
    {
        //
    }

    public function getAllBookCate() {
        $bookCate = BookCategories::getAll();
        return view('admin.categoryBook.listCategoryBook', ['bookCate' => $bookCate]);
    }
}
