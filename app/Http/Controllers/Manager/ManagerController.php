<?php

namespace App\Http\Controllers\Manager;

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

    public function __construct()
    {
        $this->middleware('auth:manager');
    }


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


            $xAxis = [];
            $productsCountData = [];
            $ordersCountData = [];
            $revenueCountData = [];
            for($i=6;$i>=0;$i--){
                $singleProductsCountData=0;
                $singleOrderCountData=0;
                $singleRevenueCountData =0;

                $carbonDate = Carbon::today()->subDays($i)->toDateString();
                array_push($xAxis,Carbon::today()->subDays($i)->shortDayName);
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
                $totalWeeklyRevenue+= $revenueCountData[$i];
            }

            $chart = new LarapexChart();

            $chart->setType('line')
                ->setXAxis($xAxis)
                ->setDataset([
                    [
                        'name'  =>  __('manager.products'),
                        'data'  =>  $productsCountData
                    ],
                    [
                        'name'  =>  __('manager.orders'),
                        'data'  =>  $ordersCountData
                    ],
                    [
                        'name'  =>  __('manager.revenues'),
                        'data'  =>  $revenueCountData
                    ],

                ]);



            return view('manager.dashboard')->with([
                'products_count' => $productsCount,
                'revenue' => $revenue,
                'orders_count'=> $shopRevenues->count(),
                'chart'=>$chart,
                'total_weekly_products'=>$totalWeeklyProducts,
                'total_weekly_orders'=>$totalWeeklyOrders,
                'total_weekly_revenue'=>$totalWeeklyRevenue
            ]);
        } else {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You haven\'t any shop yet',
                'message' => 'Please go to your shop and join',
                'redirect_text' => 'Go to Shop',
                'redirect_url' => route('manager.shops.index')
            ]);
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
        $id = auth()->user()->id;
        $manager = Manager::find($id);

        return view('manager.auth.setting', [
            'manager' => $manager
        ]);
    }


    public function update(Request $request)
    {

//        return redirect()->back()->with([
//            'error' => "You can't change in demo mode"
//        ]);
//


        $id = auth()->user()->id;
        $this->validate($request,
            [
                'mobile' => 'required',
                'public_email' => 'required',
                'address' => 'required'
            ]);

        $manager = Manager::find($id);

        if ($request->hasFile('image')) {
            Manager::updateManagerAvatar($request, $id);
        }

        if(isset($request->password)){
            $manager->password = Hash::make($request->password);
        }

        $manager->mobile = $request->get('mobile');
        $manager->public_email = $request->get('public_email');
        $manager->address = $request->get('address');
        if ($manager->save()) {
            return redirect()->back()->with([
                'message' => 'Profile updated'
            ]);
        }
        return redirect()->back()->with([
            'error' => 'Something wrong'
        ]);

    }


    public function destroy($id)
    {

    }


    public function updateLocale($langCode){
        $manager = Manager::find(auth()->user()->id);
        $manager->locale = $langCode;
        if($manager->save()){
            return redirect()->back()->with([
                'message' => 'Language changed'
            ]);
        }else{
            return redirect()->back()->with([
                'error' => 'Something wrong'
            ]);
        }

    }


}
