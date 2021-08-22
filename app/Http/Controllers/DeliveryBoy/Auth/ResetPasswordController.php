<?php

namespace App\Http\Controllers\DeliveryBoy\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{

     use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function broker()
    {
        return Password::broker('delivery-boys');
    }


    public function showResetForm(Request $request, $token = null)
    {
        return view('delivery-boy.auth.reset')->with([
           'token'=>$token,
            'email'=>$request->email
        ]);
    }
}
