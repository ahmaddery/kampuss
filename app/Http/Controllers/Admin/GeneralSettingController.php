<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class GeneralSettingController extends Controller
{
    private $settingsPath;

    public function __construct()
    {
        $this->settingsPath = storage_path('app/settings.json');
    }

    /**
     * Display general settings
     */
    public function index()
    {
        $settings = $this->getSettings();
        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Update general website settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $settings = $this->getSettings();
        
        $settings['site_name'] = $request->site_name;
        $settings['site_tagline'] = $request->site_tagline;
        $settings['site_description'] = $request->site_description;
        $settings['contact_email'] = $request->contact_email;
        $settings['contact_phone'] = $request->contact_phone;
        $settings['address'] = $request->address;

        $this->saveSettings($settings);

        return redirect()->route('admin.settings.general')
            ->with('success', 'Informasi website berhasil diperbarui.');
    }

    /**
     * Update social media settings
     */
    public function updateSocial(Request $request)
    {
        $request->validate([
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
        ]);

        $settings = $this->getSettings();
        
        $settings['facebook_url'] = $request->facebook_url;
        $settings['instagram_url'] = $request->instagram_url;
        $settings['twitter_url'] = $request->twitter_url;
        $settings['youtube_url'] = $request->youtube_url;
        $settings['tiktok_url'] = $request->tiktok_url;

        $this->saveSettings($settings);

        return redirect()->route('admin.settings.general')
            ->with('success', 'Pengaturan media sosial berhasil diperbarui.');
    }

    /**
     * Update system settings
     */
    public function updateSystem(Request $request)
    {
        $request->validate([
            'timezone' => 'required|string',
            'default_language' => 'required|string',
            'items_per_page' => 'required|integer|min:5|max:100',
            'maintenance_mode' => 'nullable|boolean',
            'debug_mode' => 'nullable|boolean',
        ]);

        $settings = $this->getSettings();
        
        $settings['timezone'] = $request->timezone;
        $settings['default_language'] = $request->default_language;
        $settings['items_per_page'] = $request->items_per_page;
        $settings['maintenance_mode'] = $request->has('maintenance_mode');
        $settings['debug_mode'] = $request->has('debug_mode');

        $this->saveSettings($settings);

        // Update timezone in config if needed
        if ($request->timezone) {
            config(['app.timezone' => $request->timezone]);
        }

        // Handle maintenance mode
        if ($request->has('maintenance_mode')) {
            Artisan::call('down');
        } else {
            Artisan::call('up');
        }

        return redirect()->route('admin.settings.general')
            ->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }

    /**
     * Get settings from file
     */
    private function getSettings()
    {
        if (File::exists($this->settingsPath)) {
            $content = File::get($this->settingsPath);
            return json_decode($content, true) ?: [];
        }

        return $this->getDefaultSettings();
    }

    /**
     * Save settings to file
     */
    private function saveSettings($settings)
    {
        File::put($this->settingsPath, json_encode($settings, JSON_PRETTY_PRINT));
    }

    /**
     * Default settings
     */
    private function getDefaultSettings()
    {
        return [
            'site_name' => 'Universitas Mercu Buana Yogyakarta',
            'site_tagline' => 'Excellence in Education',
            'site_description' => 'Universitas terkemuka di Yogyakarta yang berkomitmen untuk menghasilkan lulusan berkualitas tinggi.',
            'contact_email' => 'info@mercubuana-yogya.ac.id',
            'contact_phone' => '(0274) 123456',
            'address' => 'Jl. Wates Km 10, Yogyakarta 55753',
            'facebook_url' => '',
            'instagram_url' => '',
            'twitter_url' => '',
            'youtube_url' => '',
            'tiktok_url' => '',
            'timezone' => 'Asia/Jakarta',
            'default_language' => 'id',
            'items_per_page' => 10,
            'maintenance_mode' => false,
            'debug_mode' => false,
        ];
    }
}
