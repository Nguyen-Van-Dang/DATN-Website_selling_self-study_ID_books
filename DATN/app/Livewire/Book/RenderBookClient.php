<?php

namespace App\Livewire\Book;

use App\Models\Book;
use App\Models\CartDetail;
use App\Models\Favorite;
use App\Repositories\CartDetailRepository;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderBookClient  extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $Book = Book::getAll();
        return view('livewire.book.render-book-client', ['Book' => $Book]);
    }

    public function addToCart($bookId)
    {

        $book = Book::findOrFail($bookId);
        $user = auth()->user();
        $cartItem = $user->cartDetails()->where('book_id', $bookId)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập!'], 401);
        }
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
        // $this->dispatch('cartUpdated');
        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng!', 'cartCount' => $user->cartDetails->sum('quantity')]);
    }

    public function toggleFavorite($id)
    {
        $book = Book::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập!'], 401);
        }

        $favorite = $user->favorites()->where('book_id', $id)->first();

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

        return response()->json(['success' => true, 'is_favorite' => $is_favorite]);
    }
}
