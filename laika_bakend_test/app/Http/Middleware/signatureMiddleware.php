<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class signatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $header='X-Name')
    {
        $response = $next($request);
        $response -> headers -> set($header,config('app.key'));
       return $response;
    }
}
