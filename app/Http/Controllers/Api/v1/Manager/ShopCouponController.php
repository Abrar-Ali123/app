<?php

namespace App\Http\Controllers\Api\v1\Manager;

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
            return response(['errors' => ['You have not any shop yet']], 504);
        }

        $coupons = Coupon::all();
        $shopCoupons = ShopCoupon::where('shop_id', '=', $shop->id)->get();

        $selectedCoupons = [];
        $unSelectedCoupons = [];
        foreach ($coupons as $coupon) {
            if (self::isCouponContain($shopCoupons, $coupon)) {
                array_push($selectedCoupons, $coupon);
            } else {
                array_push($unSelectedCoupons, $coupon);
            }
        }

        return response(['selected_coupons' => $selectedCoupons,
            'unselected_coupons' => $unSelectedCoupons], 200);

    }

    public static function isCouponContain($shopCoupons, $coupon)
    {
        foreach ($shopCoupons as $shopCoupon) {
            if ($shopCoupon->coupon_id == $coupon->id) {
                return true;
            }
        }
        return false;
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

    public function update(Request $request, $id)
    {


        $shop = auth()->user()->shop;
        if (!$shop) {
            return response(['errors' => ['You have not any shop yet']], 504);

        }

        $shopId = $shop->id;

        $shopCoupon = ShopCoupon::where('shop_id', '=', $shopId)->where('coupon_id', '=', $id)->first();
        if ($shopCoupon) {
            if ($shopCoupon->delete()) {
                return response(['message' => ['Shop coupon deleted']], 200);
            } else {
                return response(['errors' => ['Something wrong']], 403);

            }
        } else {
            $shopCoupon = new  ShopCoupon();
            $shopCoupon->shop_id = $shopId;
            $shopCoupon->coupon_id = $id;
            if ($shopCoupon->save()) {
                return response(['message' => ['Shop coupon added']], 200);
            } else {
                return response(['errors' => ['Something wrong']], 403);

            }
        }
    }

    public function destroy($id)
    {

    }
}
