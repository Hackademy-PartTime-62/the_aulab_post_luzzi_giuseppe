<?php

namespace App\Http\Middleware;

use Closure;

class IsRevisor
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->is_revisor) {
            abort(403, 'Accesso non autorizzato');
        }

        return $next($request);
    }
}
