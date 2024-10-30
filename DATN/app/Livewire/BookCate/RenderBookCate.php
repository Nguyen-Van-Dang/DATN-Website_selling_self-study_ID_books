<?php

namespace App\Livewire\BookCate;

use App\Models\Book;
use App\Models\BookCategories;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderBookCate  extends Component
{
    use WithPagination;
    public $search='';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (strlen($this->search) >= 1) {
            $bookCate = BookCategories::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', $this->search)
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            if (Auth::user()->role_id == 1) {
                $bookCate = BookCategories::paginate(10);
            } else {
                $bookCate = BookCategories::where('user_id', Auth::id())->paginate(10);
            }
        }

        return view('livewire.bookCate.render-bookCate', [
            'bookCate' => $bookCate,
        ]);
    }
}