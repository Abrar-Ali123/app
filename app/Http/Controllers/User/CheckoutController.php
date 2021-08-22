<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AppData;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\ProductItem;
use App\Models\ShopCoupon;
use App\Models\UserAddress;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {

        $this->validate($request, [
            'shop_id'=>'required',
        ]);
        $user_id = auth()->user()->id;



        $carts = Cart::with('product', 'product.shop', 'product.category', 'product.productImages', 'product.shop.manager','productItem','productItem.productItemFeatures')->where('user_id', '=', $user_id)
            ->where('active', '=', true)->where('shop_id',$request->shop_id)->get();

        if(count($carts)==0){
            return redirect(route('user.orders.index'))->with([
                'error' => 'Order is already placed'
            ]);
        }

        $userAddresses =  UserAddress::where('user_id',$user_id)->get();

        $coupons = UserCoupon::getForShop($user_id,$request->shop_id);

        return view('user.orders.checkout')->with([
            'carts'=>$carts,
            'userAddresses'=>$userAddresses,
            'coupons'=>$coupons,
            'appData'=>AppData::getLast()
        ]);
    }

    public function create()
    {

    }



}
