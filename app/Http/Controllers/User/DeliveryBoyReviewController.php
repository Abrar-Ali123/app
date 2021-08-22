<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Models\DeliveryBoy;
use App\Models\DeliveryBoyReview;
use App\Models\Order;
use App\Rules\RatingRule;
use Illuminate\Http\Request;

class DeliveryBoyReviewController extends Controller
{


    public function store(Request $request)
    {

        $this->validate($request, [
            'order_id' => 'required',
            'rating' => [
                'required',
                new RatingRule()
            ],
        ]);

        $user_id = auth()->user()->id;
        $order = Order::find($request->order_id);

        if ($order) {
            if(!$order->delivery_boy_id)
                return response(['errors' => ['This order haven\'t any delivery boy']], 403);
            $deliveryBoyReview = DeliveryBoyReview::where('order_id', '=', $order->id)->get();
            if ($deliveryBoyReview->count() > 0) {
                return redirect()->back()->with([
                    'error' => 'This delivery boy is already reviewed'
                ]);
            }

            $deliveryBoy = DeliveryBoy::find($order->delivery_boy_id);
            $total_rating = $deliveryBoy->total_rating;
            $deliveryBoy->rating = ($deliveryBoy->rating * $total_rating + $request->rating) / ($total_rating + 1);
            $deliveryBoy->total_rating = $total_rating+1;

            $deliveryBoyReview = new DeliveryBoyReview();
            $deliveryBoyReview->rating = $request->rating;
            $deliveryBoyReview->review = $request->review;
            $deliveryBoyReview->user_id = $user_id;
            $deliveryBoyReview->order_id = $request->order_id;
            $deliveryBoyReview->delivery_boy_id = $order->delivery_boy_id;
            if($deliveryBoyReview->save() && $deliveryBoy->save()) {
                FCMController::sendMessage("Rating", "You have a new rating added",$deliveryBoy->fcm_token);
                return redirect()->back()->with([
                    'message' => 'This delivery boy is been reviewed'
                ]);
            }
        }else {
            return redirect()->back()->with([
                'error' => 'This order is not available'
            ]);
        }
        return redirect()->back()->with([
            'error' => 'There is something wrong'
        ]);
    }


}
