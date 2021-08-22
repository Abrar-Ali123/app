<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\DistanceUtil;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Models\DeliveryBoy;
use App\Models\DeliveryBoyReview;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryBoyController extends Controller
{

    public function index()
    {
        $shop =  auth()->user()->shop;
        if(!$shop){
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You havn\'t any shop yet',
                'message' => 'Please join any shop and then add product',
                'redirect_text' => 'Join',
                'redirect_url' => route('manager.shops.index')
            ]);
        }


        $deliveryBoys = DeliveryBoy::all();
        return view('manager.delivery-boys.delivery-boys')->with([
            'delivery_boys'=>$deliveryBoys
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


    }


    public function update(Request $request, $id)
    {


    }


    public function destroy($id)
    {


    }


    public function showForAssign($order_id)
    {
        $shop = auth()->user()->shop;
        $order = Order::find($order_id);
        if ($order) {
            if ($order->delivery_boy_id) {
                return view('manager.error-page')->with([
                    'code' => 502,
                    'error' => 'This order has already assign to delivery boy',
                    'message' => 'Please go to your order and track',
                    'redirect_text' => 'Go to Order',
                    'redirect_url' => route('manager.orders.edit', ['id' => $order_id])
                ]);
            } else {
                $delivery_boys = DeliveryBoy::where('is_free', '=', true)
                    ->where('is_offline', '=', false)->get();

                //return $shop->latitude;
                foreach ($delivery_boys as $delivery_boy){
                   $delivery_boy['far_from_shop']=DistanceUtil::distanceBetweenTwoLatLng($shop->latitude,$shop->longitude,$delivery_boy->latitude,$delivery_boy->longitude,);
                }

                return view('manager.delivery-boys.assign')->with([
                    'order_id' => $order_id,
                    'delivery_boys' => $delivery_boys
                ]);
            }
        } else {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'This is order is not for your shop',
                'message' => 'Please go to your order then assign',
                'redirect_text' => 'Go to Order',
                'redirect_url' => route('manager.orders.index')
            ]);
        }

    }

    public function assign($order_id, $delivery_boy_id)
    {


        $order = Order::find($order_id);
        if ($order) {
            if ($order->delivery_boy_id) {
                return view('manager.error-page')->with([
                    'code' => 502,
                    'error' => 'This order has already assign to delivery boy',
                    'message' => 'Please go to your order and track',
                    'redirect_text' => 'Go to Order',
                    'redirect_url' => route('manager.orders.edit', ['id' => $order_id])
                ]);
            } else {
                $order->delivery_boy_id = $delivery_boy_id;
                $deliveryBoy = DeliveryBoy::find($delivery_boy_id);
                $deliveryBoy->is_free = false;
                $order->status = 3;
                $order->save();
                $deliveryBoy->save();
                $user = User::find($order->user_id);
                FCMController::sendMessage("Changed Order Status","Your order ready and wait for delivery boy",$user->fcm_token);
                FCMController::sendMessage('New Order','Body for notification',$deliveryBoy->fcm_token);
                return redirect(route('manager.orders.edit', ['id' => $order_id]))->with([
                    'message' => 'Delivery boy is assigned'
                ]);
            }
        } else {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'This is order is not for your shop',
                'message' => 'Please go to your order then assign',
                'redirect_text' => 'Go to Order',
                'redirect_url' => route('manager.orders.index')
            ]);
        }
    }

    public function getAll(){
        $shop =  auth()->user()->shop;

        $shopDeliveryBoys = DeliveryBoy::where('shop_id','=',$shop->id)->get();
        $allocatedDeliveryBoys = DeliveryBoy::has('shop')->where('shop_id',"!=",$shop->id)->get();
        $unAllocatedDeliveryBoys = DeliveryBoy::doesnthave('shop')->get();


        return view('manager.delivery-boys.manage-delivery-boys')->with([
            'shop_delivery_boys'=>$shopDeliveryBoys,
            'allocated_delivery_boys'=>$allocatedDeliveryBoys,
            'unallocated_delivery_boys'=>$unAllocatedDeliveryBoys,
        ]);
    }


    public function showReviews($id){

        $deliveryBoyReviews =  DeliveryBoyReview::with('user')->where('delivery_boy_id','=',$id)->get();

        return view('manager.delivery-boys.show-reviews-delivery-boy')->with([
            'deliveryBoyReviews'=>$deliveryBoyReviews
        ]);

    }
}
