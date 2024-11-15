<?php

namespace App\Livewire\Client\Book;

use App\Models\Book;
use App\Models\CartDetail;
use App\Models\Favorite;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Books extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $Book = Book::query()->paginate(16);
        return view('livewire.client.book.books', ['Book' => $Book]);
    }

    public function addToCart($bookId)
    {
        $user = auth::user();
        if (!$user) {
            return response();
        }
        $cartItem = $user->cartDetails()->where('book_id', $bookId)->first();

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

        return response()->json([
            'success' => true,
        ]);
    }

    public function toggleFavorite($id)
    {
        $book = Book::findOrFail($id);
        $user = auth::user();

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

    public function goToBookDetail($id)
    {
        return redirect()->route('bookDetail', $id);
    }
}
