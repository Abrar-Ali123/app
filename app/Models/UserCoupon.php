<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed coupon_id
 * @property mixed user_id
 */
class UserCoupon extends Model
{
    use HasFactory;


    public static function getForShop($userId,$shopId){

        $isUserNew = !Order::where('user_id',$userId)->exists();



        $shopCoupons = ShopCoupon::with('coupon')->where('shop_id',$shopId)->get();

        $coupons = [];

        foreach($shopCoupons as $shopCoupon){
            if($shopCoupon->coupon->is_active) {
                if (!$isUserNew) {
                    if (!$shopCoupon->coupon->for_new_user) {
                        if ($shopCoupon->coupon->for_only_one_time) {

                            if (!Order::where('coupon_id', $shopCoupon->coupon->id)->where('user_id', $userId)->exists()) {
                                array_push($coupons, $shopCoupon->coupon);
                            }
                        } else {
                            array_push($coupons, $shopCoupon->coupon);
                        }
                    }
                } else {
                    if ($shopCoupon->coupon->for_only_one_time) {
                        if (!Order::where('coupon_id', $shopCoupon->coupon->id)->where('user_id', $userId)->exists()) {
                            array_push($coupons, $shopCoupon->coupon);
                        }
                    } else {
                        array_push($coupons, $shopCoupon->coupon);
                    }
                }
            }

        }


        return $coupons;


    }

}
