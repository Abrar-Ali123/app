<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:manager');
    }

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/manager';

    protected function guard()
    {
        return Auth::guard('manager');
    }

    public function broker()
    {
        return Password::broker('managers');
    }


    public function showResetForm(Request $request, $token = null)
    {
        return view('manager.auth.reset')->with([
           'token'=>$token,
            'email'=>$request->email
        ]);
    }
}
