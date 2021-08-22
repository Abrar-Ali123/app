<?php

namespace App\Http\Controllers;

use App\Helpers\AppSetting;
use App\Models\AppData;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Token;
use Unicodeveloper\Paystack\Facades\Paystack;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function testView(){


        return Product::with('shop','category','subCategory','productImages','productItems','productItems.productItemFeatures')->get();

        $appdata = new AppData();
        $appdata->application_minimum_version=200;
        $appdata->support_payments='1,3';
        $appdata->save();
        dd(AppData::all());

        return;
        return view('test');
    }



    public function test(Request $request){



    }



}
/*
public function index()
{

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
*/
