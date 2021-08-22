<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class NumberVerificationController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('guest:manager',['except'=>['logout']]);
//    }

    public function showNumberVerificationForm()
    {
        return view('manager.auth.number-verification');
    }

    public function verifyMobileNumber(Request $request){

        $validator = Validator::make($request->all(),[
            'mobile'=>'required',

        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        if(Manager::where('mobile',$request->mobile)->exists()){
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
            return redirect(route('manager.dashboard'));
        }else{
            return redirect()->back();
        }
    }


}
