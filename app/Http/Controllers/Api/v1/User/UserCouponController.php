<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class UserCouponController extends Controller
{



    public function index(){

    }


    public function getForShop($id){

        $userId = auth()->user()->id;

        return UserCoupon::getForShop($userId,$id);

    }





    public static function verifyCoupon($userId,$couponId){
        $coupon = Coupon::find($couponId);
        if($coupon){
            $isCouponUsed = UserCoupon::where('user_id','=',$userId)->where('coupon_id','=',$couponId)->exists();
            if($coupon->for_only_one_time && $isCouponUsed){
                return [
                    "success"=>false,
                    "error"=>"This coupon is already used by you"
                ];
            }elseif ($coupon->for_new_user && $isCouponUsed){
                return [
                    "success"=>false,
                    "error"=>"This coupon is only for new users"
                ];
            }
            return [
                "success"=>true
            ];
        }else{
            return [
                "success"=>false,
                "error"=>"This coupon is not available"
            ];
        }


    }



}
