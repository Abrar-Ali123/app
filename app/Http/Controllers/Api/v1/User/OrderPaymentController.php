<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helpers\AppSetting;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yabacon\Paystack as Paystack;


class OrderPaymentController extends Controller
{

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

        if(Order::isPaymentByPaystack($request->payment_type)){
            $orderPayment->payment_id = OrderPaymentController::genAccessCode($request->total);
        }


        $orderPayment->save();
        return $orderPayment;
    }

    public static function genAccessCode($amount){
        $paystack = new Paystack(AppSetting::$PAYSTACK_SECRET_KEY);
        try
        {
            $tranx = $paystack->transaction->initialize([
                'amount'=>$amount*100,
                'email'=>AppSetting::$PAYSTACK_EMAIL_ADDRESS,         // unique to customers
                'reference'=>Str::random(16), // unique to transactions
            ]);
            return $tranx->data->access_code;
        }catch(\Yabacon\Paystack\Exception\ApiException $e){
            return null;
        }

    }
}
