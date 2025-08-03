<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\ContactInfo;
use App\Models\SocialMedia;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share page settings with all views
        View::composer('*', function ($view) {
            // Get page settings untuk navbar
            $pageSettings = collect();
            
            // Get contact info dan social media
            $contactInfo = collect();
            $socialMedia = collect();
            
            try {
                $pages = [
                    'sambutan-rektor' => 'Sambutan Rektor',
                    'sejarah' => 'Sejarah', 
                    'visi-misi' => 'Visi & Misi',
                    'struktur-organisasi' => 'Struktur Organisasi',
                    'berita' => 'Berita',
                    'pengumuman' => 'Pengumuman',
                    'jurusan' => 'Program Studi',
                ];
                
                foreach ($pages as $pageName => $pageTitle) {
                    $setting = Setting::where('page_name', $pageName)->first();
                    if ($setting) {
                        $pageSettings[$pageName] = $setting->is_active;
                    } else {
                        $pageSettings[$pageName] = true; // Default aktif jika tidak ada setting
                    }
                }
                
                // Get active contact info
                $activeContacts = ContactInfo::active()->ordered()->get();
                foreach ($activeContacts as $contact) {
                    $contactInfo[$contact->key] = $contact->value;
                }
                
                // Get active social media
                $activeSocialMedia = SocialMedia::active()->ordered()->get();
                foreach ($activeSocialMedia as $social) {
                    $socialMedia[] = [
                        'platform' => $social->platform,
                        'name' => $social->name,
                        'url' => $social->url,
                        'icon_class' => $social->icon_class
                    ];
                }
                
            } catch (\Exception $e) {
                // Jika ada error, set semua ke true
                foreach (['sambutan-rektor', 'sejarah', 'visi-misi', 'struktur-organisasi', 'berita', 'pengumuman', 'jurusan'] as $page) {
                    $pageSettings[$page] = true;
                }
                
                // Default contact info
                $contactInfo = collect([
                    'email' => 'info@mercubuana-yogya.ac.id',
                    'phone' => '(0274) 123456'
                ]);
                
                // Default social media
                $socialMedia = collect([
                    ['platform' => 'instagram', 'name' => 'Instagram', 'url' => '#', 'icon_class' => 'fab fa-instagram'],
                    ['platform' => 'facebook', 'name' => 'Facebook', 'url' => '#', 'icon_class' => 'fab fa-facebook'],
                    ['platform' => 'youtube', 'name' => 'YouTube', 'url' => '#', 'icon_class' => 'fab fa-youtube'],
                ]);
            }
            
            $view->with('pageSettings', $pageSettings);
            $view->with('contactInfo', $contactInfo);
            $view->with('socialMedia', $socialMedia);
        });
    }
}
