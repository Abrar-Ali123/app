<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\AppSetting;
use App\Models\DeliveryBoy;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Shop;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\BadRequestError;

class    TransactionController extends Controller
{
    public function index()
    {
        $shop = auth()->user()->shop;
        if ($shop) {
            $transactions = Transaction::where('shop_id','=',$shop->id)->where('success','=',true)->get();

            $payToAdmin = 0;
            $takeFromAdmin = 0;
            foreach ($transactions as $transaction) {
                $payToAdmin += $transaction['shop_to_admin'];
                $takeFromAdmin += $transaction['admin_to_shop'];
            }

            $transactions = Transaction::where('shop_id','=',$shop->id)->where('success','=',true)->paginate(10);



            return view('manager.transaction.transactions')->with([
                'transactions' => $transactions,
                'pay_to_admin'=>$payToAdmin,
                'take_from_admin'=>$takeFromAdmin
            ]);
        } else {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You havn\'t any shop yet',
                'message' => 'Please join any shop and then manage product',
                'redirect_text' => 'Join',
                'redirect_url' => route('manager.shops.index')
            ]);
        }
    }

}
