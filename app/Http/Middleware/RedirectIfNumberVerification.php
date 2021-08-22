<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNumberVerification
{

    public function handle(Request $request, Closure $next, $role)
    {

        if(auth()->user()!=null){
            if(\auth()->user()->mobile_verified==false){
                if($role=='manager')
                    return redirect()->route('manager.auth.numberVerificationForm');
                else if($role=='user')
                    return redirect()->route('user.auth.numberVerificationForm');
            }
//            dd(auth()->user());
        }

//        dd(auth()->user());
        return $next($request);
    }
}
