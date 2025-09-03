<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check.page.status' => \App\Http\Middleware\CheckPageStatus::class,
            'contact.rate.limit' => \App\Http\Middleware\ContactRateLimitMiddleware::class,
            'log.activity' => \App\Http\Middleware\LogActivity::class,
        ]);
        
        // Add LogActivity middleware to web middleware group
        $middleware->web(append: [
            \App\Http\Middleware\LogActivity::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Helper function untuk mendapatkan data contact
        $getErrorData = function () {
            $contactInfo = ['email' => 'info@mercubuana-yogya.ac.id', 'phone' => '(0274) 123456'];
            $socialMedia = [
                ['name' => 'Facebook', 'url' => '#', 'icon_class' => 'fab fa-facebook-f'],
                ['name' => 'Instagram', 'url' => '#', 'icon_class' => 'fab fa-instagram'],
                ['name' => 'Twitter', 'url' => '#', 'icon_class' => 'fab fa-twitter'],
                ['name' => 'YouTube', 'url' => '#', 'icon_class' => 'fab fa-youtube'],
            ];
            $pageSettings = ['sambutan-rektor' => true, 'sejarah' => true, 'visi-misi' => true, 'struktur-organisasi' => true];
            
            try {
                if (class_exists(\App\Models\ContactInfo::class)) {
                    $contact = \App\Models\ContactInfo::first();
                    if ($contact) {
                        $contactInfo = ['email' => $contact->email, 'phone' => $contact->phone];
                    }
                }
                if (class_exists(\App\Models\SocialMedia::class)) {
                    $socialMedia = \App\Models\SocialMedia::where('is_active', true)->orderBy('order')->get()->toArray();
                }
                if (class_exists(\App\Models\Setting::class)) {
                    $pageSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
                }
            } catch (\Exception $e) {
                // Use defaults
            }
            
            return compact('contactInfo', 'socialMedia', 'pageSettings');
        };
        
        // Custom error handling untuk HTTP exceptions
        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, Illuminate\Http\Request $request) use ($getErrorData) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            
            return response()->view('errors.404', array_merge($getErrorData(), ['exception' => $e]), 404);
        });
        
        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, Illuminate\Http\Request $request) use ($getErrorData) {
            return response()->view('errors.403', array_merge($getErrorData(), ['exception' => $e]), 403);
        });
        
        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException $e, Illuminate\Http\Request $request) use ($getErrorData) {
            return response()->view('errors.503', array_merge($getErrorData(), ['exception' => $e]), 503);
        });
    })->create();
