<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Show the list of berita on the homepage with search functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Berita::query();
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

        // Get berita with pagination, exclude soft deleted records
        $berita = $query->latest('publish_date')
                       ->paginate(12)
                       ->appends($request->query()); // Maintain search parameters in pagination links

        return view('berita', compact('berita', 'search'));
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
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // Increment the view count
        $berita->increment('count_views');

        // Mengirim data berita ke halaman detail
        return view('berita-detail', compact('berita'));
    }
}