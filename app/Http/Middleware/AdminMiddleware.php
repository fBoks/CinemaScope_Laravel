<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->isAdmin($request)) {
            return $next($request);
        }

        abort(403);
    }

    protected function isAdmin(Request $request): bool
    {
        return  $request->user()->role_id == 'admin' ?? false;
    }
}
