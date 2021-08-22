<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Shop;
use App\Models\ShopRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopRequestController extends Controller
{

    public function index()
    {

        $shopRequest = ShopRequest::where('manager_id', auth()->user()->id)->first();
        if ($shopRequest) {
            $shop = Shop::find($shopRequest->shop_id);
            return response(['requested'=>true,'shop'=>$shop]);
        }
        $shops = Shop::doesnthave('manager')->get();
        return response(['requested'=>false,'shops'=>$shops]);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {

        $manager = auth()->user();
        $managerId = $manager->id;


        $this->validate($request,[
            'shop_id'=>'required'
        ]);

        if(ShopRequest::where('manager_id',$managerId)->exists()){
            return response(['errors' => ['You already request a shop']], 403);

        }

        if($manager->shop){
            return response(['errors' => ['You have already a shop']], 403);

        }


        $shopRequest = new ShopRequest();
        $shopRequest->shop_id = $request->get('shop_id');
        $shopRequest->manager_id = auth()->user()->id;
        if($shopRequest->save()) {
            return response(['message' => ['Request sent']], 200);
        }
        return response(['error' => ['Request was not sent']], 403);

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


    public function destroy(){
        $managerId=auth()->user()->id;
        if(ShopRequest::where('manager_id',$managerId)->delete()){
            return response(['message' => ['Request deleted']], 200);
        }
        return response(['errors' => ['Request was not deleted']], 403);
    }
}
