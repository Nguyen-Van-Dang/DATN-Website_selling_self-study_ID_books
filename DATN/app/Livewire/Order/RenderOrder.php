<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RenderOrder  extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $isDetailPopupOpen = false;
    public $isPaymentPopupOpen = false;
    public $order;
    public $orderId;
    public $payment_status;
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

    public function openPaymentPopup($orderId)
    {
        $this->orderId = $orderId;
        $this->isPaymentPopupOpen = true;

        $order = Order::find($orderId);
        if ($order) {
            $this->payment_status = $order->payment_status;
        }
    }

    public function closePaymentPopup()
    {
        $this->isPaymentPopupOpen = false;
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


    public function updatePaymentStatus()
    {
        $order = Order::find($this->orderId);

        if ($order) {
            $order->payment_status = $this->payment_status;
            $order->save();

            session()->flash('success', 'Trạng thái thanh toán đã được cập nhật.');
            $this->closePaymentPopup();
        } else {
            session()->flash('error', 'Đơn hàng không tồn tại.');
        }
    }
}
