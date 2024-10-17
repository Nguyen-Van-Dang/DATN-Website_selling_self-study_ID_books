<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class RenderBook  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $Book = Book::paginate(5);

        return view('livewire.book.render-book', [
            'Book' => $Book,
        ]);
    }
}