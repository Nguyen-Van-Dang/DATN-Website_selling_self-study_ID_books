<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderBook  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if (Auth::user()->role_id == 1) {
            $Book = Book::paginate(10);
        } else {
            $Book = Book::where('user_id', Auth::id())->paginate(10);
        }
        return view('livewire.book.render-book', [
            'Book' => $Book,
        ]);
    }
}
