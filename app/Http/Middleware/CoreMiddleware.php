<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request Request.
     * @param  Closure  $next Next.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'PATCH, GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
            ->header('Access-Control-Allow-Credentials',' true');
    }
}
