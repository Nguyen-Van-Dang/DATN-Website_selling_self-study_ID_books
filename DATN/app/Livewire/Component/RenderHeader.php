<?php

namespace App\Livewire\Component;

use App\Models\CartDetail;
use Livewire\Component;

class RenderHeader extends Component
{
    public $cartCount;
    public $cartItems;

    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        $user = auth()->user();
        $this->cartCount = $user->cartDetails->sum('quantity');
        $this->cartItems = $user->cartDetails;
    }

    public function render()
    {
        return view('livewire.component.render-header');
    }

    public function removeFromCart($id)
    {
        $user = auth()->user();

        $cartItem = CartDetail::where('id', $id)->where('user_id', $user->id)->first();

        if ($cartItem) {
            $cartItem->delete();
            $this->dispatch('cartUpdated');
            return response()->json(['success' => true, 'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!']);
        }
    }
}
