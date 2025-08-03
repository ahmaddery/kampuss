<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class CheckPageStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $pageName): Response
    {
        // Check if page is active
        if (!Setting::isPageActive($pageName)) {
            // Jika halaman tidak aktif, redirect ke homepage dengan pesan
            return redirect('/')->with('info', 'Halaman yang Anda tuju sedang dalam pemeliharaan.');
        }

        return $next($request);
    }
}
