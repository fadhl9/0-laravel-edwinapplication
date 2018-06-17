<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
// the one I made with thr instructor - un-comment this to make it work
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @return mixed
//      */
//     public function handle($request, Closure $next)
//     {
//         if(Auth::check()){

//             if(Auth::user()->isAdmin()){
//                 return $next($request);
//             }

//         }

//         return redirect('/');
//     }
// }

// this one is working like the above but without the function isAdmin() coz I wrote the function instead in Middleware itself
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){

            if(Auth::user()->role->name == 'administrator' && Auth::user()->is_active == 1){
                return $next($request);
            }

        }

        return redirect('/');
    }
}