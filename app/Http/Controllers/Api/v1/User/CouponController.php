<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //TODO : validation in authentication order
    public function index()
    {
        $userId = auth()->user()->id;
        if(Order::where('user_id','=',$userId)->exists()){
            $coupons  = Coupon::where('for_new_user','=',false)->get();
            return $coupons;
        }else{
            $coupons  = Coupon::all();
            return $coupons;
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


    public function edit($id)
    {

    }


    public function update(Request $request)
    {

    }


    public function destroy($id)
    {

    }

}
