<?php

namespace App\Http\Controllers\Manager;

use App\Models\ProductItemFeature;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductItemFeatureController extends Controller
{


    static function addFeature($productItemId,$feature){
        $productItemFeature = new ProductItemFeature();
        $productItemFeature->feature = $feature["feature"];
        $productItemFeature->value = $feature["value"];
        $productItemFeature->product_item_id = $productItemId;
        $productItemFeature->save();
    }



    static function addFeatures($productItemId,$features){
        for($i=0;$i<count($features);$i++){
            self::addFeature($productItemId,$features[$i]);
        }
    }

    static function addFeaturesWithClear($productItemId,$features){
        self::clearFeatures($productItemId);
        self::addFeatures($productItemId,$features);
    }

    static function clearFeatures($productItemId){
        ProductItemFeature::where('product_item_id','=',$productItemId)->delete();
    }
}
