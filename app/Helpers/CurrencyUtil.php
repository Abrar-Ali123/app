<?php
namespace App\Helpers;


class CurrencyUtil {

    public static function doubleToString($currency): string
    {
     return round($currency,2);
    }

    public static function getCurrencySign($afterSpace = false): string
    {
        return AppSetting::$currencySign.($afterSpace?" ":"");
    }



    public static function getDiscountedPrice($price,$discount,$formatted=false){
        if($formatted)
            return self::doubleToString($price * (100-$discount)/100);
        return $price * (100-$discount)/100;
    }


}

