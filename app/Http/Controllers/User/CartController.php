<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //TODO : ADD Validator when item quantity is not available

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;

        $carts = Cart::where('user_id', '=', $user_id)
            ->where('active', '=', true)->get();
        $shopIds = collect();
        foreach ($carts as $cart){
            $shopIds->add($cart->shop_id);
        }

        $shopIds = $shopIds->unique()->values()->all();

        $filterCart = [];
        foreach ($shopIds as $shopId){

            $carts = Cart::with('product', 'product.shop', 'product.category', 'product.productImages', 'product.shop.manager','productItem','productItem.productItemFeatures')->where('user_id', '=', $user_id)
                ->where('active', '=', true)->where('shop_id',$shopId)->get();
            array_push($filterCart,$carts);
        }



        return view('user.carts.carts')->with([
            'filterCarts'=>$filterCart
        ]);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'product_item_id'=>'required',
        ]);

        $productItem = ProductItem::with('product')->find($request->product_item_id);

        $product = $productItem->product;
        $quantity = isset($request->quantity) ? $request->quantity : 1;

        $user_id = auth()->user()->id;
        $cart = Cart::where('product_item_id', '=', $request->product_item_id)
            ->where('user_id', '=', $user_id)
            ->where('active', '=', true)
            ->exists();
        if (!$cart) {
            if($quantity > $productItem->quantity){
                return redirect()->back()->with([
                    'error' => 'Quantity is not enough'
                ]);
            }

            if(!$product->active){
                return redirect()->back()->with([
                    'error' => 'This product is not currently active'
                ]);
            }

            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->product_item_id = $productItem->id;
            $cart->user_id = $user_id;
            $cart->shop_id = $product->shop_id;
            $cart->quantity = $quantity;
            if ($cart->save()) {
                return redirect()->back()->with([
                    'message' => 'Product added to cart'
                ]);
            }

        }
        else {
            return redirect()->back()->with([
                'error' => 'This product is already in cart'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Something wrong'
        ]);

    }

    public function show($id)
    {
    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'quantity'=>'required'
        ]);

        $cart = Cart::with('productItem')->find($id);
        if ($cart) {
            if($request->quantity > $cart->productItem->quantity){
                return redirect()->back()->with([
                    'error' => 'Quantity is not enough'
                ]);
            }
            $cart->quantity = $request->quantity;
            if ($cart->save()) {
                return redirect()->back();
            }
        }
        return redirect()->back()->with([
            'error' => 'Something wrong'
        ]);
    }


    public function destroy(Request $request)
    {

        $this->validate($request, [
            'cart_id'=>'required',
        ]);
        $cart = Cart::find($request->cart_id);
        if($cart->delete()){
            return redirect()->back()->with([
                'message' => 'Cart is deleted'
            ]);
        }else{
            return redirect()->back()->with([
                'error' => 'Something wrong'
            ]);
        }

    }

}
