<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\ShopCoupon;
use Illuminate\Http\Request;

class ShopCouponController extends Controller
{
    public function index()
    {
        $shop = auth()->user()->shop;
        if (!$shop) {
            return view('manager.error-page')->with([
                'code'=>502,
                'error'=> 'You haven\'t any shop yet',
                'message'=> 'Please join any shop and then manage product',
                'redirect_text' => 'Join',
                'redirect_url'=> route('manager.shops.index')
            ]);
        }

        $coupons = Coupon::all();
        $shopCoupons = ShopCoupon::where('shop_id','=',$shop->id)->get();

        $selectedCoupons = [];
        $unSelectedCoupons = [];
        foreach ($coupons as $coupon){
           if(self::isCouponContain($shopCoupons,$coupon)){
               array_push($selectedCoupons,$coupon);
           }else{
               array_push($unSelectedCoupons,$coupon);
           }
        }

        return view('manager.coupons.coupons')->with([
            'selectedCoupons'=>$selectedCoupons,
            'unSelectedCoupons'=>$unSelectedCoupons
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


    public function edit($id)
    {

    }


    public function update(Request $request)
    {

        $shop = auth()->user()->shop;
        if (!$shop) {
            return view('manager.error-page')->with([
                'code'=>502,
                'error'=> 'You havn\'t any shop yet',
                'message'=> 'Please join any shop and then manage product',
                'redirect_text' => 'Join',
                'redirect_url'=> route('manager.shops.index')
            ]);
        }

        $shopId = $shop->id;

        ShopCoupon::where('shop_id','=',$shopId)->delete();
        if(isset($request->coupons)){
            foreach ($request->coupons as $coupon) {
                $shopCoupon = new  ShopCoupon();
                $shopCoupon->shop_id = $shopId;
                $shopCoupon->coupon_id=$coupon;
                $shopCoupon->save();
            }
        }

        return redirect()->back()->with([
            'message' => 'Coupons are updated'
        ]);

        return $request;
    }


    public function destroy($id){

    }


    public  static function isCouponContain($shopCoupons,$coupon){
        foreach($shopCoupons as $shopCoupon){
            if($shopCoupon->coupon_id == $coupon->id){
                return true;
            }
        }
        return false;
    }
}
