<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiComtroller;
use Closure;
use Illuminate\Http\Request;

class signatureMiddleware extends ApiComtroller
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
         $key = $request->header('api-key-laika');
        if ($key != env('API_KEY_LAIKA')) {
            return $this->errorResponse('Unauthorized', 401);
        }
        return $next($request);

    //     $response = $next($request);
    //     $key = $request->header('Authorization');
    //     $response -> headers -> set($header,config('app.key'));
    //    return $response;
    }
}
