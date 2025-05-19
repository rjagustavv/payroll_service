<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KaryawanMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isKaryawan()) {
            return $next($request);
        }
        Auth::logout(); // Opsional
        return redirect('/login')->with('error', 'Akses ditolak. Anda bukan Karyawan.');
    }
}