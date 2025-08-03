<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\NewsletterSubscription;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Send newsletter to subscribers
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return void
     */
    private function sendNewsletterToSubscribers(Pengumuman $pengumuman)
    {
        // Get all active subscribers for pengumuman type
        $subscribers = NewsletterSubscription::active()
            ->ofType('pengumuman')
            ->get();
            
        foreach ($subscribers as $subscriber) {
            // Send email to each subscriber
            Mail::to($subscriber->email)
                ->queue(new NewsletterMail($pengumuman, 'pengumuman', $subscriber->email));
                
            // Update last_sent_at timestamp
            $subscriber->update(['last_sent_at' => now()]);
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Pengumuman::query();
        
        // Handle search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('author', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('tags', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Handle date filter
        if ($request->filled('date_from')) {
            $query->whereDate('publish_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('publish_date', '<=', $request->date_to);
        }
        
        // Order by latest first
        $query->orderBy('created_at', 'desc');
        
        // Paginate results
        $pengumuman = $query->paginate(10)->withQueryString();
        
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengumuman.create'); // Show create form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'image_path' => 'nullable|image|max:2048',
                'publish_date' => 'required|date',
                'author' => 'nullable|max:255',
                'slug' => 'nullable|unique:pengumuman,slug|max:255',
                'tags' => 'nullable|string|max:255',
            ]);

            // Handle file upload if present
            $imagePath = null;
            if ($request->hasFile('image_path')) {
                $imagePath = $request->file('image_path')->store('images', 'public');
            }

            // Generate slug if not provided or if random_slug is checked
            $slug = $request->slug ?? '';
            if ($request->has('random_slug') || empty($slug)) {
                $slug = ''; // Let the model handle auto-generation
            }

            $pengumuman = Pengumuman::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $imagePath,
                'publish_date' => $request->publish_date,
                'author' => $request->author,
                'slug' => $slug,
                'tags' => $request->tags,
            ]);
            
            // Send newsletter to subscribers
            $this->sendNewsletterToSubscribers($pengumuman);

            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengumuman created successfully.',
                    'pengumuman' => $pengumuman
                ]);
            }

            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $e->errors()
                ], 422);
            }
            
            return redirect()->back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while creating the pengumuman: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'An error occurred while creating the pengumuman.')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function edit(Pengumuman $pengumuman, Request $request)
    {
        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'pengumuman' => $pengumuman
            ]);
        }

        return view('admin.pengumuman.edit', compact('pengumuman')); // Show edit form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'image_path' => 'nullable|image|max:2048',
                'publish_date' => 'required|date',
                'author' => 'nullable|max:255',
                'slug' => 'nullable|unique:pengumuman,slug,' . $pengumuman->id . '|max:255',
                'tags' => 'nullable|string|max:255',
            ]);

            // Handle file upload if present
            $imagePath = $pengumuman->image_path; // Keep the existing image if no new one is uploaded
            if ($request->hasFile('image_path')) {
                // Delete old image
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file('image_path')->store('images', 'public');
            }

            // Generate slug if not provided or if random_slug is checked
            $slug = $request->slug ?? '';
            if ($request->has('random_slug') || empty($slug)) {
                $slug = ''; // Let the model handle auto-generation
            }

            $pengumuman->update([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $imagePath,
                'publish_date' => $request->publish_date,
                'author' => $request->author,
                'slug' => $slug,
                'tags' => $request->tags,
            ]);

            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengumuman updated successfully.',
                    'pengumuman' => $pengumuman
                ]);
            }

            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $e->errors()
                ], 422);
            }
            
            return redirect()->back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the pengumuman: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'An error occurred while updating the pengumuman.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {
        try {
            // Delete image file if exists
            if ($pengumuman->image_path) {
                Storage::disk('public')->delete($pengumuman->image_path);
            }

            $pengumuman->delete(); // Soft delete the record

            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.pengumuman.index')->with('error', 'An error occurred while deleting the pengumuman.');
        }
    }
}