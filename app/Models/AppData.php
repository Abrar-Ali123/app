<?php

namespace App\Models;

use App\Helpers\AppSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AppData extends Model
{
    use HasFactory;


    static function createDummyOne(): bool
    {
        $appdata = new AppData();
        $appdata->application_minimum_version = AppSetting::$MINIMUM_APPLICATION_VERSION;
        $appdata->support_payments = '1,2,3,4'; //All Payment Enabled
        return $appdata->save();
    }


    static function paymentMethodEnabled($support_payment,$payment_method): bool
    {
        $support_payments = explode(",",$support_payment);
        foreach ($support_payments as $support_payment){
            if($support_payment==$payment_method)
                return true;
        }
        return  false;
    }

    static function getLast(){
        if(AppData::all()->first()==null){
            self::createDummyOne();
        }
        return AppData::all()->last();
    }
}
