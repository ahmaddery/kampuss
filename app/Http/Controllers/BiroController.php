<?php

namespace App\Http\Controllers;

use App\Models\Biro;
use Illuminate\Http\Request;

class BiroController extends Controller
{
    /**
     * Display a listing of all active biro.
     */
    public function index()
    {
        $biros = Biro::aktif()->orderBy('nama_biro')->paginate(12);
        
        return view('biro.index', compact('biros'));
    }

    /**
     * Display the specified biro.
     */
    public function show(Biro $biro)
    {
        // Only show active biro
        if ($biro->status !== 'aktif') {
            abort(404);
        }

        return view('biro.show', compact('biro'));
    }
}
