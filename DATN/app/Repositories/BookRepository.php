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

    public function getBookDetailClient($id)
    {
        $Book = Book::with(['user'])->findOrFail($id);
        $user = $Book->user;
        $Book->increment('views');
        $popularBooks = Book::orderBy('views', 'desc')->take(6)->get();
        $favBook = Book::withCount('favorites')->orderByDesc('favorites_count')->limit(6)->get();
        $relatedBooks = Book::whereHas('categories', function ($query) use ($Book) {
            $query->whereIn('id', $Book->categories->pluck('id'));
        })->where('id', '!=', $Book->id)->take(6)->get();
        return view('client.book.bookDetail', compact('Book', 'user', 'relatedBooks', 'favBook', 'popularBooks'));
    }
}
