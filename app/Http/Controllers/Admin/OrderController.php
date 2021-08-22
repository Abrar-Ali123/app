<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Models\Manager;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders =  Order::with('carts','carts.product','carts.product.productImages','orderPayment')->orderBy('updated_at','DESC')->paginate(10);

        return view('admin.orders.orders')->with([
            'orders'=>$orders
        ]);

    }


    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $order = Order::with('carts','carts.product','carts.product.productImages','address','user','deliveryBoy','orderPayment','carts.productItem','carts.productItem.productItemFeatures')->find($id)->toArray();
        return view('admin.orders.show-order')->with([
           'order'=>$order
        ]);
    }


    public function edit($id)
    {

        $order =  Order::with('carts','carts.product','carts.product.productImages','address','user','deliveryBoy','orderPayment','carts.productItem','carts.productItem.productItemFeatures')
        ->find($id);


        if($order) {
            $order = $order->toArray();
            return view('manager.orders.edit-order')->with([
                'order' => $order
            ]);
        }
        else{
            return view('admin.error-page')->with([
                'code'=>502,
                'error'=> 'This order is not for your shop',
                'message'=> 'Please go to order and then manage order',
                'redirect_text' => 'Go to Order',
                'redirect_url'=> route('manager.orders.index')
            ]);
        }

    }


    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'status' => 'required'
        ]);

        $shop = Manager::find(auth()->user()->id)->shop;
        if ($shop) {
            $order = Order::with('carts', 'carts.product', 'carts.product.productImages', 'user')
                ->where('shop_id', '=', $shop->id)
                ->where('id', '=', $id)->first();


            if ($order) {
                if(Order::isOrderTypePickup($order->order_type)){
                    if ($request->get('status') > 4) {
                        return redirect()->back()->with([
                            'error' => 'You can\'t perform this'
                        ]);
                    }
                }else {
                    if ($request->get('status') > 3) {
                        return redirect()->back()->with([
                            'error' => 'You can\'t perform this'
                        ]);
                    }
                }
                if ($request->get('status') == 2) {
                    foreach ($order->carts as $cart) {
                        if (Product::find($cart->product->id)->quantity < $cart->quantity) {
                            return redirect()->back()->with([
                                'error' => 'You have not enough quantity'
                            ]);
                        }
                    }
                    foreach ($order->carts as $cart) {
                        $product = Product::find($cart->product->id);
                        $product->quantity = $product->quantity - $cart->quantity;
                        $product->save();
                    }
                }


                $order->status = $request->get('status');

                $fcm_token = $order->user->fcm_token;
                if ($request->get('status') == 2) {
                    FCMController::sendMessage("Changed Order Status", "Your order accepted by seller", $fcm_token);
                }else if($request->get('status') == 3 && Order::isOrderTypePickup($order->order_type)){
                    FCMController::sendMessage("Changed Order Status", "Your order is ready. please pickup from shop", $fcm_token);
                }

                if ($order->save()) {
                    return redirect()->back()->with([
                        'message' => 'Order status changed'
                    ]);
                } else {
                    return redirect()->back()->with([
                        'error' => 'Something went wrong'
                    ]);
                }

            } else {
                return view('manager.error-page')->with([
                    'code' => 502,
                    'error' => 'This order is not in your shop',
                    'message' => 'Please Go to your order and manage',
                    'redirect_text' => 'Go to Order',
                    'redirect_url' => route('manager.orders.index')
                ]);
            }
        } else {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You havn\'t any shop yet',
                'message' => 'Please join any shop and then manage order',
                'redirect_text' => 'Join',
                'redirect_url' => route('manager.shops.index')
            ]);

        }
    }


    public function destroy($id)
    {

    }


}
