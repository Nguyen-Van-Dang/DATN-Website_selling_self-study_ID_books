<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\PaymentMethods;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartDetailRepository
{
    public function __construct()
    {
        //
    }
    public function getAllPaymentMethods()
    {
        return view('shopping-cart', compact('paymentMethods'));
    }

    public function getAllCartDetail()
    {
        $paymentMethods = PaymentMethods::all();
        $user = Auth::user();
        $cart = CartDetail::where('user_id', Auth::id())->with('book')->get();
        $totalPrice = $cart->sum(function ($item) {
            return $item->book->price * $item->quantity;
        });
        $totalQuantity = $cart->sum(function ($item) {
            return $item->quantity;
        });

        return view('client.payment.shoppingCart', [
            'user' => $user,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'cart' => $cart,
            'paymentMethods' => $paymentMethods,
        ]);
    }
}
