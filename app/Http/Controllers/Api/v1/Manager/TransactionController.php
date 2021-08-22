<?php

namespace App\Http\Controllers\Api\v1\Manager;

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
        $shop = auth()->user()->shop;
        if ($shop) {
            return Transaction::where('shop_id','=',$shop->id)->where('success','=',true)->get();
        } else {
            return response(['errors' => ['You have not any shop yet']], 504);
        }
    }

}
