<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrder()
    {
        return $this->orderRepository->getAllOrder();
    }

    public function checkout(Request $request)
    {
        return $this->orderRepository->checkout($request);
    }
}
