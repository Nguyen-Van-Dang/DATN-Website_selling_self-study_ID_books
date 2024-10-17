<?php

namespace App\Livewire\BookCate;

use App\Models\Book;
use App\Models\CategoryBook;
use Livewire\Component;
use Livewire\WithPagination;

class RenderBookCate  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $bookCate = CategoryBook::paginate(5);

        return view('livewire.bookCate.render-bookCate', [
            'bookCate' => $bookCate,
        ]);
    }
}