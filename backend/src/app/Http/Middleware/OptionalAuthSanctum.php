<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/** 
* ** DEMO-LARAVEL **
* Middleware che permette di avere lo user da santum opzionale
*/
class OptionalAuthSanctum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken()) {
            Auth::setUser(
                Auth::guard('sanctum')->user()
            );
        }
        return $next($request);
    }
}
