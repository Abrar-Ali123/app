<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopReview;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {

        $shop = auth()->user()->shop;
        if ($shop) {
            return $shop;
        } else {
            return response(['errors' => ['You have not any shop yet']], 504);
        }

    }


    public function create()
    {

    }


    public function show($id)
    {
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|unique:shops,email,' . $id,
                'mobile' => 'required|unique:shops,mobile,' . $id,
                'description' => 'required',
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'default_tax' => 'required',
                'minimum_delivery_charge' => 'required',
                'delivery_cost_multiplier' => 'required',
                'admin_commission' => 'required',
                'delivery_range' => 'required',

            ],
            [

            ]);


        $shop = Shop::find($id);

        if (isset($request->image)) {
            Shop::updateShopImageWithApi($request, $id);
        }

        $shop->name = $request->get('name');
        $shop->email = $request->get('email');
        $shop->mobile = $request->get('mobile');
        $shop->description = $request->get('description');
        $shop->address = $request->get('address');
        $shop->latitude = $request->get('latitude');
        $shop->longitude = $request->get('longitude');
        $shop->default_tax = $request->get('default_tax');
        $shop->minimum_delivery_charge = $request->get('minimum_delivery_charge');
        $shop->delivery_cost_multiplier = $request->get('delivery_cost_multiplier');
        $shop->delivery_range = $request->get('delivery_range');
        $shop->admin_commission = $request->get('admin_commission');

        if ($request->get('available_for_delivery')) {
            $shop->available_for_delivery = true;
        } else {
            $shop->available_for_delivery = false;
        }

        if ($request->get('open')) {
            $shop->open = true;
        } else {
            $shop->open = false;
        }

        if ($shop->save()) {
            return response(['message' => ['Shop is saved']], 200);

        } else {
            return response(['errors' => ['Shop is not saved']], 403);

        }
    }


    public function destroy($id)
    {

    }


    public function showReviews()
    {
        $shop = auth()->user()->shop;

        if ($shop) {
            return ShopReview::with('user')->where('shop_id', '=', $shop->id)->get();
        } else {
            return response(['errors' => ['You have not any shop yet']], 504);
        }
    }


}
