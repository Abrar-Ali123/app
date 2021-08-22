<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\Manager\ShopRevenueController;
use App\Models\AppData;
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
            ->orderBy('updated_at', 'DESC')->paginate(10);

        //return $orders;
        return view('user.orders.orders')->with([
            'orders'=>$orders,

        ]);

    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_type' => 'required',
            'shop_id' => 'required',
            'order' => 'required',
            'tax' => 'required',
            'delivery_fee' => 'required',
            'total' => 'required',
            'order_type'=>'required'
        ]);

        if($request->order_type==2){
            $this->validate($request,[
                'address_id' => 'required',
            ],[
                'address_id.required'=>"Please select any address then proceed"
            ]);
        }

        $user = auth()->user();
        $user_id = $user->id;
        $request['user_id'] = $user_id;



        $singleShopId =$request->shop_id;
        $carts = Cart::with('product', 'product.shop', 'product.category', 'product.productImages', 'product.shop.manager','productItem','productItem.productItemFeatures')->where('user_id', '=', $user_id)
            ->where('active', '=', true)->where('shop_id',$singleShopId)->get();


        if(count($carts)==0){
            return redirect(route('user.orders.index'))->with([
                'error' => 'Order is already placed'
            ]);
        }

        foreach ($carts as $cart) {
            if ($cart->order_id) {
                return redirect()->back()->with([
                    'error' => 'This cart is already in another order'
                ]);
            }
            if($singleShopId!=$cart->shop_id) {
                return redirect()->back()->with([
                    'error' => 'Please order items with same shop'
                ]);
            }
        }


        if(isset($request->coupon_id)){
            $couponResponse = UserCouponController::verifyCoupon($user_id,$request->coupon_id);
            if(!$couponResponse['success']) {
                return redirect()->back()->with([
                    'error' => $couponResponse['error']
                ]);
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
            $order->status = $request->payment_type == 1? 1 : 0;
            $order->order_type = $request->order_type;
            if (isset($request->coupon_discount)) {
                $order->coupon_discount = $request->coupon_discount;
            }
            $shop = Shop::find($request->shop_id);
            $order->shop_id = $shop->id;
            $order->latitude = $shop->latitude;
            $order->longitude = $shop->longitude;
            $order->otp = rand(100000,999999);

            $revenue = 0;

            foreach ($carts as $cart) {
                $revenue += ($cart->productItem->revenue * $cart->quantity);
            }

            $admin_revenue = $revenue * $shop->admin_commission/100;
            $shop_revenue = $revenue - $admin_revenue;
            $order->admin_revenue = $admin_revenue;
            $order->shop_revenue = $shop_revenue;



            $order->save();

            foreach ($carts as $cart) {
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

            if(Order::isPaymentByCOD($request->payment_type)){
                return redirect(route('user.orders.index'));
            }else if(Order::isPaymentByRazorpay($request->payment_type)){
                return redirect(route('user.orders_payment.index',['id'=>$order->id]));
            }else if(Order::isPaymentByPaystack($request->payment_type)){
                return redirect(route('user.orders_payment.index',['id'=>$order->id]));
            }else if(Order::isPaymentByStripe($request->payment_type)){
                return redirect(route('user.orders_payment.index',['id'=>$order->id]));
            }


        } else {
            return redirect()->back()->with([
                'error' => 'Something wrong'
            ]);
        }


    }

    public function show($id)
    {

        $order = Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'shop', 'orderPayment','deliveryBoy','carts.productItem','carts.productItem.productItemFeatures')->find($id);

       // return $order;
        return view('user.orders.show-order')->with([
            'order'=>$order
        ]);



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
                        return redirect(route('user.orders.index'))->with([
                            'message' => 'Order cancelled'
                        ]);
                    } else {
                        return redirect()->back()->with([
                            'error' => 'Order status is not changed'
                        ]);
                    }

                } else {
                    return redirect()->back()->with([
                        'error' => 'Order is already accepted. you can\'t cancel'
                    ]);
                }
            }
        }


        if(isset($request->success) & isset($request->payment_id)) {

            $order = Order::with('orderPayment')->find($id);
            $order->status = 1;
            $orderPayment = OrderPayment::find($order->orderPayment->id);
            $orderPayment->success = true;
            $orderPayment->payment_id = $request->payment_id;

            if ($orderPayment->save() && $order->save()) {
                $shopManager = Manager::find(Shop::find($order->shop_id)->manager_id);
                if($shopManager)
                    FCMController::sendMessage("Payment Confirmed","Order payment confirmed by".$user->name, $shopManager->fcm_token);

                return redirect(route('user.orders.index'))->with([
                    'message' => 'Payment Method updated'
                ]);
            } else {
                return redirect()->back()->with([
                    'error' => 'Payment Failed please contact EMall'
                ]);
            }
        }else if(isset($request->status)){
            if($request->status==5){
                $order = Order::find($id);
                if (!ShopRevenueController::storeRevenue($id)) {
                    return redirect()->back()->with([
                        'error' => 'Delivery is in wrong'
                    ]);
                }
                $order->status = $request->status;
                if($order->save()){
                    $shopManager = Manager::find(Shop::find($order->shop_id)->manager_id);
                    if($shopManager)
                        FCMController::sendMessage("Order Delivered","Order delivered from ".$user->name, $shopManager->fcm_token);
                    return redirect()->back()->with([
                        'message' => 'Order is delivered, please rate'
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error' => 'Order status is not changed'
                    ]);

                }
            }
        }

        return redirect()->back()->with([
            'error' => 'Something wrong'
        ]);
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

        $order['product_item_reviews'] = $productReviews;
        $order['shop_review'] = $shopReview;
        $order['delivery_boy_review'] = $deliveryBoyReview;

        //return $order;


        return view('user.orders.review-order')->with([
           'order'=>$order
        ]);

    }

}
