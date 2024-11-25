<?php

namespace App\Livewire\Client\Cart;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethods;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Carts extends Component
{
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $paymentMethods = PaymentMethods::all();
        $user = Auth::user();
        $Book = Book::where('user_id', Auth::id())->first();
        $cart = CartDetail::where('user_id', Auth::id())->with('book')->get();
        $totalPrice = $cart->sum(function ($item) {
            return $item->book->price * $item->quantity;
        });
        $totalQuantity = $cart->sum(function ($item) {
            return $item->quantity;
        });
        return view('livewire.client.cart.carts', [
            'Book' => $Book,
            'user' => $user,
            'cart' => $cart,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function getAllCartDetail()
    {
        return view('client.payment.shoppingCart');
    }

    public function increaseQuantity($cartItemId)
    {
        $cartItem = CartDetail::find($cartItemId);
        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
            $this->dispatch('cartUpdated');
        }
    }

    public function decreaseQuantity($cartItemId)
    {
        $cartItem = CartDetail::find($cartItemId);
        if ($cartItem && $cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
        }
        $this->dispatch('cartUpdated');
    }

    public function removeFromCart($id)
    {
        $user = Auth::user();
        $cartItem = CartDetail::where('id', $id)->where('user_id', $user->id)->first();
        if ($cartItem) {
            $cartItem->delete();
            toastr()->success('<p>Sản phẩm đã được xóa khỏi giỏ hàng!</p>');
            $this->dispatch('cartUpdated');
        }
    }

    public function checkout(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        if ($data['payment_method'] == 1) {
            $city = $request->input('hiddenCity');
            $district = $request->input('hiddenDistrict');
            $ward = $request->input('hiddenWard');
            $street = $request->input('hiddenStreet');
            $cart = CartDetail::where('user_id', $user->id)->with('book')->get();
            $totalPrice = $data['finalTotal'];
            $order = new Order();
            $order->price = $totalPrice;
            $order->payment_status = 0;
            $order->user_id = $user->id;
            $order->user_name = $data['hiddenFname'];
            $order->user_phone = $data['hiddenPhone'];
            $order->address = "$street, $ward, $district, $city";
            $order->save();
            foreach ($cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                ]);
            }
            CartDetail::where('user_id', $user->id)->delete();
            return $this->momo_payment($order->id, (string) $totalPrice);
        } elseif ($data['payment_method'] == 2) {
            $city = $request->input('hiddenCity');
            $district = $request->input('hiddenDistrict');
            $ward = $request->input('hiddenWard');
            $street = $request->input('hiddenStreet');
            $cart = CartDetail::where('user_id', $user->id)->with('book')->get();
            $totalPrice = $data['finalTotal'];

            $order = new Order();
            $order->price = $totalPrice;
            $order->payment_methods_id = $data['payment_method'];
            $order->payment_status = 0;
            $order->user_id = $user->id;
            $order->user_name = $data['hiddenFname'];
            $order->user_phone = $data['hiddenPhone'];
            $order->address = "$street, $ward, $district, $city";
            $order->save();
            foreach ($cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                ]);
            }
            CartDetail::where('user_id', $user->id)->delete();
            return $this->vnpay_payment($order->id, $totalPrice);
        } else {
            $name = $request->input('hiddenFname');
            $phone = $request->input('hiddenPhone');
            $city = $request->input('hiddenCity');
            $district = $request->input('hiddenDistrict');
            $ward = $request->input('hiddenWard');
            $street = $request->input('hiddenStreet');
            $paymentMethod = $request->input('payment_method');
            $cart = CartDetail::where('user_id', $user->id)->with('book')->get();
            $totalPrice = $data['finalTotal'];

            $order = new Order();
            $order->price = $totalPrice;
            $order->payment_methods_id = $paymentMethod;
            $order->payment_status = 0;
            $order->user_id = $user->id;
            $order->user_name = $name;
            $order->user_phone = $phone;
            $order->address = "$street, $ward, $district, $city";
            $order->save();
            foreach ($cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                ]);
            }
            CartDetail::where('user_id', $user->id)->delete();
            return redirect('/don-hang')->with('success', 'Thanh toán thành công');
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment($order, $totalPrice)
    {
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $totalPrice;
        $orderid = time() . "";
        $returnUrl = "http://localhost:8000/don-hang/momo-callback";
        $notifyurl = "/";
        $bankCode = "SML";
        $extraData = (string) $order;

        $requestId = time() . "";
        $requestType = "payWithMoMoATM";

        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderid . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderid,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        // dd($result);
        $jsonResult = json_decode($result, true);

        error_log(print_r($jsonResult, true));


        if (isset($jsonResult['payUrl'])) {
            return redirect()->to($jsonResult['payUrl']);
        }
    }

    public function momoCallback(Request $request)
    {
        $message = $request->input('message');
        $order = Order::find($request)->first();
        if ($message == "Success") {
            if ($order) {
                $order->payment_status = 1;
                $order->payment_methods_id = 1;
                $order->save();
                return redirect('/don-hang')->with('success', 'Thanh toán thành công');
            }
        } else {
            return redirect('/don-hang')->with('error', 'Thanh toán thất bại');
        }
    }

    public function vnpay_payment($order, $totalPrice)
    {

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/gio-hang/vnpay-callback";
        $vnp_TmnCode = "55GEKX1F";
        $vnp_HashSecret = "86RSGPDYIJMSAZNQ5GVM3O2YC5IJ39H1";
        $order = Order::where('id', $order)->first();
        $vnp_TxnRef = $order->id;
        $vnp_OrderInfo = 'Thanh Toán VNPAY';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $totalPrice * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // dd($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function vnpayCallback(Request $request)
    {
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $vnp_TransactionStatus = $request->input('vnp_TransactionStatus');
        $vnp_TxnRef = $request->input('vnp_TxnRef');

        $order = Order::where('id', $vnp_TxnRef)->first();
        if (!$order) {
            return redirect('/gio-hang')->with('error', 'Đơn hàng không tồn tại');
        }

        $vnp_HashSecret = "86RSGPDYIJMSAZNQ5GVM3O2YC5IJ39H1";
        $vnp_Params = $request->except('vnp_SecureHash');

        ksort($vnp_Params);
        $hashdata = '';
        foreach ($vnp_Params as $key => $value) {
            $hashdata .= urlencode($key) . "=" . urlencode($value) . "&";
        }

        $hashdata = rtrim($hashdata, '&');
        $vnpSecureHashCalculated = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        if ($vnp_SecureHash == $vnpSecureHashCalculated && $vnp_TransactionStatus == '00') {
            $order->payment_status = 1;
            $order->payment_methods_id = 2;
            $order->save();
            return redirect('/don-hang')->with('success', 'Thanh toán thành công');
        } else {
            return redirect('/don-hang')->with('error', 'Thanh toán thất bại');
        }
    }
}
