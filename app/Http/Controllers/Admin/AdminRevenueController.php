<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRevenue;
use Illuminate\Http\Request;

class AdminRevenueController extends Controller
{


    static function storeRevenue($revenue,$orderId,$shopId){
        $adminRevenue =  new AdminRevenue();
        $adminRevenue->revenue = $revenue;
        $adminRevenue->shop_id = $shopId;
        $adminRevenue->order_id = $orderId;

        return $adminRevenue->save();
    }


}
