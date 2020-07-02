<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\auth('api')->check() && \auth('api')->user()->role === \ConstUserRole::ADMIN) {
            return $next($request);
        }
        return response()->json(['status' => 404]);
    }
}
