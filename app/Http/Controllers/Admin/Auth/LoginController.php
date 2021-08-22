<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin',['except'=>['logout']]);
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request,
            [
                'email' => 'required|exists:admins',
                'password' => 'required'
            ],
            [
                'email.exists' => 'This email is not registered'
            ]
        );

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            return redirect(route('admin.dashboard'));

        }
        $validator = Validator::make([], []); // Empty data and rules fields
        $validator->errors()->add('password', 'This is wrong password');
        throw new ValidationException($validator);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
