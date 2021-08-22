<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\ProductItemController;
use App\Http\Controllers\Manager\ShopRevenueController;
use App\Models\Cart;
use App\Models\DeliveryBoyReview;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ShopReview;
use App\Models\SubCategory;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //TODO : validation in authentication order
    public function index()
    {

        $shop = auth()->user()->shop;
        if($shop) {
            return Product::with('productImages', 'productItems', 'productItems.productItemFeatures')
                ->where('shop_id', '=', $shop->id)
                ->orderBy('updated_at', 'DESC')->get();
        }
        return response(['errors' => ['You have not any shop yet']], 504);

    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $shop = auth()->user()->shop;
        if (!$shop) {
            return response(['errors' => ['You have not any shop yet']], 504);
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'items' => 'required'
        ]);
       // return $request->get('items');

        $items = array_values(json_decode($request->get('items'), true));
        if(count($items)>0) {
            if (self::validateItems($items)) {
                $product = new Product();
                $product->name = $request->get('name');
                $product->description = $request->get('description');
                $product->category_id = $request->get('category');

                if (isset($request->offer))
                    $product->offer = $request->get('offer');
                else
                    $product->offer = 0;

                $product->shop_id = $shop->id;
                $product->save();
                ProductItemController::addItemsWithClear($product->id, $items);
                return response(['message' => ['Product created']], 200);
            } else {
                return response(['errors' => ['Product items are not valid (same feature with single item is not allow)']], 403);
            }
        }else{
            return response(['errors' => ['Add at-least one product item']], 403);
        }
    }



    static function validateItems($items): bool
    {
        foreach ($items as $item) {
            $productItemFeatures = $item['product_item_features'];
            for ($i = 0; $i < sizeof($productItemFeatures); $i++) {
                for ($j = $i+1; $j < sizeof($productItemFeatures); $j++) {
                    if ($productItemFeatures[$i]["feature"] === $productItemFeatures[$j]["feature"])
                        return false ;
                }
            }

        }
        return true;
    }

    public function show($id)
    {

        return Product::with('productImages', 'productItems','productItems.productItemFeatures')->find($id);

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

        $shop = auth()->user()->shop;
        if (!$shop) {
            return response(['errors' => ['You have not any shop yet']], 504);
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'items' => 'required'
        ]);
        // return $request->get('items');

        $items = array_values(json_decode($request->get('items'), true));
        if(count($items)>0) {
            if (self::validateItems($items)) {
                $product = Product::find($id);
                $product->name = $request->get('name');
                $product->description = $request->get('description');

                $subCategory = SubCategory::find($request->get('category'));

                $product->sub_category_id = $request->get('category');
                $product->category_id = $subCategory->category_id;

                if (isset($request->offer))
                    $product->offer = $request->get('offer');

                $product->shop_id = $shop->id;
                $product->save();
                ProductItemController::updateItems($product->id, $items);
                return response(['message' => ['Product updated']], 200);
            } else {
                return response(['errors' => ['Product items are not valid (same feature with single item is not allow)']], 403);
            }
        }else{
            return response(['errors' => ['Add at-least one product item']], 403);
        }

    }


    public function destroy($id)
    {

    }

    public function showReviews($id)
    {
        $user_id = auth()->user()->id;
        $order =  Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'shop', 'orderPayment','deliveryBoy','carts.productItem','carts.productItem.productItemFeatures')
            ->find($id);

        $productReviews = ProductReview::where('order_id','=',$order->id)->get();
        $shopReview = ShopReview::where('user_id','=',$user_id)->first();
        $deliveryBoyReview = DeliveryBoyReview::where('order_id','=',$order->id)->first();

        $order['product_reviews'] = $productReviews;
        $order['shop_review'] = $shopReview;
        $order['delivery_boy_review'] = $deliveryBoyReview;


        return $order;

    }

}
