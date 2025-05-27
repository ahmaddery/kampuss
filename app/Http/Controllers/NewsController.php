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

    // Passing both banners and berita data to the view
    return view('berita', compact('berita'));
}

}
