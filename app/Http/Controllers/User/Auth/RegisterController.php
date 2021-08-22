<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm(){
        return view('user.auth.register');
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('user.login'));
    }
}
