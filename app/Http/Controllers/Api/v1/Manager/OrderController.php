<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\Manager\ShopRevenueController;
use App\Models\Cart;
use App\Models\DeliveryBoyReview;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\ProductReview;
use App\Models\ShopReview;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //TODO : validation in authentication order
    public function index(Request $request)
    {


        $shop = auth()->user()->shop;
        if($shop) {
            $orders = Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'orderPayment')
                ->where('shop_id', '=', $shop->id)
                ->orderBy('updated_at', 'DESC')->get();
            return $orders;
        }
        return response(['errors' => ['You have not any shop yet']], 504);

    }

    public function create()
    {

    }


    public function store(Request $request)
    {

    }

    public function show($id)
    {

        return Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'shop', 'orderPayment','deliveryBoy')
            ->find($id);

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

        $order = Order::find($id);

        if(isset($request->status)) {
            if (Order::isCancelStatus($request->status)) {
                if (Order::isCancellable($order->status)) {
                    $order->status = $request->status;
                    if ($order->save()) {
                        FCMController::sendMessage("Order cancelled","Your order is cancelled by shop",User::find($order->user_id)->fcm_token);
                        TransactionController::addTransaction($id);
                        return response(['message' => ['Order status changed']], 200);
                    } else {
                        return response(['errors' => ['Order status is not changed']], 403);
                    }

                } else {
                    return response(['errors' => ['Order is already accepted. you can\'t cancel']], 403);
                }
            }
        }

        $order->status = $request->status;

        if ($order->save()) {
            $fcm_token = User::find($order->user_id)->fcm_token;
            if ($request->get('status') == 2) {
                FCMController::sendMessage("Changed Order Status", "Your order accepted by seller", $fcm_token);
            }else if($request->get('status') == 3 && Order::isOrderTypePickup($order->order_type)){
                FCMController::sendMessage("Changed Order Status", "Your order is ready. please pickup from shop", $fcm_token);
            }
            return response(['message' => ['Status updated']]);
        }
        else
            return response(['errors' => ['Something wrong']], 403);
    }


    public function destroy($id)
    {

    }

    public function showReviews($id)
    {
        $user_id = auth()->user()->id;
        $order =  Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'shop', 'orderPayment','deliveryBoy','carts.productItem','carts.productItem.productItemFeatures')
            ->find($id);

        $productReviews = ProductReview::where('order_id','=',$order->id)->get();
        $shopReview = ShopReview::where('user_id','=',$user_id)->first();
        $deliveryBoyReview = DeliveryBoyReview::where('order_id','=',$order->id)->first();

        $order['product_reviews'] = $productReviews;
        $order['shop_review'] = $shopReview;
        $order['delivery_boy_review'] = $deliveryBoyReview;


        return $order;

    }

}
