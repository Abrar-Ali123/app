<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Admin\AdminRevenueController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Controller;
use App\Models\AdminRevenue;
use App\Models\DeliveryBoyRevenue;
use App\Models\Order;
use App\Models\Shop;
use App\Models\ShopRevenue;
use Illuminate\Http\Request;

class ShopRevenueController extends Controller
{
    public function index()
    {

        $shop = auth()->user()->shop;

        if($shop) {
            $shopRevenues = ShopRevenue::with('order', 'order.carts', 'order.carts.product', 'order.carts.product.productImages')->where('shop_id', '=', $shop->id)->paginate(10);
            //return $shopRevenues;
            return view('manager.shop-revenues.shop-revenues')->with([
                'shop_revenues' => $shopRevenues
            ]);
        }
        else{
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'This shop is not yours',
                'message' => 'Please go to your shop',
                'redirect_text' => 'Go to shop',
                'redirect_url' => route('manager.shops.index')
            ]);
        }


    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'order_id'=>'required'
        ]);


    }

    public function show($id)
    {
    }


    public function edit($id)
    {

    }


    public function update(Request $request)
    {

    }


    public function destroy($id){

    }

    static function storeRevenueWithDeliveryBoy($order_id): bool
    {
        $shopRevenueExists = ShopRevenue::where('order_id','=',$order_id)->get();
        $order = Order::with('carts','carts.product','carts.product.shop')->find($order_id);
        $shop = Shop::find($order->shop_id);

        if($shopRevenueExists->count()>0){
            return false;
        }else if(!$order) {
            return false;
        } else{
            $deliveryBoyId = $order->delivery_boy_id;
            $deliveryBoyRevenueExists = DeliveryBoyRevenue::where('order_id','=',$order_id)->get();
            if($deliveryBoyRevenueExists->count()>0){
                return false;
            }
            $shopRevenue = new ShopRevenue();
            $deliveryBoyRevenue = new DeliveryBoyRevenue();
            $productsCount = 0;
            foreach ($order->carts as $cart) {
                $productsCount += $cart->quantity;
                $shopRevenue->shop_id=$cart->product->shop_id;
                $deliveryBoyRevenue->shop_id = $cart->product->shop_id;

            }
            $deliveryBoyRevenue->revenue = $order->delivery_fee;


            $shopRevenue->revenue = $order->shop_revenue;

            $shopRevenue->order_id = $order_id;
            $shopRevenue->products_count = $productsCount;
            $deliveryBoyRevenue->products_count = $productsCount;
            $deliveryBoyRevenue->delivery_boy_id = $deliveryBoyId;
            $deliveryBoyRevenue->order_id = $order_id;



            return $shopRevenue->save() &&
                $deliveryBoyRevenue->save() &&
                AdminRevenueController::storeRevenue($order->admin_revenue,$order_id,$shop->id) &&
                TransactionController::addTransaction($order_id);
        }
    }

    static function storeRevenue($order_id): bool
    {
        $shopRevenueExists = ShopRevenue::where('order_id','=',$order_id)->get();
        $order = Order::with('carts','carts.product','carts.product.shop')->find($order_id);
        $shop = Shop::find($order->shop_id);

        if($shopRevenueExists->count()>0){
            return false;
        }else if(!$order) {
            return false;
        } else{
            $shopRevenue = new ShopRevenue();
            $productsCount = 0;
            foreach ($order->carts as $cart) {
                $productsCount += $cart->quantity;
                $shopRevenue->shop_id=$cart->product->shop_id;
            }

            $shopRevenue->revenue = $order->shop_revenue;
            $shopRevenue->order_id = $order_id;
            $shopRevenue->products_count = $productsCount;

            return $shopRevenue->save() &&
                AdminRevenueController::storeRevenue($order->admin_revenue,$order_id,$shop->id) &&
                TransactionController::addTransaction($order_id);
        }
    }
}
