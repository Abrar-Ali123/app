<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRevenue;
use App\Models\AppData;
use App\Models\DeliveryBoy;
use App\Models\Manager;
use App\Models\Order;
use App\Models\ShopRevenue;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AppDataController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){


        if(AppData::all()->first()==null){
            AppData::createDummyOne();
        }

        return view('admin.app-data.edit-app-data')->with([
            'appData'=>AppData::all()->last()
        ]);

    }

    public function create(Request $request){

        $support_payments = "";
        if($request->cash_on_delivery){
            $support_payments.=(Order::$ORDER_PT_COD);
            $support_payments .= ",";
        }
        if($request->stripe){
            $support_payments.=(Order::$ORDER_PT_STRIPE);
            $support_payments.= ",";
        }
        if($request->razorpay){
            $support_payments.=(Order::$ORDER_PT_RAZORPAY);
            $support_payments.= ",";
        }
        if($request->paystack){
            $support_payments.=(Order::$ORDER_PT_PAYSTACK);
            $support_payments.=",";
        }

        if(strlen($support_payments)==0){
            return redirect()->back()->with([
                'error' => 'Please select one payment method enable'
            ]);
        }

        $appdata = new AppData();
        $appdata->application_minimum_version = $request->application_minimum_version;
        $appdata->support_payments = $support_payments;

        if( $appdata->save()){
            return redirect()->back()->with([
                'message' => 'App Data changed'
            ]);
        }else{
            return redirect()->back()->with([
                'error' => 'Something wrong'
            ]);
        }


    }



}
