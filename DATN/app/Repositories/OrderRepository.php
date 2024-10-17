<?php

namespace App\Repositories;
use App\Models\Order;

class OrderRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllOrder() {
        $Order = Order::getAll();
        return view('admin.order.listOrder', ['Order' => $Order]);
    }
}
