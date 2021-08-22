<?php

namespace App\Http\Controllers\User\Auth;

use App\Helpers\TextUtil;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NumberVerificationController extends Controller
{


    public function showNumberVerificationForm()
    {
        return view('user.auth.number-verification')->with([
            'country_code'=>TextUtil::$countryCode
        ]);
    }

    public function verifyMobileNumber(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        if (User::where('mobile', $request->mobile)->exists()) {
            return response(['errors' => ['Mobile number already exists']], 400);

        } else {
            return response(['message' => ['You can verify with this mobile']]);
        }
    }

    public function mobileVerified(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }


        $user = auth()->user();


        $user->mobile = $request->get('mobile');
        $user->mobile_verified = true;


        if ($user->save()) {
            return redirect(route('user.dashboard'));
        } else {
            return redirect()->back();
        }
    }


}
