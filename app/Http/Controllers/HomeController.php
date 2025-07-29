<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Jurusan;
use App\Models\NewsletterSubscription;
use App\Models\HomepageBanner;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Statistics data
        $totalUsers = User::count();
        $totalBerita = Berita::count();
        $totalPengumuman = Pengumuman::count();
        $totalJurusan = Jurusan::count();
        $totalNewsletterSubscribers = NewsletterSubscription::where('is_active', true)->count();
        $totalBanners = HomepageBanner::count();

        // Recent data
        $recentBerita = Berita::latest()->take(5)->get();
        $recentPengumuman = Pengumuman::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        // Chart data - Monthly data for last 6 months
        $monthlyBerita = Berita::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $monthlyPengumuman = Pengumuman::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Popular berita by views
        $popularBerita = Berita::orderBy('count_views', 'desc')->take(5)->get();

        // User role distribution
        $userRoles = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->get();

        return view('home', compact(
            'totalUsers',
            'totalBerita',
            'totalPengumuman',
            'totalJurusan',
            'totalNewsletterSubscribers',
            'totalBanners',
            'recentBerita',
            'recentPengumuman',
            'recentUsers',
            'monthlyBerita',
            'monthlyPengumuman',
            'popularBerita',
            'userRoles'
        ));
    }
}
