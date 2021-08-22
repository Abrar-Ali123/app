<?php

namespace App\Http\Controllers\Api\v1\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\Manager\ShopRevenueController;
use App\Models\DeliveryBoy;
use App\Models\DeliveryBoyReview;
use App\Models\Manager;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $deliveryBoyId = auth()->user()->id;

        return Order::with('carts', 'carts.product', 'carts.product.productImages', 'shop','deliveryBoyReview','carts.productItem','carts.productItem.productItemFeatures')->where('delivery_boy_id', '=', $deliveryBoyId)
            ->orderBy('status', 'ASC')->orderBy('updated_at', 'DESC')->get();
    }


    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

        return Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'shop')->find($id);

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        $deliveryBoyId = auth()->user()->id;
        $order = Order::with('user')->find($id);



        if (!$order) {
            return response(['errors' => 'This order is not for your'], 422);
        } else if ($order->delivery_boy_id != $deliveryBoyId) {
            return response(['errors' => 'This order is not for your'], 422);
        }
        $deliveryBoy = DeliveryBoy::find($deliveryBoyId);
        if (isset($request->latitude) && isset($request->longitude)) {
            $deliveryBoy->latitude = $request->latitude;
            $deliveryBoy->longitude = $request->longitude;
        }

        if ($order->status > 3) {
            if (isset($request->latitude) && isset($request->longitude)) {
                $order->latitude = $request->latitude;
                $order->longitude = $request->longitude;
            }
        }

        if (isset($request->status)) {
            if ($request->status == 5) {

                $this->validate($request, [
                    'otp' => 'required'
                ]);

                if($order->otp !== $request->otp){
                    return response(['errors' => ['OTP is incorrect']], 422);
                }


                if (!ShopRevenueController::storeRevenueWithDeliveryBoy($order->id)) {
                    return response(['errors' => ['Delivery is in wrong']], 422);
                }

                $deliveryBoy->is_free = true;
            }

            if ($order->status != $request->status) {
                $order->status = $request->status;
                $fcm_token = $order->user->fcm_token;
                if ($request->status == 4) {
                    FCMController::sendMessage("Order status changed", "Your order is picked up and delivery boy is on the way", $fcm_token, 'order');
                } else if ($request->status == 5) {
                    FCMController::sendMessage("Order status changed", "Your order is delivered. Please review our product", $fcm_token, 'order');
                    $shopManager = Manager::find(Shop::find($order->shop_id)->manager_id);
                    if($shopManager)
                        FCMController::sendMessage("Order Delivered","Order delivered", $shopManager->fcm_token);

                }
            }
        }


        if ($order->save() && $deliveryBoy->save()) {
            return response(['message' => ['Your request has been successfully deliver']], 200);

        } else {
            return response(['errors' => ['Something wrong']], 422);
        }

    }


    public function destroy($id)
    {

    }

    public function showReview($id)
    {
        return DeliveryBoyReview::with('user')->where('order_id', '=', $id)->first();
    }
}
