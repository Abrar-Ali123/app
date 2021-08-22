<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //TODO : ADD Validator when item quantity is not available

    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $carts = Cart::with('product', 'product.shop', 'product.category', 'product.productImages', 'product.shop.manager','productItem','productItem.productItemFeatures')->where('user_id', '=', $user_id)
            ->where('active', '=', true)->get();
        return $carts;
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'product_item_id'=>'required',
            'quantity' => 'required'
        ]);

        $product = Product::find($request->product_id);
        $productItem = ProductItem::find($request->product_item_id);

        $user_id = $request->user()->id;
        $cart = Cart::where('product_item_id', '=', $request->product_item_id)
            ->where('user_id', '=', $user_id)
            ->where('active', '=', true)
            ->exists();
        if (!$cart) {
            if($request->quantity > $productItem->quantity){
                return response(['errors' => ['Quantity is not enough']], 403);
            }

            if(!$product->active){
                return response(['errors' => ['This product is not currently active'    ]], 403);
            }

            $cart = new Cart();
            $cart->product_id = $request->product_id;
            $cart->product_item_id = $request->product_item_id;
            $cart->user_id = $user_id;
            $cart->shop_id = $product->shop_id;
            $cart->quantity = $request->quantity;
            if ($cart->save()) {
                return response(['message' => 'Product added'], 200);
            }

        } else {
            return response(['errors' => ['This is already added']], 403);
        }

        return response(['errors' => ['Something wrong']], 403);

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
                return response(['errors' => ['Quantity is not enough']], 403);
            }
            $cart->quantity = $request->quantity;
            if ($cart->save()) {
                return response(['message' => 'Quantity changed'], 200);
            }
        }
        return response(['errors' => ['Something wrong']], 403);
    }


    public function destroy($id)
    {
        $cart = Cart::find($id);
        if($cart->delete()){
            return response(['message' => 'Cart is deleted'], 200);
        }else{
            return response(['errors' => ['Something wrong']], 403);
        }

    }

}
