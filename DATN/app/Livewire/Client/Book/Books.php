<?php

namespace App\Livewire\Client\Book;

use App\Models\Book;
use App\Models\BookCategories;
use App\Models\CartDetail;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search_filter = '';
    public $category_filter = '';
    public $time_filter = '';
    public $price_filter = '';
    public $author_filter = '';
    public $books = [];
    public $allBooksCount;
    public $limit = 8;
    public $allBooks = [];
    public $fav_books;
    public $popular_books;
    public $sale_books;
    public $categories;
    public $teachers;

    protected $queryString = [
        'search_filter' => ['except' => ''],
        'category_filter' => ['except' => ''],
        'time_filter' => ['except' => ''],
        'price_filter' => ['except' => ''],
        'author_filter' => ['except' => ''],
    ];

    public function mount()
    {
        $this->categories = BookCategories::all();
        $this->teachers = User::where('role_id', 2)->where('status', 0)->get();
        $this->loadBooks();
        $this->fav_books = $this->getFavouriteBooks();
        $this->popular_books = $this->getPopularBooks();
        $this->sale_books = $this->getSaleBooks();
    }

    public function render()
    {
        return view('livewire.client.book.books');
    }

    public function loadMore()
    {
        $this->limit += 8;
        $this->loadBooks();
    }
    private function loadBooks()
    {
        $query = $this->buildFilteredQuery();
        $this->allBooksCount = $query->count();
        $this->books = $query->take($this->limit)->get();
    }

    /**
     * Hàm xử lý filter sách.
     */
    private function buildFilteredQuery()
    {
        $query = Book::where('status', 0);
        if ($this->search_filter) {
            $query->where('name', 'like', '%' . $this->search_filter . '%');
        }

        if ($this->category_filter) {
            $query->whereHas('categories', function ($q) {
                $q->where('id', $this->category_filter);
            });
        }

        if ($this->time_filter === 'Mới nhất') {
            $query->orderBy('created_at', 'desc');
        } elseif ($this->time_filter === 'Cũ nhất') {
            $query->orderBy('created_at', 'asc');
        }

        if ($this->price_filter) {
            $query->when($this->price_filter, function ($query, $price_filter) {
                switch ($price_filter) {
                    case 'Dưới 100,000đ':
                        $query->where('price', '<', 100000);
                        break;
                    case '100,000đ - 300,000đ':
                        $query->whereBetween('price', [100000, 300000]);
                        break;
                    case '300,000đ - 500,000đ':
                        $query->whereBetween('price', [300000, 500000]);
                        break;
                    case '500,000đ - 700,000đ':
                        $query->whereBetween('price', [500000, 700000]);
                        break;
                    case '700,000đ trở lên':
                        $query->where('price', '>=', 700000);
                        break;
                }
            });
        }

        if ($this->author_filter) {
            $query->where('user_id', 'like', '%' . $this->author_filter . '%');
        }
        $query->orderBy('created_at', 'desc');
        return $query;
    }


    public function updated($propertyName)
    {
        $this->limit = 8;
        $this->loadBooks();
    }

    /**
     * Hàm lấy sách yêu thích.
     */
    private function getFavouriteBooks()
    {
        return Book::withCount('favorites')
            ->orderByDesc('favorites_count')
            ->limit(6)
            ->get();
    }

    /**
     * Hàm lấy sách phổ biến.
     */
    private function getPopularBooks()
    {
        return Book::orderBy('views', 'desc')
            ->take(6)
            ->get();
    }
    private function getSaleBooks()
    {
        return Book::where('discount', '>', 0)
            ->orderBy('discount', 'desc')
            ->take(8)
            ->get();
    }
    public function addToCart($bookId)
    {
        $user = Auth::user();

        if (!$user) {
            return response();
        }

        $cartItem = $user->cartDetails->where('book_id', $bookId)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            $cartItem = new CartDetail();
            $cartItem->user_id = $user->id;
            $cartItem->book_id = $bookId;
            $cartItem->quantity = 1;
            $cartItem->save();
        }

        session()->flash('success', 'Sản phẩm đã được thêm vào giỏ hàng');
        $this->dispatch('cartUpdated');

        return response()->json(['success' => true]);
    }

    public function toggleFavorite($id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập!'], 401);
        }

        $favorite = $user->favorites->where('book_id', $id)->first();

        if ($favorite) {
            $favorite->delete();
            $is_favorite = false;
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $user->id;
            $favorite->book_id = $id;
            $favorite->save();
            $is_favorite = true;
        }

        $new_favorite_count = $book->favorites()->count();

        return response()->json([
            'success' => true,
            'is_favorite' => $is_favorite,
            'new_favorite_count' => $new_favorite_count,
        ]);
    }

    public function goToBookDetail($id)
    {
        return redirect()->route('bookDetail', $id);
    }
}
