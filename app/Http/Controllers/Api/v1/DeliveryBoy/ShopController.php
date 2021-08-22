<?php

namespace App\Http\Controllers\Api\v1\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\ShopCoupon;

class ShopController extends Controller
{
    public function index()
    {
        $deliveryBoy = auth()->user();
        return Shop::find($deliveryBoy->shop_id);
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


    public function update(Request $request)
    {

    }


    public function destroy($id){

    }


}
