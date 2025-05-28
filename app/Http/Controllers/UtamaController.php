<?php

namespace App\Http\Controllers;

use App\Models\HomepageBanner;
use App\Models\Berita; // Add the Berita model
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

        // Mengirim data banner dan berita ke view
        return view('index', compact('banners', 'berita'));
    }
}
