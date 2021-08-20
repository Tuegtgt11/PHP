<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;

class CheckOutController extends Controller
{
    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index', compact('carts', 'total', 'subtotal'));
    }

    public function addOrder(Request $request){

        //01. Thêm đơn hàng
        $order = Order::create($request->all());
        //02. Thêm chi tiết đơn hàng
        $carts = Cart::content();

        if ( $request->payment_type == 'pay_later') {

            foreach ($carts as $cart){
                $data = [
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'qty' => $cart->qty,
                    'amount' => $cart->price,
                    'total' => $cart->price * $cart->qty,
                ];

                OrderDetail::create($data);
            }

            //03. Gửi Gmail
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendEmail($order, $total, $subtotal);

            //04. Xóa giỏ hàng
            Cart::destroy($order);

            //05. Trả về kết quả
            return redirect('checkout/result')
                ->with('notification', 'Success! you will pay on delivery. Please check your email');
        }

        if ($request->payment_type == 'online_payment'){
            //01. Lấy URL thanh toan VN Pay
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Mô tả đơn hàng ở đây...',
                'vnp_Amount' => Cart::total(0, '', '') * 22832,//nhân với tỉ giá để ra tiền việt
            ]);
            //02. Chuyển hướng tới URL lấy được
            return redirect()->to($data_url);

        }  else{
            return "Online payment method is not supported.";
        }

    }

    public function vnPayCheck(Request $request)
    {
        //01.lấy data từ URL(do VNPay gửi về qua $vnp_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');//mã phản hồi thanh toán.00 = thành công
        $vnp_TxnRef = $request->get('vnp_TxnRef');//tickey_id
        $vnp_Amount = $request->get('vnp_Amount');//số tiền thanh toán.

        //02.Kiểm tra kết quả giao dịch trả về từ VNPay
        if ($vnp_ResponseCode != null){
            //Nếu thành công:
            if ($vnp_ResponseCode == 00){
                //Gửi gmail
                $order = Order::find($vnp_TxnRef);
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendEmail($order, $total, $subtotal);

                //xóa giỏ hàng
                Cart::destroy();

                //Thông báo kết quả thành công
                return redirect('checkout/result')
                    ->with('notification', 'Success! Has paid online. Please check your email');
            }else{
                // Nếu không thành công:
                //Xóa đơn hàng đã thêm vào Database
                Order::find($vnp_TxnRef)->delete();

                //Trả về thông báo lỗi
                return redirect('checkout/result')
                    ->with('notification', 'ERROR: Payment failed or canceled.');
            }
        }
    }

    public function result(){
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }

    private function sendEmail($order, $total, $subtotal) {
        $email_to = $order->email;

        Mail::send('front.checkout.email', compact('order', 'total', 'subtotal'), function ($messages) use ($email_to) {
            $messages->from('codelean@gmail.com', 'CodeLean eCommerce');
            $messages-> to($email_to, $email_to);
            $messages->subject('Order Notification ');
        });
    }


}
