<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        return UserAddress::where('user_id',$user_id)->where('active',true)->get();
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        $this->validate($request,[
           'longitude'=>'required',
           'latitude'=>'required',
           'address'=>'required',
           'city'=>'required',
           'pincode'=>'required',
            'type'=>'required'
        ]);

        $address = new UserAddress();
        $address->longitude = $request->longitude;
        $address->latitude = $request->latitude;
        $address->address = $request->address;
        $address->address2 = $request->address2;
        $address->city = $request->city;
        $address->pincode = $request->pincode;
        $address->user_id = $user_id;
        $address->type = $request->type;
        if(isset($request->type)){
            $address->type = $request->type;
        }

        if ($address->save()) {
            return response(['message' => 'Address added'], 200);
        }
        return response(['errors' => ['Something wrong']], 403);
    }

    public function show($id)
    {
    }


    public function edit($id)
    {

    }


    public function update(Request $request,$address_id)
    {
        $userAddress = UserAddress::find($address_id);

        if(isset($request->default)){
            if($request->default){
                UserAddress::setAllDefaultOff($userAddress->user_id);
            }
            $userAddress->default = $request->default;

            if($userAddress->save()){
                return response(['message'=>['Your address has been changed']]);
            }else{
                return response(['errors'=>['There is something wrong']],402);
            }
        }


        if(isset($request->longitude) ||
            isset($request->latitude) ||
            isset($request->address) ||
            isset($request->address2) ||
            isset($request->city) ||
            isset($request->pincode)){

            $newUserAddress = new UserAddress();
            $newUserAddress->longitude = $request->longitude??$userAddress->longitude;
            $newUserAddress->latitude = $request->latitude??$userAddress->latitude;
            $newUserAddress->address = $request->address??$userAddress->address;
            $newUserAddress->address2 = $request->address2??$userAddress->address2;
            $newUserAddress->city = $request->city??$userAddress->city;
            $newUserAddress->pincode = $request->pincode??$userAddress->pincode;
            $newUserAddress->type = $request->type??$userAddress->type;
            $newUserAddress->user_id = 1;


            $userAddress->active = false;

            if($userAddress->save() && $newUserAddress->save()){
                return response(['message'=>['Your address has been changed']]);
            }else{
                return response(['errors'=>['There is something wrong']],402);
            }


        }

        if(isset($request->type)){
            $userAddress->type = $request->type;
            if($userAddress->save()){
                return response(['message'=>['Your address has been changed']]);
            }else{
                return response(['errors'=>['There is something wrong']],402);
            }
        }


        return response(['message'=>['Your address has been changed']],402);
    }


    public function destroy($id){

        $userAddress = UserAddress::find($id);
        if($userAddress->delete()){
            return response(['message' => 'Address is deleted'], 200);
        }else{
            return response(['errors' => ['Something wrong']], 403);
        }


    }

}
