<?php

namespace App\Livewire\Admin\Book;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderBook  extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';
    // public function render()
    // {
    //     if (Auth::user()->role_id == 1) {
    //         $Book = Book::paginate(10);
    //     } else {
    //         $Book = Book::where('user_id', Auth::id())->paginate(10);
    //     }
    //     return view('livewire.book.render-book', [
    //         'Book' => $Book,
    //     ]);
    // }

    public function render()
    {
        if (strlen($this->search) >= 1) {
            $Book = Book::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', $this->search)
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            if (Auth::user()->role_id == 1) {
                $Book = Book::paginate(10);
            } else {
                $Book = Book::where('user_id', Auth::id())->paginate(10);
            }
        }

        return view('livewire.admin.book.index-book', [
            'Book' => $Book,
        ]);
    }
}
