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
        
        // Mengambil data berita dari database dan menggunakan pagination
        $berita = Berita::latest()->paginate(1); // Fetch berita with pagination (8 items per page)

        // Mengirim data banner dan berita ke view
        return view('index', compact('banners', 'berita'));
    }
}
