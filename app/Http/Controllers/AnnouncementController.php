<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\Setting; // Add the Setting model

class AnnouncementController extends Controller
{
    /**
     * Show the list of pengumuman on the homepage with search functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Pengumuman::query();
        $search = $request->get('search');

        // Apply search filters if search parameter exists
        if (!empty($search)) {
            // Use fulltext search if available (MySQL 5.6+)
            if (config('database.default') === 'mysql') {
                $query->whereRaw('MATCH(title, description) AGAINST(? IN NATURAL LANGUAGE MODE)', [$search])
                      ->orWhere('author', 'LIKE', '%' . $search . '%')
                      ->orWhere('tags', 'LIKE', '%' . $search . '%');
            } else {
                // Fallback to LIKE search for other databases
                $query->where(function($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                      ->orWhere('description', 'LIKE', '%' . $search . '%')
                      ->orWhere('author', 'LIKE', '%' . $search . '%')
                      ->orWhere('tags', 'LIKE', '%' . $search . '%');
                });
            }
        }

        // Get pengumuman with pagination, exclude soft deleted records
        $pengumumans = $query->latest('publish_date')
                            ->paginate(6)
                            ->appends($request->query()); // Maintain search parameters in pagination links

        return view('pengumuman', compact('pengumumans', 'search'));
    }

    /**
     * Show the detailed pengumuman page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Find announcement by slug
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();

        // Increment view count
        $pengumuman->increment('count_views');

        // Get recent posts
        $recentPosts = Pengumuman::where('id', '!=', $pengumuman->id)
                                ->latest('publish_date')
                                ->take(5)
                                ->get();

        // Get all tags
        $allTags = Pengumuman::whereNotNull('tags')->pluck('tags')->flatMap(function ($tags) {
            return explode(',', $tags);
        })->map(function ($tag) {
            return trim($tag);
        })->unique();

        // Mengambil pengaturan status aktif/non-aktif dari tabel settings
        $setting = Setting::first(); // Mengambil pengaturan pertama

        // Pass data to the detail page
        return view('pengumuman-detail', compact('pengumuman', 'recentPosts', 'allTags', 'setting'));
    }
}