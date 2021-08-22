<?php

namespace App\Http\Controllers\Manager;

use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class OrderReceiptController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function show($id)
    {

        $order = Order::with('carts', 'carts.product', 'carts.product.productImages', 'deliveryBoy', 'user', 'address', 'orderPayment', 'carts.productItem', 'carts.productItem.productItemFeatures')
            ->where('id', '=', $id)->get()->toArray()[0];


        return view('manager.orders.order-receipt')->with([
            'order' => $order
        ]);
    }


}
/*
public function index()
{

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
*/
