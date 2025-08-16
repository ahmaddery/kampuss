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
        return view('admin.settings.index');
    }

    /**
     * Display page status settings
     *
     * @return \Illuminate\View\View
     */
    public function pages()
    {
        // Default pages yang bisa diatur
        $defaultPages = [
            'sambutan-rektor' => 'Sambutan Rektor',
            'sejarah' => 'Sejarah',
            'visi-misi' => 'Visi & Misi',
            'struktur-organisasi' => 'Struktur Organisasi',
            'berita' => 'Berita',
            'pengumuman' => 'Pengumuman',
            'jurusan' => 'Program Studi',
            'fasilitas' => 'Fasilitas',
            'biro' => 'Biro',
            'contact' => 'Kontak'
        ];

        // Ambil atau buat settings untuk setiap halaman
        $settings = collect();
        foreach ($defaultPages as $pageName => $pageTitle) {
            $setting = Setting::where('page_name', $pageName)->first();
            
            if (!$setting) {
                $setting = Setting::create([
                    'page_name' => $pageName,
                    'page_title' => $pageTitle,
                    'description' => "Pengaturan untuk halaman {$pageTitle}",
                    'is_active' => true
                ]);
            }
            
            $settings->push($setting);
        }

        return view('admin.settings.pages', compact('settings'));
    }

    /**
     * Toggle status aktif/non-aktif untuk halaman tertentu.
     *
     * @param string $pageName
     * @return \Illuminate\Http\RedirectResponse
     */
    public function togglePageStatus($pageName)
    {
        $setting = Setting::togglePageStatus($pageName);
        
        if ($setting) {
            $status = $setting->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->route('admin.settings.pages')
                ->with('success', "Halaman {$setting->page_title} berhasil {$status}.");
        }
        
        return redirect()->route('admin.settings.pages')
            ->with('error', 'Halaman tidak ditemukan.');
    }

    /**
     * Bulk activate all pages
     */
    public function bulkActivate()
    {
        Setting::whereNotNull('page_name')->update(['is_active' => true]);
        
        return redirect()->route('admin.settings.pages')
            ->with('success', 'Semua halaman berhasil diaktifkan.');
    }

    /**
     * Bulk deactivate all pages
     */
    public function bulkDeactivate()
    {
        Setting::whereNotNull('page_name')->update(['is_active' => false]);
        
        return redirect()->route('admin.settings.pages')
            ->with('success', 'Semua halaman berhasil dinonaktifkan.');
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
