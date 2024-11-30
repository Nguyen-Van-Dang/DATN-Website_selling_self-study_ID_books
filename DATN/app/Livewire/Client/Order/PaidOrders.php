<?php

namespace App\Livewire\Client\Order;

use App\Models\Book;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Component;
use App\Models\PaymentMethods;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PaidOrders extends Component
{
    use WithPagination;

    public $Order;
    public $totalPrice;
    public $totalPricePaid;
    public $isDetailPopupOpen = false;
    public $order;

    public function mount()
    {
        $this->Order = Order::where('user_id', Auth::id())
            ->whereIn('payment_status', [1, 3])
            ->with([
                'orderDetails.book.images' => function ($query) {
                    $query->where('image_name', 'thumbnail');
                },
                'orderDetails.course.images' => function ($query) {
                    $query->where('image_name', 'course');
                },
            ])
            ->get();

        $this->totalPrice = $this->Order->sum('price');
        $this->totalPricePaid = $this->Order->sum('price');
    }

    public function openDetailPopup($orderId)
    {
        $this->order = Order::with('orderDetails.book')->find($orderId);
        $this->isDetailPopupOpen = true;
        session(['order_id' => $orderId]);
    }

    public function closeDetailPopup()
    {
        $this->isDetailPopupOpen = false;
        $this->reset(['order']);
    }
    public function render()
    {
        return view('livewire.client.order.paid-order');
    }
}
