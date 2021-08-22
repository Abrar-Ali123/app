<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helpers\AppSetting;
use App\Http\Controllers\Controller;
use App\Models\AppData;
use App\Models\User;

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



    public function getAppDataWithUser(){
        if(AppData::all()->first()==null){
            AppData::createDummyOne();
        }


        return response([
            'appdata'=> AppData::all()->last(),
            'user'=>auth()->user()
        ],200);
    }


}
