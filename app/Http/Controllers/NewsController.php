<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Show the list of berita on the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil data berita dengan pagination
        $berita = Berita::latest()->paginate(8); // Fetch berita with pagination (8 items per page)

        // Mengirim data berita ke halaman utama
        return view('berita', compact('berita'));
    }

    /**
     * Show the detailed berita page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Menemukan berita berdasarkan slug
        $berita = Berita::where('slug', $slug)->firstOrFail(); // Fetch berita using the slug

        // Increment the view count
        $berita->increment('count_views'); // This increments the `count_views` field by 1

        // Mengirim data berita ke halaman detail
        return view('berita-detail', compact('berita'));
    }
}

