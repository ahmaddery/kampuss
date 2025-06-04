<?php

namespace App\Http\Controllers;

use App\Models\HomepageBanner;
use App\Models\Berita;
use App\Models\Jurusan; // Add the Jurusan model
use App\Models\Setting; // Add the Setting model
use Illuminate\Http\Request;

class UtamaController extends Controller
{
    // Menampilkan halaman utama dengan gambar slider
    public function index(Request $request)
    {
        // Mengambil data banner dari database
        $banners = HomepageBanner::all();  // Mengambil semua data banner
        
        // Mengambil 4 berita terbaru dari database
        $berita = Berita::latest()->take(4)->get(); // Fetch 4 latest berita without pagination

        // Mengambil semua data jurusan
        $jurusans = Jurusan::all();  // Fetch all jurusan data

        // Mengambil pengaturan status aktif/non-aktif dari tabel settings
        $setting = Setting::first(); // Mengambil pengaturan pertama

        // Mengirim data banner, berita, jurusan, dan setting ke view
        return view('index', compact('banners', 'berita', 'jurusans', 'setting'));
    }
}
