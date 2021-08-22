<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Helpers\AppSetting;
use App\Http\Controllers\Controller;
use App\Models\AppData;

class AppDataController extends Controller
{


    public function getAppData(){

        if(AppData::all()->first()==null){
            AppData::createDummyOne();
        }

        return response([
            'appdata'=> AppData::all()->last()
        ],200);
    }



    public function getAppDataWithManager(){
        if(AppData::all()->first()==null){
            AppData::createDummyOne();
        }

        return response([
            'appdata'=> AppData::all()->last(),
            'manager'=>auth()->user()
        ],200);
    }


}
