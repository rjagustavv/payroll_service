<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }
        Auth::logout(); // Opsional: logout jika mencoba akses tidak sah
        return redirect('/login')->with('error', 'Akses ditolak. Anda bukan Admin.');
    }
}
