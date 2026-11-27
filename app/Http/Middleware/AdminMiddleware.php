<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->Role_ID != 2) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к админ-панели.');
        }

        return $next($request);
    }
}

