<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfBlocked
{

    public function handle(Request $request, Closure $next, $role)
    {

        if(auth()->user()!=null){
            if(auth()->user()->blocked==true){
                if($role=='user')
                    return redirect()->route('user.block.show');

            }
        }

        return $next($request);
    }
}
