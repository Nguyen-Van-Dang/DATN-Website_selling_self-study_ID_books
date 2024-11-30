<?php

namespace App\Livewire\Client\Book;

use Livewire\Component;
use App\Models\Book;

class BookDetail extends Component
{
    public $bookId, $book, $popularBooks, $favBooks, $relatedBooks;
    public $thumbnail, $gallery1, $gallery2, $gallery3, $gallery4, $gallery5;

    public function mount($id)
    {
        // Truy vấn sách
        $this->getBookContent($id);
        // Tăng lượt xem
        $this->book->increment('views');

        // Lấy các sách phổ biến
        $this->popularBooks = Book::orderBy('views', 'desc')->take(6)->get();

        // Lấy sách được yêu thích
        $this->favBooks = Book::withCount('favorites')
            ->orderByDesc('favorites_count')
            ->limit(6)
            ->get();

        // Lấy sách liên quan
        $this->relatedBooks = Book::whereHas('categories', function ($query) {
            $query->whereIn('id', $this->book->categories->pluck('id'));
        })
            ->where('id', '!=', $this->book->id)
            ->take(6)
            ->get();
    }

    public function getBookContent($id)
    {
        $this->book = Book::findOrFail($id);
        $this->thumbnail = $this->book->images()->where('image_name', 'thumbnail')->first()->image_url;
        $this->gallery1 = $this->book->images()->where('image_name', 'gallery')->get();
    }

    public function render()
    {
        return view('livewire.client.book.book-detail');
    }
}
