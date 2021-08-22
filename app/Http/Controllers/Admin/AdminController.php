<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRevenue;
use App\Models\DeliveryBoy;
use App\Models\Manager;
use App\Models\ShopRevenue;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

            $adminRevenues = AdminRevenue::all();
            $productsCount=0;
            $revenue=0;
            foreach ($adminRevenues as $adminRevenue) {
                $revenue += $adminRevenue->revenue;
            }


            $xAxis = [];
            $ordersCountData = [];
            $revenueCountData = [];
            for($i=6;$i>=0;$i--){
                $singleOrderCountData=0;
                $singleRevenueCountData =0;

                $carbonDate = Carbon::today()->subDays($i)->toDateString();
                array_push($xAxis,Carbon::today()->subDays($i)->shortDayName);
                $dateAdminRevenue = AdminRevenue::whereDate('created_at', '=', $carbonDate)->get();
                foreach ($dateAdminRevenue as $singleRevenue){
                    $singleOrderCountData++;
                    $singleRevenueCountData+=$singleRevenue->revenue;
                }
                array_push($ordersCountData,$singleOrderCountData);
                array_push($revenueCountData,$singleRevenueCountData);
            }

            $totalWeeklyOrders = 0;
            $totalWeeklyRevenue = 0;

            for($i=0;$i<7;$i++){
                $totalWeeklyOrders += $ordersCountData[$i];
                $totalWeeklyRevenue+= $revenueCountData[$i];
            }

            $chart = new LarapexChart();

            $chart->setType('line')
                ->setXAxis($xAxis)
                ->setDataset([
                    [
                        'name'  =>  'Orders',
                        'data'  =>  $ordersCountData
                    ],
                    [
                        'name'  =>  'Revenues',
                        'data'  =>  $revenueCountData
                    ],

                ]);

            $deliveryBoys = DeliveryBoy::all()->count();

            return view('admin.dashboard')->with([
                'products_count' => $productsCount,
                'revenue' => $revenue,
                'orders_count'=> $adminRevenues->count(),
                'chart'=>$chart,
                'total_weekly_orders'=>$totalWeeklyOrders,
                'total_weekly_revenue'=>$totalWeeklyRevenue,
                'total_delivery_boys'=>$deliveryBoys
            ]);

        }

    public function edit(){
        $id = auth()->user()->id;
        $admin = Admin::find($id);

        return view('admin.auth.setting', [
            'admin' => $admin
        ]);
    }

    public function update(Request $request)
    {

//        return redirect()->back()->with([
//            'error' => "You can't change in demo mode"
//        ]);


        $id = auth()->user()->id;

        $admin = Admin::find($id);
        $this->validate($request,[
            'name'=>'required'
        ]);

        if ($request->hasFile('image')) {
            Admin::updateAdminAvatar($request, $id);
        }

        if(isset($request->password)){
            $admin->password = Hash::make($request->password);
        }

        $admin->name = $request->name;
        if ($admin->save()) {
            return redirect()->back()->with([
                'message' => 'Profile updated'
            ]);
        }
        return redirect()->back()->with([
            'error' => 'Something wrong'
        ]);

    }

    public function updateLocale($langCode){
        $admin = Admin::find(auth()->user()->id);
        $admin->locale = $langCode;
        if($admin->save()){
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
