<?php

namespace App\Http\Controllers\Api\v1\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\DeliveryBoyRevenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        $deliveryBoyId =  auth()->user()->id;
        return DeliveryBoyRevenue::where('delivery_boy_id','=',$deliveryBoyId)->get();
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

}
