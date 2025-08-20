<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\NewsletterSubscription;
use App\Mail\NewsletterMail;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Send newsletter to subscribers
     *
     * @param  \App\Models\Berita  $berita
     * @return void
     */
    private function sendNewsletterToSubscribers(Berita $berita)
    {
        // Get all active subscribers for berita type
        $subscribers = NewsletterSubscription::active()
            ->ofType('berita')
            ->get();
            
        foreach ($subscribers as $subscriber) {
            // Send email to each subscriber
            Mail::to($subscriber->email)
                ->queue(new NewsletterMail($berita, 'berita', $subscriber->email));
                
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
        $query = Berita::query();
        
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
        $berita = $query->paginate(10)->withQueryString();
        
        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.berita.create'); // Show create form
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
                'slug' => 'nullable|unique:berita,slug|max:255',
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

            $berita = Berita::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $imagePath,
                'publish_date' => $request->publish_date,
                'author' => $request->author,
                'slug' => $slug,
                'tags' => $request->tags,
            ]);
            
            // Log activity
            ActivityLogger::logCrud('created', $berita, [
                'title' => $berita->title,
                'author' => $berita->author,
                'publish_date' => $berita->publish_date,
            ]);
            
            // Send newsletter to subscribers
            $this->sendNewsletterToSubscribers($berita);

            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berita created successfully.',
                    'berita' => $berita
                ]);
            }

            return redirect()->route('admin.berita.index')->with('success', 'Berita created successfully.');

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
                    'message' => 'An error occurred while creating the berita: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'An error occurred while creating the berita.')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function edit(Berita $berita, Request $request)
    {
        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'berita' => $berita
            ]);
        }

        return view('admin.berita.edit', compact('berita')); // Show edit form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Berita $berita)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'image_path' => 'nullable|image|max:2048',
                'publish_date' => 'required|date',
                'author' => 'nullable|max:255',
                'slug' => 'nullable|unique:berita,slug,' . $berita->id . '|max:255',
                'tags' => 'nullable|string|max:255',
            ]);

            // Handle file upload if present
            $imagePath = $berita->image_path; // Keep the existing image if no new one is uploaded
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

            $oldData = $berita->toArray();
            
            $berita->update([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $imagePath,
                'publish_date' => $request->publish_date,
                'author' => $request->author,
                'slug' => $slug,
                'tags' => $request->tags,
            ]);

            // Log activity
            ActivityLogger::logCrud('updated', $berita, [
                'old_title' => $oldData['title'],
                'new_title' => $berita->title,
                'changes' => $berita->getChanges(),
            ]);

            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berita updated successfully.',
                    'berita' => $berita
                ]);
            }

            return redirect()->route('admin.berita.index')->with('success', 'Berita updated successfully.');

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
                    'message' => 'An error occurred while updating the berita: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'An error occurred while updating the berita.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        try {
            // Store berita data for logging
            $beritaData = [
                'title' => $berita->title,
                'author' => $berita->author,
                'id' => $berita->id,
            ];
            
            // Delete image file if exists
            if ($berita->image_path) {
                Storage::disk('public')->delete($berita->image_path);
            }

            $berita->delete(); // Soft delete the record

            // Log activity
            ActivityLogger::logCrud('deleted', $berita, $beritaData);

            return redirect()->route('admin.berita.index')->with('success', 'Berita deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.berita.index')->with('error', 'An error occurred while deleting the berita.');
        }
    }
}