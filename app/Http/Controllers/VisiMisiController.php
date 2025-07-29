<?php

namespace App\Http\Controllers;

use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Display the vision mission page
     */
    public function index()
    {
        $intro = VisionMission::intro()->first();
        $vision = VisionMission::vision()->first();
        $missions = VisionMission::mission()->get();

        return view('visi-misi.index', compact('intro', 'vision', 'missions'));
    }
}
