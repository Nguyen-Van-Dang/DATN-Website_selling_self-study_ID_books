<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\CartDetailRepository;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    private CartDetailRepository $cartDetailRepository;

    public function __construct(CartDetailRepository $cartDetailRepository)
    {
        $this->cartDetailRepository = $cartDetailRepository;
    }

    public function getAllCartDetail()
    {
        return $this->cartDetailRepository->getAllCartDetail();
    }
}
