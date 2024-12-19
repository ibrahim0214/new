<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdminOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user login dan role-nya adalah 'super_admin' atau 'admin'
        if (auth()->check() && in_array(auth()->user()->role, ['Superadmin', 'Admin'])) {
            return $next($request);
        }

        // Redirect jika bukan super_admin atau admin
        return redirect()->route('dashboard')->with('error', 'Access Denied');
    }

}
