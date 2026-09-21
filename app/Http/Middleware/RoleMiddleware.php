<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login
        if (!Auth::check()) {

            // Jika mengakses halaman admin
            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect('/admin/login');
            }

            // Selain admin
            return redirect('/login');
        }

        $user = Auth::user();

        // Cek role
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        abort(404, 'Halaman tidak ditemukan');
    }
}