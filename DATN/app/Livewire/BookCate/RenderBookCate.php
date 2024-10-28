<?php

namespace App\Livewire\BookCate;

use App\Models\Book;
use App\Models\CategoryBook;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderBookCate  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if (Auth::user()->role_id == 1) {
            $bookCate = CategoryBook::paginate(10);
        } else {
            $bookCate = CategoryBook::where('user_id', Auth::id())->paginate(10);
        }
        return view('livewire.bookCate.render-bookCate', [
            'bookCate' => $bookCate,
        ]);
    }
}