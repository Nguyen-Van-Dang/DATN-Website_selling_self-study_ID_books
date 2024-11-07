<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Facades\Request;

class FavoriteRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function toggleFavorite($bookId)
{
    $user = auth()->user();
    $book = Book::findOrFail($bookId);

    if ($user->favorites()->where('book_id', $book->id)->exists()) {
        $user->favorites()->detach($book->id);
    } else {
        $user->favorites()->attach($book->id);
    }
    return response()->json(['success' => true]);
}

}
