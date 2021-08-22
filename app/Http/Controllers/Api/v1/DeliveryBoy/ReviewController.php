<?php

namespace App\Http\Controllers\Api\v1\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\DeliveryBoyReview;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Rules\RatingRule;
use Illuminate\Http\Request;

class ReviewController extends Controller
{


    public function index()
    {
        $deliveryBoyId = auth()->user()->id;
        return DeliveryBoyReview::with('user')->where('delivery_boy_id','=',$deliveryBoyId)->get();
    }


}
