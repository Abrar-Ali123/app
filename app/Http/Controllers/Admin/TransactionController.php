<?php

namespace App\Http\Controllers\Admin;

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


class TransactionController extends Controller
{
    public function index()
    {


        $shops = Shop::all();

        foreach ($shops as $shop) {
            $shopTransactions = Transaction::where('shop_id', '=', $shop->id)->where('success','=',true)->get();

            $totalAdminToShop = 0;
            $totalShopToAdmin = 0;
            foreach ($shopTransactions as $shopTransaction) {
                $totalAdminToShop += $shopTransaction->admin_to_shop;
                $totalShopToAdmin += $shopTransaction->shop_to_admin;
            }

            $shop['total_admin_to_shop'] = $totalAdminToShop;
            $shop['total_shop_to_admin'] = $totalShopToAdmin;
        }

        $deliveryBoys = DeliveryBoy::all();

        foreach ($deliveryBoys as $deliveryBoy) {
            $deliveryBoysTransactions = Transaction::where('delivery_boy_id', '=', $deliveryBoy->id)->where('success','=',true)->get();

            $totalAdminToDeliveryBoy = 0;
            $totalDeliveryBoyToAdmin = 0;
            foreach ($deliveryBoysTransactions as $deliveryBoysTransaction) {
                $totalAdminToDeliveryBoy += $deliveryBoysTransaction->admin_to_delivery_boy;
                $totalDeliveryBoyToAdmin += $deliveryBoysTransaction->delivery_boy_to_admin;
            }

            $deliveryBoy['total_admin_to_delivery_boy'] = $totalAdminToDeliveryBoy;
            $deliveryBoy['total_delivery_boy_to_admin'] = $totalDeliveryBoyToAdmin;
        }

        $transactions =  Transaction::with('orderPayment', 'deliveryBoy','shop','order')->paginate(10);



        return view('admin.transaction.transactions')->with([
            'transactions' => $transactions,
            'shops'=>$shops,
            'deliveryBoys'=>$deliveryBoys
        ]);
    }


    public function capturePayment($id): \Illuminate\Http\RedirectResponse
    {
        $transaction = Transaction::with('orderPayment', 'deliveryBoy')->find($id);

        if (Order::isPaymentByRazorpay($transaction['orderPayment']['payment_type'])) {

            if ($transaction['captured']) {
                return redirect()->back()->with([
                    'error' => 'Payment captured'
                ]);
            }

            $api = new Api(AppSetting::$RAZORPAY_ID, AppSetting::$RAZORPAY_SECRET);
            $payment = $api->payment->fetch($transaction['orderPayment']['payment_id']);
            try {
                $payment->capture(array('amount' => round($transaction['order']['total'] * 100), 'currency' => AppSetting::$currencyCode));

                $transaction->captured = true;
                if($transaction->save()){
                    return redirect()->back()->with([
                        'message' => 'Payment captured'
                    ]);

                }
                return redirect()->back()->with([
                    'error' => 'Something wrong'
                ]);

            } catch (BadRequestError $e) {

                return redirect()->back()->with([
                    'error' => 'Something wrong'
                ]);
            }

        } else {
            return redirect()->back()->with([
                'error' => 'This is Cash on delivery order'
            ]);
        }

    }

    public function refundPayment($id)
    {
        $transaction = Transaction::with('orderPayment', 'deliveryBoy')->find($id);

        if (Order::isPaymentByRazorpay($transaction['orderPayment']['payment_type'])) {

            if ($transaction['captured']) {
                return redirect()->back()->with([
                    'error' => 'Payment captured'
                ]);
            }
            $api = new Api(AppSetting::$RAZORPAY_ID, AppSetting::$RAZORPAY_SECRET);
            $payment = $api->payment->fetch($transaction['orderPayment']['payment_id']);
            try {
                $payment->capture(array('amount' => round($transaction['order']['total']* 100) , 'currency' => AppSetting::$currencyCode));
                $payment->refund();
                $transaction->refunded = true;
                if($transaction->save()){
                    return redirect()->back()->with([
                        'message' => 'Payment refunded'
                    ]);

                }
                return redirect()->back()->with([
                    'error' => 'Something wrong'
                ]);

            } catch (BadRequestError $e) {
                return $e;
                return redirect()->back()->with([
                    'error' => 'Something wrong'
                ]);
            }

        } else {
            return redirect()->back()->with([
                'error' => 'This is Cash on delivery order'
            ]);
        }

    }



    static function addTransaction($orderId): bool
    {
        $order = Order::find($orderId);
        $orderPayment = OrderPayment::find($order->order_payment_id);

        if(Order::isPaymentByCOD($orderPayment->payment_type) && Order::isCancelStatus($order->status)){
            return true;
        }
        $transaction = new Transaction();

        if(Order::isCancelStatus($order->status)){
            $transaction->success = false;
        }


        if(Order::isPaymentByCOD($orderPayment->payment_type)){
            if( Order::isOrderTypePickup($order->order_type)){
                $transaction->shop_to_admin = $order->admin_revenue;
            }else{
                $transaction->delivery_boy_to_admin =  $order->total -  $order->delivery_fee;
                $transaction->admin_to_shop   = $order->total -  $order->delivery_fee - $order->admin_revenue;
            }
        }else{
            if( Order::isOrderTypePickup($order->order_type)){
                $transaction->admin_to_shop = $order->total -  $order->admin_revenue;
            }else{
                $transaction->admin_to_shop = $order->total -  $order->delivery_fee - $order->admin_revenue;
                $transaction->admin_to_delivery_boy = $order->delivery_fee;
            }
        }


        $transaction->order_id = $orderId;
        $transaction->total = $order->total;
        $transaction->order_payment_id = $orderPayment->id;
        $transaction->admin_revenue = $order->admin_revenue;
        $transaction->shop_id = $order->shop_id;
        $transaction->delivery_boy_id = $order->delivery_boy_id;
        return $transaction->save();
    }
}
