<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\Manager\ShopRevenueController;
use App\Models\Cart;
use App\Models\DeliveryBoyReview;
use App\Models\Manager;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\ProductReview;
use App\Models\Shop;
use App\Models\ShopReview;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //TODO : validation in authentication order
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $orders = Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'orderPayment')
            ->where('user_id', '=', $user_id)
            ->orderBy('updated_at', 'DESC')->get();
        return $orders;

    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_type' => 'required',
            'carts' => 'required',
            'order' => 'required',
            'tax' => 'required',
            'delivery_fee' => 'required',
            'total' => 'required',
            'status' => 'required',
            'order_type'=>'required'
        ]);

        if($request->order_type==2){
            $this->validate($request,[
                'address_id' => 'required',
            ]);
        }


        $carts = explode(',', $request->carts);

        $singleShopId = Cart::find($carts[0])->shop_id;
        foreach ($carts as $cart_id) {
            $cart = Cart::find($cart_id);
            if ($cart->order_id)
                return response(['errors' => ['This cart is already in another order']], 403);
            if($singleShopId!=$cart->shop_id)
                return response(['errors' => ['Please order items with same shop']], 403);
        }

        $user = auth()->user();
        $user_id = $user->id;
        $request['user_id'] = $user_id;

        if(isset($request->coupon_id)){
            $couponResponse = UserCouponController::verifyCoupon($user_id,$request->coupon_id);
            if(!$couponResponse['success']) {
                return response(['errors' => [$couponResponse['error']]], 403);
            }
        }


        $orderPayment = OrderPaymentController::addPayment($request);
        if ($orderPayment) {
            $order = new Order();
            $order->address_id = $request->address_id;
            $order->order_payment_id = $orderPayment->id;
            $order->user_id = auth()->user()->id;
            $order->coupon_id = $request->coupon_id;
            $order->order = $request->order;
            $order->tax = $request->tax;
            $order->delivery_fee = $request->delivery_fee;
            $order->total = $request->total;
            $order->status = $request->status;
            $order->order_type = $request->order_type;
            if (isset($request->coupon_discount)) {
                $order->coupon_discount = $request->coupon_discount;
            }
            $shop = Cart::find($carts[0])->product->shop;
            $order->shop_id = $shop->id;
            $order->latitude = $shop->latitude;
            $order->longitude = $shop->longitude;
            $order->otp = rand(100000,999999);

            $revenue = 0;

            foreach ($carts as $cart_id) {
                $cart = Cart::with('product', 'productItem')->find($cart_id);
                $revenue += ($cart->productItem->revenue * $cart->quantity);
            }

            $admin_revenue = $revenue * $shop->admin_commission/100;
            $shop_revenue = $revenue - $admin_revenue;
            $order->admin_revenue = $admin_revenue;
            $order->shop_revenue = $shop_revenue;



            $order->save();

            foreach ($carts as $cart_id) {
                $cart = Cart::with('product','productItem')->find($cart_id);
                $product = $cart->product;
                $cart->p_name = $product->name;
                $cart->p_description = $product->description;
                $cart->p_price = $cart->productItem->price;
                $cart->p_revenue = $cart->productItem->revenue;
                $cart->p_offer = $product->offer;
                $cart->order_id = $order->id;
                $cart->active = false;

                $cart->save();
            }

            $order = Order::find($order->id);



            if(isset($request->coupon_id)) {
                $userCoupon = new UserCoupon();
                $userCoupon->user_id = $user_id;
                $userCoupon->coupon_id = $request->coupon_id;
                $userCoupon->save();
            }

            $shopManager = Manager::find(Shop::find($order->shop_id)->manager_id);
            if($shopManager)
                FCMController::sendMessage("New Order","You have new order from ".$user->name, $shopManager->fcm_token);
            return Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'shop')
                ->find($order->id);


        } else {
            return response(['errors' => ['There is something wrong']], 403);
        }


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

        $user = auth()->user();

        if(isset($request->status)) {
            if (Order::isCancelStatus($request->status)) {
                if (Order::isCancellable($order->status)) {
                    $order->status = $request->status;
                    if ($order->save()) {
                        TransactionController::addTransaction($id);
                        $shopManager = Manager::find(Shop::find($order->shop_id)->manager_id);
                        if($shopManager)
                            FCMController::sendMessage("Order cancelled","Order cancelled from ".$user->name, $shopManager->fcm_token);
                        return response(['message' => ['Order status changed']], 200);
                    } else {
                        return response(['errors' => ['Order status is not changed']], 403);
                    }

                } else {
                    return response(['errors' => ['Order is already accepted. you can\'t cancel']], 403);
                }
            }
        }


        if(isset($request->success) & isset($request->payment_id)) {

            $order = Order::with('orderPayment')->find($id);
            $order->status = 1;
            $orderPayment = OrderPayment::find($order->orderPayment->id);
            $orderPayment->success = $request->success;
            $orderPayment->payment_id = $request->payment_id;
            if ($orderPayment->save() && $order->save()) {
                $shopManager = Manager::find(Shop::find($order->shop_id)->manager_id);
                if($shopManager)
                    FCMController::sendMessage("Payment Confirmed","Order payment confirmed by".$user->name, $shopManager->fcm_token);

                return response(['message' => ['Payment Method updated']], 200);
            } else {
                return response(['errors' => ['Payment Failed please contact EMall']], 403);
            }
        }else if(isset($request->status)){
            if($request->status==5){
                $order = Order::find($id);
                if (!ShopRevenueController::storeRevenue($id)) {
                    return response(['errors' => ['Delivery is in wrong']], 422);
                }
                $order->status = $request->status;
                if($order->save()){
                    $shopManager = Manager::find(Shop::find($order->shop_id)->manager_id);
                    if($shopManager)
                        FCMController::sendMessage("Order Delivered","Order delivered from ".$user->name, $shopManager->fcm_token);

                    return response(['message' => ['Order is delivered, please rate']], 200);
                }else{
                    return response(['errors' => ['Order status is not changed']], 403);

                }
            }
        }
        return response(['errors' => ['Body is empty']], 403);
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
