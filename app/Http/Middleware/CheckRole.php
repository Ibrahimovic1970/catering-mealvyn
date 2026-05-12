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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Cek apakah user memiliki salah satu role yang diizinkan
        if (!in_array($request->user()->level, $roles)) {
            abort(403, 'Unauthorized access. You do not have permission to access this page.');
        }

        return $next($request);
    }
}
