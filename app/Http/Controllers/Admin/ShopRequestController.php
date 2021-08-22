<?php

namespace App\Http\Controllers\Admin;
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

        $shopRequests = ShopRequest::all();
        $shopRequestObject = [];
        foreach ($shopRequests as $shopRequest){
            $jsonObject['id']=$shopRequest->id;
            $jsonObject['shop'] = Shop::find($shopRequest->shop_id);
            $jsonObject['manager'] = Manager::find($shopRequest->manager_id);
            array_push($shopRequestObject,$jsonObject);
        }

        if($shopRequests->count()>0){
            return view('admin.shop-requests.shop-requests')->with([
                'have_shop_request'=>true,
                'shop_requests'=>$shopRequestObject
            ]);
        }else{
            return view('admin.shop-requests.shop-requests')->with([
                'have_shop_request'=>false,
            ]);
        }


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

        switch ($request->input('action')) {
            case 'accept':
                $shop = Shop::find($request->get('shop_id'));
                $shop->manager_id = $request->get('manager_id');
                if($shop->save() && DB::table('shop_requests')->where('shop_id',$request->get('shop_id'))->delete()){
                    return redirect()->back()->with([
                        'message' => 'Shop has been allocated'
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error' => 'Something wrong'
                    ]);
                }
            case 'decline':
                if(DB::table('shop_requests')->where('id',$request->get('id'))->delete()){
                    return redirect()->back()->with([
                        'message' => 'Shop Request has been cancelled'
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error' =>  'Something wrong'
                    ]);
                }

            default:
                return redirect()->back()->with([
                    'error' =>  'Option is wrong'
                ]);
                break;
        }


    }


    public function destroy($id){
        if(DB::table('shop_requests')->where('id',$id)->delete()){
            return redirect()->back()->with([
                'message'=>'Cancelled shop request'
            ]);
        }else{
            return redirect()->back()->with([
                'error'=>'Something wrong'
            ]);
        }
    }
}
