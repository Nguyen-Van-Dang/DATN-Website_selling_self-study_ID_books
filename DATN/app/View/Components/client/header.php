<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CartDetail;
use App\Models\Book;

class header extends Component
{
    public $cartCount;
    public $cartItems;

    public function __construct()
    {
        $this->cartCount = Auth::check() ? CartDetail::where('user_id', Auth::id())->count() : 0;
        $this->cartItems = Auth::check() ? CartDetail::with('book')->where('user_id', Auth::id())->get() : collect();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.header', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
