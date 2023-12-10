<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenMiddleware
{
    /**
     * Проверка на роль автора по токену
     * Либо сделать отдельный мидлвейр только для проверки роли автора
     * 
    */

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $token): Response
    {
        if($request->input("token") === $token) {
            return $next($request);
        }

        abort(403);
    }
}
