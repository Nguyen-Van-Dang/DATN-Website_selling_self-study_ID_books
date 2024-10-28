<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RenderOrder  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if (Auth::user()->role_id == 1) {
            $Order = Order::paginate(10);
        } else {
            $Order = Order::where('user_id', Auth::id())->paginate(10);
        }
        return view('livewire.order.render-order', [
            'Order' => $Order,
        ]);
    }
}