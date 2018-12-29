<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSocial
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
        if(Auth::user())
            if(!is_null(Auth::user()->provider))
                if(is_null(Auth::user()->city))
            return redirect()->route('provider.fill-data');

        return $next($request);
    }
}
