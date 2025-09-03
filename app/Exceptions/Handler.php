<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Handle HTTP exceptions with custom error pages
        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            
            // Check if custom error view exists
            if (view()->exists("errors.{$statusCode}")) {
                return response()->view("errors.{$statusCode}", [
                    'exception' => $exception,
                    'contactInfo' => $this->getContactInfo(),
                    'socialMedia' => $this->getSocialMedia(),
                    'pageSettings' => $this->getPageSettings(),
                ], $statusCode);
            }
        }

        // Handle specific exception types
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [
                'exception' => $exception,
                'contactInfo' => $this->getContactInfo(),
                'socialMedia' => $this->getSocialMedia(),
                'pageSettings' => $this->getPageSettings(),
            ], 404);
        }

        if ($exception instanceof AccessDeniedHttpException) {
            return response()->view('errors.403', [
                'exception' => $exception,
                'contactInfo' => $this->getContactInfo(),
                'socialMedia' => $this->getSocialMedia(),
                'pageSettings' => $this->getPageSettings(),
            ], 403);
        }

        if ($exception instanceof ServiceUnavailableHttpException) {
            return response()->view('errors.503', [
                'exception' => $exception,
                'contactInfo' => $this->getContactInfo(),
                'socialMedia' => $this->getSocialMedia(),
                'pageSettings' => $this->getPageSettings(),
            ], 503);
        }

        return parent::render($request, $exception);
    }

    /**
     * Get contact information for error pages
     *
     * @return array
     */
    public function getContactInfo(): array
    {
        try {
            // Try to get from ContactInfo model if it exists
            if (class_exists(\App\Models\ContactInfo::class)) {
                $contact = \App\Models\ContactInfo::first();
                if ($contact) {
                    return [
                        'email' => $contact->email,
                        'phone' => $contact->phone,
                        'address' => $contact->address ?? null,
                    ];
                }
            }
        } catch (\Exception $e) {
            // Fallback if model doesn't exist or database error
        }

        // Default fallback values
        return [
            'email' => 'info@mercubuana-yogya.ac.id',
            'phone' => '(0274) 123456',
            'address' => 'Yogyakarta, Indonesia',
        ];
    }

    /**
     * Get social media information for error pages
     *
     * @return array
     */
    public function getSocialMedia(): array
    {
        try {
            // Try to get from SocialMedia model if it exists
            if (class_exists(\App\Models\SocialMedia::class)) {
                return \App\Models\SocialMedia::where('is_active', true)
                    ->orderBy('order')
                    ->get()
                    ->toArray();
            }
        } catch (\Exception $e) {
            // Fallback if model doesn't exist or database error
        }

        // Default fallback values
        return [
            [
                'name' => 'Facebook',
                'url' => '#',
                'icon_class' => 'fab fa-facebook-f',
            ],
            [
                'name' => 'Instagram',
                'url' => '#',
                'icon_class' => 'fab fa-instagram',
            ],
            [
                'name' => 'Twitter',
                'url' => '#',
                'icon_class' => 'fab fa-twitter',
            ],
            [
                'name' => 'YouTube',
                'url' => '#',
                'icon_class' => 'fab fa-youtube',
            ],
        ];
    }

    /**
     * Get page settings for error pages
     *
     * @return array
     */
    public function getPageSettings(): array
    {
        try {
            // Try to get from Setting model if it exists
            if (class_exists(\App\Models\Setting::class)) {
                $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
                return $settings;
            }
        } catch (\Exception $e) {
            // Fallback if model doesn't exist or database error
        }

        // Default fallback values
        return [
            'sambutan-rektor' => true,
            'sejarah' => true,
            'visi-misi' => true,
            'struktur-organisasi' => true,
        ];
    }
}
