<?php

namespace App\Http\Controllers;

use App\Models\HomepageBanner;
use App\Models\Berita;
use App\Models\Jurusan; // Add the Jurusan model
use App\Models\Setting; // Add the Setting model
use App\Models\Fasilitas; // Add the Fasilitas model
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

        // Mengambil 4 pengumuman terbaru dari database
        $pengumuman = \App\Models\Pengumuman::latest('publish_date')->take(4)->get();

        // Mengambil 6 fasilitas terbaru dari database
        $fasilitas = Fasilitas::with('jurusan')->aktif()->latest()->take(6)->get();

        // Mengambil pengaturan status aktif/non-aktif dari tabel settings
        $setting = Setting::first(); // Mengambil pengaturan pertama

        // Mengirim data banner, berita, jurusan, pengumuman, fasilitas, dan setting ke view
        return view('index', compact('banners', 'berita', 'jurusans', 'pengumuman', 'fasilitas', 'setting'));
    }
}
