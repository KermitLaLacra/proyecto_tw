<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    	// Usuario no autenticado
        if (!auth()->check()) {
            abort(403);
        }

        // Verifica rol
        if (auth()->user()->role !== $role) {
            abort(403);
        }
    
        return $next($request);
    }
}
