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
use Illuminate\Http\Request;

class Orders extends Component
{
    use WithPagination;

    public $paymentMethods;
    public $orderId;
    public $selectedPaymentMethod;
    public $order;
    public $isPaymentPopupOpen = false;
    public $isDetailPopupOpen = false;


    public function mount()
    {
        $this->paymentMethods = PaymentMethods::all();
    }

    public function render()
    {
        $deleteOrders = Order::where('payment_status', 0)
            ->where('created_at', '<', now()->subHours(24))
            ->get();

        foreach ($deleteOrders as $order) {
            $order->orderDetails()->delete();
            $order->delete();
        }

        $Order = Order::where('user_id', Auth::id())
            ->with([
                'orderDetails.book.images' => function ($query) {
                    $query->where('image_name', 'thumbnail');
                },
                'orderDetails.course.images' => function ($query) {
                    $query->where('image_name', 'course');
                },
            ])
            ->get();

        $totalPrice = $Order->sum('price');
        $totalPriceUnpaid = $Order->where('payment_status', 0)->sum('price');
        $totalPricePaid = $Order->where('payment_status', 1)->sum('price');

        return view('livewire.client.order.orders', [
            'Order' => $Order,
            'totalPrice' => $totalPrice,
            'totalPriceUnpaid' => $totalPriceUnpaid,
            'totalPricePaid' => $totalPricePaid,
        ]);
    }

    public function openPaymentPopup($orderId)
    {
        $this->orderId = $orderId;
        $this->isPaymentPopupOpen = true;
        session(['order_id' => $this->orderId]);
    }

    public function closePaymentPopup()
    {
        $this->isPaymentPopupOpen = false;
        $this->reset(['orderId', 'selectedPaymentMethod']);
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

    public function orderCheckout(Request $request)
    {
        $data = $request->all();
        $orderId = session('order_id');
        $order = Order::find($orderId);
        if ($data['payment_method'] == 1) {
            $totalPrice = $order->price;
            return $this->momo_payment($order->id, (string) $totalPrice);
        } elseif ($data['payment_method'] == 2) {
            $totalPrice = $order->price;
            return $this->vnpay_payment($order->id, $totalPrice);
        } else {
            $order->payment_methods_id = 3;
            $order->payment_status = 1;
            $order->save();
        }
        $this->closePaymentPopup();

        session()->flash('success', 'Thanh toán thành công!');
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
        $returnUrl = "http://localhost:8000/gio-hang/momo-callback";
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

        // dd($jsonResult);
        if (isset($jsonResult['payUrl'])) {
            return redirect()->to($jsonResult['payUrl']);
        }
    }

    public function vnpay_payment($order, $totalPrice)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/don-hang/vnpay-callback";
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

    public function courseCheckout(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $courseId = $data['course_id'];

        $course = Course::findOrFail($courseId);
        if ($data['payment_method'] == 1) {

            $order = new Order();
            $order->user_id = $user->id;
            $order->price = $course->price;
            $order->user_name = $user->name;
            $order->user_phone = $user->phone;
            $order->payment_methods_id = 1;
            $order->payment_status = 0;
            $order->save();

            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->course_id = $course->id;
            $orderDetail->quantity = 1;
            $orderDetail->save();

            $totalPrice = $order->price;
            return $this->momo_payment($order->id, (string) $totalPrice);
        } else if ($data['payment_method'] == 2) {
            $order = new Order();
            $order->user_id = $user->id;
            $order->price = $course->price;
            $order->user_name = $user->name;
            $order->user_phone = $user->phone;
            $order->payment_methods_id = 1;
            $order->payment_status = 0;
            $order->save();

            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->course_id = $course->id;
            $orderDetail->quantity = 1;
            $orderDetail->save();

            $totalPrice = $order->price;
            return $this->vnpay_payment($order->id, $totalPrice);
        } else {
            return redirect()->back()->with('error', 'Thanh toán không thành công');
        }
    }
}
