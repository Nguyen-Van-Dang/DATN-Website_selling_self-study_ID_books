<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class RenderOrder  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $Order = Order::paginate(5);

        return view('livewire.order.render-order', [
            'Order' => $Order,
        ]);
    }
}