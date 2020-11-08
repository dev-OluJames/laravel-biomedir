<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        if(Auth::check()){
            $user = Auth::user();
            if($user['user_type']!='super_admin' ){
                return redirect('no_access');
            }
        }
        else{
            return redirect('login')->with('info','Veuillez Vous Connecter Avant d effectuer cette operation');
        }
        return $next($request);
    }


}
