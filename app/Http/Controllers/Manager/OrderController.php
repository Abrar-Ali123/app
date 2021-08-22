<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Models\Cart;
use App\Models\Manager;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $shop = Manager::find(auth()->user()->id)->shop;

        if ($shop) {
            $orders =  Order::with('carts','carts.product','carts.product.productImages','orderPayment')
                ->where('shop_id','=',$shop->id)
                ->orderBy('updated_at','DESC')->paginate(10);

           // return Cart::all();

            return view('manager.orders.orders')->with([
                'orders'=>$orders
            ]);
        }
        return view('manager.error-page')->with([
            'code'=>502,
            'error'=> 'You havn\'t any shop yet',
            'message'=> 'Please join any shop and then manage order',
            'redirect_text' => 'Join',
            'redirect_url'=> route('manager.shops.index')
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
    }


    public function edit($id)
    {

        $shop = Manager::find(auth()->user()->id)->shop;
        if ($shop) {
            $order =  Order::with('carts','carts.product','carts.product.productImages','address','user','deliveryBoy','orderPayment','carts.productItem','carts.productItem.productItemFeatures')
                ->where('shop_id','=',$shop->id)
                ->where('id','=',$id)->first();


            if($order){
                $order = $order->toArray();
                return view('manager.orders.edit-order')->with([
                    'order'=>$order
                ]);
            }else{
                return view('manager.error-page')->with([
                    'code'=>502,
                    'error'=> 'This order is not for your shop',
                    'message'=> 'Please go to order and then manage order',
                    'redirect_text' => 'Go to Order',
                    'redirect_url'=> route('manager.orders.index')
                ]);
            }
        }
        return view('manager.error-page')->with([
            'code'=>502,
            'error'=> 'You havn\'t any shop yet',
            'message'=> 'Please join any shop and then manage order',
            'redirect_text' => 'Join',
            'redirect_url'=> route('manager.shops.index')
        ]);



    }


    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'status' => 'required'
        ]);

        $shop = Manager::find(auth()->user()->id)->shop;
        if ($shop) {
            $order = Order::with('carts', 'carts.product', 'carts.product.productImages', 'user','carts.productItem')
                ->where('shop_id', '=', $shop->id)
                ->where('id', '=', $id)->first();



            if ($order) {


                if (Order::isCancelStatus($request->status)) {
                    if (Order::isCancellable($order->status)) {
                        $order->status = $request->status;

                        $fcm_token = $order->user->fcm_token;
                        FCMController::sendMessage("Changed Order Status", "Your order cancelled by seller", $fcm_token);

                        if ($order->save()) {
                            TransactionController::addTransaction($id);
                            return redirect()->back()->with([
                                'message' => 'Order cancelled'
                            ]);
                        } else {
                            return redirect()->back()->with([
                                'error' => 'something wrong'
                            ]);
                        }

                    } else {
                        return redirect()->back()->with([
                            'error' => 'you can\'t cancel this order'
                        ]);
                    }
                }


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
                        if ($cart->productItem->quantity < $cart->quantity) {
                            return redirect()->back()->with([
                                'error' => 'You have not enough quantity'
                            ]);
                        }
                    }
                    foreach ($order->carts as $cart) {
                        $productItem = ProductItem::find($cart->productItem->id);
                        $productItem->quantity = $productItem->quantity - $cart->quantity;
                        $productItem->save();
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
