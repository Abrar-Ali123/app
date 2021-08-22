<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()!=null){
            if(auth()->user()->locale!=null){
               app()->setLocale(auth()->user()->locale);
               return $next($request);
            }
        }

        app()->setLocale('en');
        return $next($request);
    }
}
