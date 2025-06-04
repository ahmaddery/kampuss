<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
 use App\Models\SambutanRektor;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel sambutan_rektor
        $data = SambutanRektor::all();

        // Kirim data ke view sambutan-rektor
        return view('sambutan-rektor', compact('data'));
    }

    public function sejarah()
    {
        // Ambil semua data dari tabel sejarah
        $sejarahData = Sejarah::all();

        // Kirim data ke view sejarah.blade.php
        return view('sejarah', compact('sejarahData'));
    }
}
