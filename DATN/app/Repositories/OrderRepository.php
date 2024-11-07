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



    public function getAllOrder()
    {
        $Order = Order::getAll();
        return view('admin.order.listOrder', ['Order' => $Order]);
    }

    public function checkout($request)
    {
        $user = Auth::user();

        $name = $request->input('hiddenFname');
        $phone = $request->input('hiddenPhone');
        $city = $request->input('hiddenCity');
        $district = $request->input('hiddenDistrict');
        $ward = $request->input('hiddenWard');
        $street = $request->input('hiddenStreet');
        $paymentMethod = $request->input('payment_method');
        $cart = CartDetail::where('user_id', $user->id)->with('book')->get();
        $totalPrice = $cart->sum(fn($item) => $item->book->price * $item->quantity);

        $order = new Order();
        $order->price = $totalPrice;
        $order->payment_methods_id = $paymentMethod;
        $order->user_id = $user->id;
        $order->user_name = $name;
        $order->user_phone = $phone;
        $order->address = "$street, $ward, $district, $city";
        // dd($order);
        $order->save();

        // Thêm chi tiết đơn hàng
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'book_id' => $item->book_id,
                'quantity' => $item->quantity,
            ]);
        }

        // Xóa giỏ hàng
        CartDetail::where('user_id', $user->id)->delete();
        return redirect()->back()->with('success', 'Đặt hàng thành công!');
    }
}
