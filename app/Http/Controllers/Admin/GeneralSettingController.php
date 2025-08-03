<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    /**
     * Display general settings
     */
    public function index()
    {
        // Get contact info from database
        $contactInfo = ContactInfo::pluck('value', 'key')->toArray();
        
        // Get social media from database dengan data lengkap
        $socialMediaList = SocialMedia::ordered()->get();
        $socialMedia = SocialMedia::pluck('url', 'platform')->toArray();
        
        // Combine data
        $settings = array_merge($contactInfo, $socialMedia);
        
        return view('admin.settings.general', compact('settings', 'socialMediaList'));
    }

    /**
     * Update general website settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'operasional' => 'nullable|string',
        ]);
        
        // Update database ContactInfo
        if ($request->email) {
            ContactInfo::updateOrCreate(
                ['key' => 'email'],
                [
                    'label' => 'Email',
                    'value' => $request->email,
                    'is_active' => true,
                    'sort_order' => 1
                ]
            );
        }
        if ($request->phone) {
            ContactInfo::updateOrCreate(
                ['key' => 'phone'],
                [
                    'label' => 'Telepon',
                    'value' => $request->phone,
                    'is_active' => true,
                    'sort_order' => 2
                ]
            );
        }
        if ($request->address) {
            ContactInfo::updateOrCreate(
                ['key' => 'address'],
                [
                    'label' => 'Alamat',
                    'value' => $request->address,
                    'is_active' => true,
                    'sort_order' => 3
                ]
            );
        }
        if ($request->description) {
            ContactInfo::updateOrCreate(
                ['key' => 'deskripsi'],
                [
                    'label' => 'Deskripsi',
                    'value' => $request->description,
                    'is_active' => true,
                    'sort_order' => 4
                ]
            );
        }
        if ($request->operational) {
            ContactInfo::updateOrCreate(
                ['key' => 'operasional'],
                [
                    'label' => 'Operasional',
                    'value' => $request->operational,
                    'is_active' => true,
                    'sort_order' => 5
                ]
            );
        }

        return redirect()->route('admin.settings.general')
            ->with('success', 'Informasi kontak berhasil diperbarui.');
    }

    /**
     * Update social media settings
     */
    public function updateSocial(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'social_media.*.url' => 'nullable|url',
                'social_media.*.icon_class' => 'nullable|string|max:100',
                'social_media.*.sort_order' => 'nullable|integer|min:0|max:100',
                'social_media.*.is_active' => 'nullable|boolean',
            ]);
            
            $socialMediaData = $request->get('social_media', []);
            
            foreach ($socialMediaData as $platform => $data) {
                SocialMedia::updateOrCreate(
                    ['platform' => $platform],
                    [
                        'name' => ucfirst($platform),
                        'url' => $data['url'] ?? '',
                        'icon_class' => $data['icon_class'] ?? '',
                        'is_active' => isset($data['is_active']) ? 1 : 0,
                        'sort_order' => (int)($data['sort_order'] ?? 0),
                    ]
                );
            }
            
            return back()->with('success', 'Media sosial berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
