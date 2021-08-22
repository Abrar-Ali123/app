<?php

namespace App\Http\Controllers\Api\v1\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\DeliveryBoy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        //sleep(3);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:delivery_boys',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $deliveryBoy = new DeliveryBoy();
        $deliveryBoy->name = $request->get('name');
        $deliveryBoy->email = $request->get('email');
        $deliveryBoy->password = Hash::make($request->get('password'));
        if (isset($request->fcm_token)) {
            $deliveryBoy->fcm_token = $request->fcm_token;
        }
        $deliveryBoy->save();

        $accessToken = $deliveryBoy->createToken('authToken')->accessToken;
        return response(['delivery_boy' => $deliveryBoy, 'token' => $accessToken]);

    }


    public function login(Request $request)
    {

        //sleep(3);

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (!DeliveryBoy::where('email', '=', $request->email)->exists()) {
            return response(['errors' => ['This email is not found']], 402);
        }

        $deliveryBoy = DeliveryBoy::where('email', '=', $request->email)->first();

        if ($deliveryBoy && Hash::check($request->password, $deliveryBoy->password)) {
            $accessToken = $deliveryBoy->createToken('authToken')->accessToken;
            if (isset($request->fcm_token)) {
                $deliveryBoy->fcm_token = $request->fcm_token;
            }
            $deliveryBoy->save();
            return response(['delivery_boy' => $deliveryBoy, 'token' => $accessToken], 200);

        } else {
            return response(['errors' => ['Password is not correct']], 402);
        }
    }

    public function changeStatus(Request $request)
    {

        $this->validate($request, [
            'is_offline' => 'required'
        ]);

        $deliveryBoy = DeliveryBoy::find(auth()->user()->id);

        if ($request->is_offline) {
            if ($deliveryBoy->is_free) {
                $deliveryBoy->is_offline = $request->is_offline;
            } else {
                return response(['errors' => ['Please delivered current order then you can goes to offline']], 402);
            }
        } else {
            $deliveryBoy->is_offline = $request->is_offline;
        }

        if($deliveryBoy->save()){
            return response(['message' => ['Your status has been changed'],'delivery_boy'=>$deliveryBoy], 200);
        }else{
            return response(['errors' => ['Something went wrong']], 402);
        }
    }

    public function updateProfile(Request $request){

//        return response(['errors' => ['This is demo version' ]], 403);
        $deliveryBoy =  DeliveryBoy::find(auth()->user()->id);

        if(isset($request->mobile)){
            $deliveryBoy->mobile = $request->mobile;
        }

        if(isset($request->password)){
            $deliveryBoy->password = Hash::make($request->password);
        }

        if(isset($request->avatar_image)){
            $url = "delivery_boy_avatars/".Str::random(10).".jpg";
            $oldImage = $deliveryBoy->avatar_url;
            $data = base64_decode($request->avatar_image);
            Storage::disk('public')->put($url, $data);
            Storage::disk('public')->delete($oldImage);
            $deliveryBoy->avatar_url = $url;
        }

        if($deliveryBoy->save()){
            return response(['message'=>['Your setting has been changed'],'delivery_boy'=>$deliveryBoy],200);
        }else{
            return response(['errors'=>['There is something wrong']],402);
        }
    }


    public function verifyMobileNumber(Request $request){

        $validator = Validator::make($request->all(),[
            'mobile'=>'required',

        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        if(DeliveryBoy::where('mobile',$request->mobile)->exists()){
            return response(['errors'=>['Mobile number already exists']],402);

        }else{
            return response(['message'=>['You can verify with this mobile']]);
        }
    }

    public function mobileVerified(Request $request){

        $validator = Validator::make($request->all(),[
            'mobile'=>'required',

        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }


        $user =  auth()->user();


        $user->mobile=$request->get('mobile');
        $user->mobile_verified=true;


        if($user->save()){
            return response(['message'=>['Your setting has been changed'],'delivery_boy'=>$user],200);
        }else{
            return response(['errors'=>['There is something wrong']],402);
        }
    }
}
