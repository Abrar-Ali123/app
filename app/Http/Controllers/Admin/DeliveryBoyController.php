<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DeliveryBoy;
use App\Models\DeliveryBoyRevenue;
use App\Models\DeliveryBoyReview;
use App\Models\Manager;
use App\Models\Shop;
use App\Models\ShopRevenue;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DeliveryBoyController extends Controller
{
    public function index()
    {
        $deliveryBoys = DeliveryBoy::paginate(10);

        foreach ($deliveryBoys as $deliveryBoy) {
            $ordersCount=0;
            $revenue=0;
            $deliveryBoyRevenues = DeliveryBoyRevenue::where('delivery_boy_id','=',$deliveryBoy->id)->get();
            foreach ($deliveryBoyRevenues as $deliveryBoyRevenue) {
                $ordersCount += 1;
                $revenue += $deliveryBoyRevenue->revenue;
            }
            $deliveryBoy['revenue']=$revenue;
            $deliveryBoy['orders_count']=$ordersCount;
        }

        return view('admin.delivery-boy.delivery-boys')->with([
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


    public function update(Request $request, $id){

    }


    public function destroy($id)
    {

    }


    public function showReviews($id){

         $deliveryBoyReviews =  DeliveryBoyReview::with('user')->where('delivery_boy_id','=',$id)->get();

         return view('admin.delivery-boy.show-reviews-delivery-boy')->with([
             'deliveryBoyReviews'=>$deliveryBoyReviews
         ]);

    }
}
