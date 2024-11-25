<?php

namespace App\Repositories;

use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethods;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function orderList()
    {
        return view('client.payment.orderList');
    }

    public function getAllOrder()
    {
        $Order = Order::getAll();
        return view('admin.order.listOrder', ['Order' => $Order]);
    }
}
