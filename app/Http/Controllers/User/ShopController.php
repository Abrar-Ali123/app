<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\ShopCoupon;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        return Shop::has('manager')->get();
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
    }

    public function show($id)
    {
//        $userId = auth()->user()->id;
        $shop =  Shop::with('manager')->find($id);

        $products = Product::with('productImages')->where('shop_id',$id)->paginate(10);

        return view('user.shop.show-shop')->with([
            'shop'=>$shop,
            'products'=>$products
        ]);

    }


    public function edit($id)
    {

    }


    public function update(Request $request)
    {

    }


    public function destroy($id){

    }

    public function getCoupons($id){
        $shopCoupons = ShopCoupon::where('shop_id','=',$id)->get();
        $coupons = [];
        foreach ($shopCoupons as $shopCoupon) {
            array_push($coupons,Coupon::find($shopCoupon->coupon_id));
        }

        return $coupons;
    }


    public function showReviews($id){
        $shop = Shop::with('shopReviews','shopReviews.user')->find($id);
        return view('user.shop.reviews')->with([
            'shop'=>$shop
        ]);
    }



}
