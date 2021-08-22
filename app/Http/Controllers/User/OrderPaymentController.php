<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class OrderPaymentController extends Controller
{

    public function index($id){

        $order = Order::with('carts','carts.product','carts.productItem','carts.productItem.productItemFeatures','orderPayment')->find($id);

        if($order->orderPayment->success){
            return view('user.error-page')->with([
                'code' => 502,
                'error' => 'Payment success',
                'message' => 'Please go to your orders',
                'redirect_text' => 'Go to orders',
                'redirect_url' => route('user.orders.index')
            ]);
        }

        if(Order::isPaymentByRazorpay($order->orderPayment->payment_type)){
            return view('user.payments.razorpay-payment')->with([
                'order'=>$order
            ]);
        }elseif(Order::isPaymentByPaystack($order->orderPayment->payment_type)){
            return view('user.payments.paystack-payment')->with([
                'order'=>$order
            ]);
        }elseif(Order::isPaymentByStripe($order->orderPayment->payment_type)){
            return view('user.payments.stripe-payment')->with([
                'order'=>$order
            ]);
        }
        return view('user.error-page')->with([
            'code' => 502,
            'error' => 'No gateway',
            'message' => 'Contact to admin',
            'redirect_text' => 'Go to orders',
            'redirect_url' => route('user.orders.index')
        ]);


    }

    public static function makePayment($cardNumber,$expMonth,$expYear,$cvc,$email,$name,$address,$amount)
    {

    }




    public static function addPayment(Request $request): OrderPayment
    {

        $request->validate([
           'payment_type'=>'required',
        ]);

        $orderPayment = new OrderPayment();
        $orderPayment->payment_type = $request->payment_type;
        if(isset($request->payment_id)){
            $orderPayment->payment_id = $request->payment_id;
        }
        if(isset($request->success)){
            $orderPayment->success = $request->success;
        }
        $orderPayment->save();
        return $orderPayment;
    }


    public static function paystackPayment()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();

        }catch(\Exception $e) {
            return $e;
            //return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }

    }



    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $orderId = $paymentDetails['data']['metadata']['order_id'];

        if($paymentDetails['status']){
            $order = Order::with('orderPayment')->find($orderId);
            $order->status = 1;
            $orderPayment = $order->orderPayment;
            $orderPayment->success = true;
            $orderPayment->payment_id=$paymentDetails['data']['reference'];
            $order->save();
            $orderPayment->save();

            return redirect(route('user.orders.index'));

        }else{
            return redirect(route('user.orders.index'))->with([
                'error'=>"Payment Cancelled"
            ]);

        }

        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
    public function handleStripePaymentCallback(Request $request)
    {

        $orderId = $request->order_id;


        if($request->stripeToken){
            $order = Order::with('orderPayment')->find($orderId);
            $order->status = 1;
            $orderPayment = $order->orderPayment;
            $orderPayment->success = true;
            $orderPayment->payment_id=$request->stripeToken;
            $order->save();
            $orderPayment->save();

            return redirect(route('user.orders.index'));

        }else{
            return redirect(route('user.orders.index'))->with([
                'error'=>"Payment Cancelled"
            ]);

        }

    }



    public function stripePaymentViaMobile(Request $request,$order_id){

        $order = Order::with('carts','carts.product','carts.productItem','carts.productItem.productItemFeatures','orderPayment')->find($order_id);

        if($order){

        if($order->orderPayment->success){
            return view('user.error-page')->with([
                'code' => 502,
                'error' => 'Payment success',
                'message' => 'Please go to your orders',
                'redirect_text' => 'Go to orders',
                'redirect_url' => route('user.orders.index')
            ]);
        }

        return view('user.mobile.stripe-payment')->with([
            'order'=>$order
        ]);
        }else{
            return redirect(route('user.dashboard'));
        }

    }

    public function stripeCallbackViaMobile(Request $request)

    {


        $orderId = $request->order_id;


        if($request->stripeToken){
            $order = Order::with('orderPayment')->find($orderId);
            $order->status = 1;
            $orderPayment = $order->orderPayment;
            $orderPayment->success = true;
            $orderPayment->payment_id=$request->stripeToken;
            $order->save();
            $orderPayment->save();

            return view('user.mobile.stripe-payment-done');

        }else{
            return redirect()->back();

        }

    }


}
