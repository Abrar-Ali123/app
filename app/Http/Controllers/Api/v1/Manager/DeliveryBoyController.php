<?php

namespace App\Http\Controllers\Api\v1\Manager;


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

        if($shop) {
            $order = Order::find($order_id);

            if ($order) {
                if ($order->delivery_boy_id) {
                    return response(['errors' => ['Order has already assign delivery boy']], 403);
                }

                else {

                    $delivery_boys = DeliveryBoy::where('is_free', '=', true)
                        ->where('is_offline', '=', false)->get();


                    foreach ($delivery_boys as $delivery_boy) {
                        $delivery_boy['far_from_shop'] = DistanceUtil::distanceBetweenTwoLatLng($shop->latitude, $shop->longitude, $delivery_boy->latitude, $delivery_boy->longitude,);
                    }

                    return $delivery_boys;
                }
            } else {
                return response(['errors' => ['Something wrong']], 403);
            }
        }
        return response(['errors' => ['You have not any shop yet']], 504);


    }

    public function assign($order_id, $delivery_boy_id)
    {


        $order = Order::find($order_id);
        if ($order) {
            if ($order->delivery_boy_id) {
                return response(['errors' => ['Order has already assign delivery boy']], 403);
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
                return response(['message' => ['Delivery boy assigned']], 200);
            }
        } else {
            return response(['errors' => ['Order not for yours']], 403);
        }
    }

    public function getAll(){
        $shop =  auth()->user()->shop;

        if($shop) {
            $shopDeliveryBoys = DeliveryBoy::where('shop_id', '=', $shop->id)->get();
            $allocatedDeliveryBoys = DeliveryBoy::has('shop')->where('shop_id', "!=", $shop->id)->get();
            $unAllocatedDeliveryBoys = DeliveryBoy::doesnthave('shop')->get();

            return response(['shop_delivery_boys' => $shopDeliveryBoys,
                'allocated_delivery_boys' => $allocatedDeliveryBoys,
                'unallocated_delivery_boys' => $unAllocatedDeliveryBoys], 200);
        }
        return response(['errors' => ['You have not any shop yet']], 504);



    }

    public function manage($id){
        $shop = auth()->user()->shop;
        if(!$shop){
            return response(['errors' => ['You have not any shop yet']], 504);
        }

        $deliveryBoy = DeliveryBoy::find($id);
        if(!$deliveryBoy->shop_id)
            $deliveryBoy->shop_id = $shop->id;
        elseif ($deliveryBoy->shop_id == $shop->id){
            $deliveryBoy->shop_id = null;
        }else{
            return response(['errors' => ['You can\'t allocate this delivery boy']], 403);

        }
        if($deliveryBoy->save()){
            return response(['message' => ['Allocation successful']], 200);

        }else{
            return response(['errors' => ['Something wrong']], 403);

        }
    }

    public function showReviews($id){

        $deliveryBoyReviews =  DeliveryBoyReview::with('user')->where('delivery_boy_id','=',$id)->get();

        return view('manager.delivery-boys.show-reviews-delivery-boy')->with([
            'deliveryBoyReviews'=>$deliveryBoyReviews
        ]);

    }
}
