<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ContactRateLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'contact_form_' . $request->ip();
        
        // Rate limiting: 3 attempts per 10 minutes per IP
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);
            
            return redirect()->back()
                ->withErrors(['spam' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$minutes} menit."])
                ->withInput();
        }
        
        // Increment the rate limiter
        RateLimiter::hit($key, 600); // 10 minutes
        
        return $next($request);
    }
}
