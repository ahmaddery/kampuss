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
        $setting = Setting::first(); // Ambil pengaturan pertama

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
        // Ambil pengaturan yang ada
        $setting = Setting::first();

        // Toggle nilai 'is_active' (aktif jika non-aktif, non-aktif jika aktif)
        $setting->is_active = !$setting->is_active;
        $setting->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.settings.pmb')->with('success', 'PMB section status updated successfully.');
    }
}
