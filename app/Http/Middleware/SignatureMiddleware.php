<?php

namespace App\Http\Middleware;

use Closure;

class SignatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $hearderName = 'X-Name')
    {
        // return $next($request);
        $response = $next($request);
        $response->headers->set($hearderName, config('app.name'));
        return $response;
    }
}
