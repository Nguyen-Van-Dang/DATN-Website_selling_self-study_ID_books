<?php

namespace App\Livewire\Order;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DeleteOrder extends Component
{
    public function render()
    {
        $user = Auth::user();
        
        $orderUsers = Order::onlyTrashed()->get();
    
        return view('livewire.order.delete-order', compact('orderUsers'));
    }
    
}
