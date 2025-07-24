<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = NewsletterSubscription::query();
        
        // Filter by type
        if ($request->has('type') && in_array($request->type, ['berita', 'pengumuman', 'all'])) {
            $query->where('type', $request->type);
        }
        
        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }
        
        // Search by email
        if ($request->has('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }
        
        $subscriptions = $query->orderBy('created_at', 'desc')
                              ->paginate(15)
                              ->withQueryString();
        
        return view('admin.newsletter.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'type' => 'required|in:berita,pengumuman,all',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if email already exists
        $exists = NewsletterSubscription::withTrashed()
            ->where('email', $request->email)
            ->where('type', $request->type)
            ->first();

        if ($exists) {
            // If subscription exists but was soft deleted, restore it
            if ($exists->trashed()) {
                $exists->restore();
                $exists->is_active = $request->has('is_active');
                $exists->save();
                return redirect()->route('admin.newsletter.index')
                    ->with('success', 'Langganan berhasil dipulihkan.');
            }
            
            return redirect()->back()
                ->with('error', 'Email sudah terdaftar untuk jenis newsletter ini.')
                ->withInput();
        }

        // Create new subscription
        NewsletterSubscription::create([
            'email' => $request->email,
            'type' => $request->type,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Langganan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscription = NewsletterSubscription::findOrFail($id);
        return view('admin.newsletter.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'type' => 'required|in:berita,pengumuman,all',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subscription = NewsletterSubscription::findOrFail($id);
        
        // Check if email already exists for another subscription
        $exists = NewsletterSubscription::where('email', $request->email)
            ->where('type', $request->type)
            ->where('id', '!=', $id)
            ->first();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Email sudah terdaftar untuk jenis newsletter ini.')
                ->withInput();
        }

        $subscription->update([
            'email' => $request->email,
            'type' => $request->type,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Langganan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscription = NewsletterSubscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Langganan berhasil dihapus.');
    }
    
    /**
     * Toggle the active status of a subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleActive($id)
    {
        $subscription = NewsletterSubscription::findOrFail($id);
        $subscription->is_active = !$subscription->is_active;
        $subscription->save();

        $status = $subscription->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Langganan berhasil {$status}.");
    }
}
