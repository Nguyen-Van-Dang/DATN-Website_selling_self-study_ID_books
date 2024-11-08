<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\User;
use App\Models\Favorite;

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
    public function getBookDetailClient($id)
    {
        // Tìm cuốn sách với id và tải mối quan hệ với 'lectures' và 'user'
        $Book = Book::with(['user'])->findOrFail($id);

        // Lấy thông tin người đăng sách (user)
        $user = $Book->user;
        return view('client.book.bookDetail', compact('Book', 'user'));
    }
}
