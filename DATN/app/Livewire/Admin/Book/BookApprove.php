<?php

namespace App\Livewire\Admin\Book;

use Livewire\Component;
use App\Models\Book;
class BookApprove extends Component
{
    public function render()
    {
        $books = Book::where('status', 1)->get();
        return view('livewire.admin.book.book-approve', ['books' => $books]);
    }
}
