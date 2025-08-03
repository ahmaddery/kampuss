<?php


namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Menampilkan pengaturan PMB.
     *
     * @return \Illuminate\View\View
     */
    public function showPMBSettings()
    {
        // Ambil pengaturan status aktif/non-aktif dari tabel settings
        // Jika tidak ada setting, buat yang default dengan is_active = true
        $setting = Setting::first();
        
        if (!$setting) {
            $setting = Setting::create([
                'is_active' => true
            ]);
        }

        // Kirim data pengaturan ke view 'admin.settings.pmb'
        return view('admin.settings.pmb', compact('setting'));
    }


    /**
     * Toggle status aktif/non-aktif untuk PMB section.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function togglePMBStatus()
    {
        // Ambil pengaturan yang ada atau buat yang baru jika tidak ada
        $setting = Setting::first();
        
        if (!$setting) {
            $setting = Setting::create([
                'is_active' => true
            ]);
        }

        // Toggle nilai 'is_active' (aktif jika non-aktif, non-aktif jika aktif)
        $setting->is_active = !$setting->is_active;
        $setting->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.settings.pmb')->with('success', 'PMB section status updated successfully.');
    }
}
