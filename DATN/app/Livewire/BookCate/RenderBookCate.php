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
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $bookCateQuery = BookCategories::query();

        if (strlen($this->search) >= 1) {
            $bookCateQuery->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', $this->search);
            });
        }

        $bookCateQuery->orderByRaw('status = 0 DESC')
            ->orderBy('id', 'ASC');

        $bookCate = $bookCateQuery->paginate(10);

        return view('livewire.admin.book-category.render-bookCate', [
            'bookCate' => $bookCate,
        ]);
    }
}
