<?php

namespace App\Http\Middleware;

use App\Services\ActivityLogger;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log CREATE, UPDATE, DELETE operations (not VIEW operations)
        if (Auth::check() && !$request->ajax() && !$this->shouldSkipLogging($request) && $this->shouldLogMethod($request)) {
            $this->logActivity($request, $response);
        }

        return $response;
    }

    /**
     * Log the activity.
     */
    protected function logActivity(Request $request, Response $response): void
    {
        $user = Auth::user();
        $route = $request->route();
        $routeName = $route ? $route->getName() : null;
        $method = $request->method();
        $path = $request->path();
        
        // Generate description based on route and method
        $description = $this->generateDescription($method, $path, $routeName, $request);
        
        // Determine log category
        $logName = $this->determineLogCategory($path, $routeName);
        
        // Determine status based on response
        $status = $response->getStatusCode() >= 400 ? 'failed' : 'success';
        
        // Additional properties
        $properties = [
            'route_name' => $routeName,
            'parameters' => $request->route() ? $request->route()->parameters() : [],
            'response_status' => $response->getStatusCode(),
        ];

        // Add request data for POST/PUT/PATCH requests (excluding sensitive data)
        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $requestData = $request->except(['password', 'password_confirmation', '_token', '_method']);
            if (!empty($requestData)) {
                $properties['request_data'] = $requestData;
            }
        }

        $logger = new ActivityLogger();
        $logger->log($logName)
            ->withDescription($description)
            ->withProperties($properties)
            ->withStatus($status)
            ->save();
    }

    /**
     * Generate description based on request.
     */
    protected function generateDescription(string $method, string $path, ?string $routeName, Request $request): string
    {
        // Custom descriptions for specific routes
        $routeDescriptions = [
            'login' => 'Login ke sistem',
            'logout' => 'Logout dari sistem',
            'admin.berita.store' => 'Menambah berita baru',
            'admin.berita.update' => 'Mengupdate berita',
            'admin.berita.destroy' => 'Menghapus berita',
            'admin.pengumuman.store' => 'Menambah pengumuman baru',
            'admin.pengumuman.update' => 'Mengupdate pengumuman',
            'admin.pengumuman.destroy' => 'Menghapus pengumuman',
            'admin.users.store' => 'Menambah pengguna baru',
            'admin.users.update' => 'Mengupdate pengguna',
            'admin.users.destroy' => 'Menghapus pengguna',
            'admin.fasilitas.store' => 'Menambah fasilitas baru',
            'admin.fasilitas.update' => 'Mengupdate fasilitas',
            'admin.fasilitas.destroy' => 'Menghapus fasilitas',
            'admin.jurusan.store' => 'Menambah jurusan baru',
            'admin.jurusan.update' => 'Mengupdate jurusan',
            'admin.jurusan.destroy' => 'Menghapus jurusan',
            'admin.biro.store' => 'Menambah biro baru',
            'admin.biro.update' => 'Mengupdate biro',
            'admin.biro.destroy' => 'Menghapus biro',
            'admin.settings.update' => 'Mengupdate pengaturan',
        ];

        if ($routeName && isset($routeDescriptions[$routeName])) {
            return $routeDescriptions[$routeName];
        }

        // Generate description based on method and path
        $pathSegments = explode('/', trim($path, '/'));
        
        if (str_starts_with($path, 'admin/')) {
            $resource = $pathSegments[1] ?? 'halaman';
            
            return match ($method) {
                'POST' => "Menambah data {$resource}",
                'PUT', 'PATCH' => "Mengupdate data {$resource}",
                'DELETE' => "Menghapus data {$resource}",
                default => "Melakukan aksi {$method} pada {$resource}",
            };
        }

        return match ($method) {
            'POST' => "Menambah data di {$path}",
            'PUT', 'PATCH' => "Mengupdate data di {$path}",
            'DELETE' => "Menghapus data di {$path}",
            default => "Melakukan aksi {$method} pada {$path}",
        };
    }

    /**
     * Determine log category based on path.
     */
    protected function determineLogCategory(string $path, ?string $routeName): string
    {
        if (str_contains($path, 'login') || str_contains($path, 'logout') || str_contains($path, 'auth')) {
            return 'auth';
        }

        if (str_contains($path, 'berita')) {
            return 'berita';
        }

        if (str_contains($path, 'pengumuman')) {
            return 'pengumuman';
        }

        if (str_contains($path, 'user')) {
            return 'user';
        }

        if (str_contains($path, 'fasilitas')) {
            return 'fasilitas';
        }

        if (str_contains($path, 'jurusan')) {
            return 'jurusan';
        }

        if (str_contains($path, 'biro')) {
            return 'biro';
        }

        if (str_contains($path, 'settings') || str_contains($path, 'setting')) {
            return 'settings';
        }

        if (str_contains($path, 'contact')) {
            return 'contact';
        }

        if (str_contains($path, 'newsletter')) {
            return 'newsletter';
        }

        if (str_contains($path, 'admin')) {
            return 'admin';
        }

        return 'general';
    }

    /**
     * Determine if this HTTP method should be logged.
     */
    protected function shouldLogMethod(Request $request): bool
    {
        $method = $request->method();
        $route = $request->route();
        $routeName = $route ? $route->getName() : null;
        
        // Always log authentication actions
        if (in_array($routeName, ['login', 'logout']) || str_contains($request->path(), 'login') || str_contains($request->path(), 'logout')) {
            return true;
        }
        
        // Only log CREATE, UPDATE, DELETE operations
        return in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE']);
    }

    /**
     * Determine if logging should be skipped for this request.
     */
    protected function shouldSkipLogging(Request $request): bool
    {
        $skipRoutes = [
            'debugbar.*',
            'livewire.*',
            '*.css',
            '*.js',
            '*.png',
            '*.jpg',
            '*.jpeg',
            '*.gif',
            '*.svg',
            '*.ico',
            '*.woff',
            '*.woff2',
            '*.ttf',
            '*.eot',
        ];

        $path = $request->path();
        
        foreach ($skipRoutes as $pattern) {
            if (fnmatch($pattern, $path)) {
                return true;
            }
        }

        // Skip if it's a static file request
        if (str_contains($path, 'storage/') || str_contains($path, 'assets/')) {
            return true;
        }

        return false;
    }
}
