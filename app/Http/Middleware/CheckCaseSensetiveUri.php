<?php

namespace App\Http\Middleware;

use Closure;

class CheckCaseSensetiveUri
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
        $current_uri = \Request::getPathInfo();
        
        if( $current_uri != strtolower( $current_uri ) ){
            abort(404);
        }

        return $next($request);
    }
}
