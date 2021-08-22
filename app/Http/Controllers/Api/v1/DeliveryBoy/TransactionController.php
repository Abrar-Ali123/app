<?php

namespace App\Http\Controllers\Api\v1\DeliveryBoy;

use App\Helpers\AppSetting;
use App\Models\DeliveryBoy;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Shop;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\BadRequestError;

class TransactionController extends Controller
{
    public function index()
    {
        $deliveryBoyId = auth()->user()->id;
        return Transaction::where('delivery_boy_id', '=', $deliveryBoyId)->where('success','=',true)->get();

    }
}
