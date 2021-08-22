<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:user',['except'=>['logout']]);
    }

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request,
            [
                'email' => 'required|exists:users',
                'password' => 'required'
            ],
            [
                'email.exists' => 'This email is not registered'
            ]
        );

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            return redirect(route('user.dashboard'));

        }
        $validator = Validator::make([], []); // Empty data and rules fields
        $validator->errors()->add('password', 'This is wrong password');
        throw new ValidationException($validator);
    }

    public function logout(){
        Auth::guard('user')->logout();
        return redirect('/');
    }

}
