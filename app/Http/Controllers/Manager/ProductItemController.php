<?php

namespace App\Http\Controllers\Manager;

use App\Models\ProductItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductItemController extends Controller
{
    static function addItem($productId,$item){
        $productItem = new ProductItem();
        $productItem->product_id = $productId;
        $productItem->price = $item["price"];
        $productItem->quantity = $item["quantity"];
        $productItem->revenue = $item["revenue"];
        $productItem->save();
        ProductItemFeatureController::addFeaturesWithClear($productItem->id,$item['product_item_features']);
    }

    static function addItems($productId,$items){

        for($i=0;$i<sizeof($items);$i++){
            self::addItem($productId,$items[$i]);
        }
    }

    static function addItemsWithClear($productId,$items){
        self::clearItems($productId);
        self::addItems($productId,$items);
    }

    static function clearItems($productId){
        $productItems = ProductItem::where('product_id','=',$productId)->get();
        for($i=0;$i<count($productItems);$i++){
            ProductItemFeatureController::clearFeatures($productItems[$i]->id);
        }
        ProductItem::where('product_id','=',$productId)->delete();

    }

    static function updateItems($productId,$items){
        for ($i=0;$i<count($items);$i++){
            if($items[$i]['id']!=-1){
                $productItem = ProductItem::find($items[$i]["id"]);
                $productItem->price = $items[$i]["price"];
                $productItem->quantity = $items[$i]["quantity"];
                $productItem->revenue = $items[$i]["revenue"];
                $productItem->save();
            }else{
                self::addItem($productId,$items[$i]);

            }
        }
    }
}
