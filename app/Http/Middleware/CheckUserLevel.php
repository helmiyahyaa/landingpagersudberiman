<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$levels  // Menerima satu atau lebih level
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // Cek apakah user sudah login dan levelnya ada di dalam daftar yang diizinkan
        if (Auth::check() && in_array(Auth::user()->level, $levels)) {
            return $next($request); // Izinkan akses
        }

        // Jika tidak, tolak akses
        abort(403, 'ANDA TIDAK MEMILIKI AKSES');
    }
}