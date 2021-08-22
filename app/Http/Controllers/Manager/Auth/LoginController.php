<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:manager',['except'=>['logout']]);
    }

    public function showLoginForm()
    {
        return view('manager.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request,
            [
                'email' => 'required|exists:managers',
                'password' => 'required'
            ],
            [
                'email.exists' => 'This email is not registered'
            ]
        );

        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            return redirect(route('manager.dashboard'));

        }
        $validator = Validator::make([], []); // Empty data and rules fields
        $validator->errors()->add('password', 'This is wrong password');
        throw new ValidationException($validator);
    }

    public function logout(){
        Auth::guard('manager')->logout();
        return redirect('/');
    }

}
