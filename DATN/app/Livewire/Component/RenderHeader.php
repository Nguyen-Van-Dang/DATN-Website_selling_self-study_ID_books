<?php

namespace App\Livewire\Component;

use App\Models\CartDetail;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
        $user = auth::user();
        if (!$user) {
            return; // Hoặc xử lý logic khi người dùng chưa đăng nhập
        }
        // dd($user);
        $this->cartCount = $user->cartDetails->sum('quantity');
        $this->cartItems = $user->cartDetails;
    }

    public function render()
    {
        return view('livewire.component.render-header');
    }

    public function removeFromCart($id)
    {
        $user = auth::user();
        $cartItem = CartDetail::where('id', $id)->where('user_id', $user->id)->first();
        if ($cartItem) {
            $cartItem->delete();
            $this->dispatch('cartUpdated');
            toastr()->success('<p>Sản phẩm đã được xóa khỏi giỏ hàng!</p>');
        }
    }
}
