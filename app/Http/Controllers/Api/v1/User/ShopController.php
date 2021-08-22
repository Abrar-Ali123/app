<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helpers\DistanceUtil;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\UserAddress;
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
        $userId = auth()->user()->id;
        $shop =  Shop::with('products','manager','products.productImages','products.productItems','products.productItems.productItemFeatures')->find($id)->toArray();
        $products = $shop['products'];
        $newProducts = [];
        foreach ($products as $product){
            if(Favorite::where('user_id','=',$userId)->where('product_id','=',$product['id'])->exists()){
                $product['is_favorite'] = true;
            }else{
                $product['is_favorite'] = false;
            }
            array_push($newProducts,$product);
        }
        $shop['products'] = $newProducts;
        return $shop;

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

    public function getShopsFromUserAddress($user_address_id): array
    {
        $userAddress = UserAddress::find($user_address_id);
        $allShops = Shop::has('manager')->get();

        $shops = [];
        foreach ($allShops as $shop){
            if(DistanceUtil::isValidForDelivery($shop,$userAddress)){
              array_push($shops,$shop);
            }
        }

        return $shops;
    }




}
