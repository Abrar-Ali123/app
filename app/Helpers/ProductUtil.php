<?php
namespace App\Helpers;


class ProductUtil {

    static function getProductItemFeatures($item){

        if(is_array($item)) {
            return view('components.product-item-features')->with([
                'item' => $item
            ]);
        }
        return view('components.product-item-features')->with([
            'item' => $item->toArray()
        ]);
    }



}

