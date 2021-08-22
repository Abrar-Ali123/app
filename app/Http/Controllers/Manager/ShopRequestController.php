<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\ShopRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopRequestController extends Controller
{

    public function index()
    {


    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        //TODO : add validation


        $this->validate($request,[
            'manager_id'=>'required|unique:shop_requests'
        ]);

        if(Manager::find($request->get('manager_id'))->shop){
            return redirect(route('manager.shops.index'))->with([
                'error' => 'You are already manager'
            ]);
        }


        $shopRequest = new ShopRequest();
        $shopRequest->shop_id = $request->get('shop_id');
        $shopRequest->manager_id = auth()->user()->id;
        if($shopRequest->save()) {
            return redirect(route('manager.shops.index'))->with([
                'message' => 'Shop join requested'
            ]);
        }
        return redirect(route('manager.shops.index'))->with([
            'error' => 'Shop join not requested'
        ]);
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
