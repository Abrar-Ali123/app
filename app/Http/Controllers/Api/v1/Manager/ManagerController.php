<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Helpers\AppSetting;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\ShopRevenue;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{

    public function index()
    {

        $shop = Manager::find(auth()->user()->id)->shop;
        if ($shop) {
            $shopRevenues = ShopRevenue::where('shop_id','=',$shop->id)->get();
            $productsCount=0;
            $revenue=0;
            foreach ($shopRevenues as $shopRevenue) {
                $productsCount += $shopRevenue->products_count;
                $revenue += $shopRevenue->revenue;
            }


            $productsCountData = [];
            $ordersCountData = [];
            $revenueCountData = [];
            for($i=6;$i>=0;$i--){
                $singleProductsCountData=0;
                $singleOrderCountData=0;
                $singleRevenueCountData =0;

                $carbonDate = Carbon::today()->subDays($i)->toDateString();
                $dateShopRevenue = ShopRevenue::whereDate('created_at', '=', $carbonDate)->where('shop_id','=',$shop->id)->get();
                foreach ($dateShopRevenue as $singleRevenue){
                    $singleOrderCountData++;
                    $singleProductsCountData+=$singleRevenue->products_count;
                    $singleRevenueCountData+=$singleRevenue->revenue;
                }
                array_push($productsCountData,$singleProductsCountData);
                array_push($ordersCountData,$singleOrderCountData);
                array_push($revenueCountData,$singleRevenueCountData);
            }

            $totalWeeklyProducts = 0;
            $totalWeeklyOrders = 0;
            $totalWeeklyRevenue = 0;

            for($i=0;$i<7;$i++){
                $totalWeeklyProducts += $productsCountData[$i];
                $totalWeeklyOrders += $ordersCountData[$i];
                $totalWeeklyRevenue += $revenueCountData[$i];
            }

            return response(['products_count' => $productsCount,
                'revenue' => $revenue,
                'orders_count'=> $shopRevenues->count(),
                'products_count_data'=>$productsCountData,
                'orders_count_data'=>$ordersCountData,
                'revenue_count_data'=>$revenueCountData,
                'total_weekly_products'=>$totalWeeklyProducts,
                'total_weekly_orders'=>$totalWeeklyOrders,
                'total_weekly_revenue'=>$totalWeeklyRevenue]);
        }
        else {
            return response(['errors' => ['You have not any shop yet']], 504);
        }

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


    public function edit()
    {

    }


    public function update(Request $request)
    {



    }


    public function destroy($id)
    {

    }



}
