<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


       if(Auth::check() && Auth::user()->admin == 1){
        return $next($request);
       }else{
           return redirect()->back()->with('error','Please Register/Login Your Account');
       }

    }
}
