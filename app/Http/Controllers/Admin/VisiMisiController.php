<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visionMissions = VisionMission::orderBy('type')->orderBy('order')->get();
        
        // Group by type for better display
        $grouped = $visionMissions->groupBy('type');
        
        return view('admin.visi-misi.index', compact('grouped'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visi-misi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'type' => 'required|in:intro,vision,mission',
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'order' => 'nullable|integer|min:1',
            'year_target' => 'nullable|integer|min:2020|max:2050',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        // Validation rules based on type
        if ($request->type === 'mission') {
            $rules['order'] = 'required|integer|min:1';
        }

        if ($request->type === 'vision') {
            $rules['year_target'] = 'nullable|integer|min:2020|max:2050';
        }

        $validated = $request->validate($rules);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vision-mission', 'public');
            $validated['image_path'] = $imagePath;
        }

        VisionMission::create($validated);

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data visi misi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VisionMission $visionMission)
    {
        return view('admin.visi-misi.show', compact('visionMission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisionMission $visionMission)
    {
        return view('admin.visi-misi.edit', compact('visionMission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisionMission $visionMission)
    {
        $rules = [
            'type' => 'required|in:intro,vision,mission',
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'order' => 'nullable|integer|min:1',
            'year_target' => 'nullable|integer|min:2020|max:2050',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        // Validation rules based on type
        if ($request->type === 'mission') {
            $rules['order'] = 'required|integer|min:1';
        }

        if ($request->type === 'vision') {
            $rules['year_target'] = 'nullable|integer|min:2020|max:2050';
        }

        $validated = $request->validate($rules);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($visionMission->image_path) {
                Storage::disk('public')->delete($visionMission->image_path);
            }
            
            $imagePath = $request->file('image')->store('vision-mission', 'public');
            $validated['image_path'] = $imagePath;
        }

        $visionMission->update($validated);

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data visi misi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisionMission $visionMission)
    {
        // Delete image if exists
        if ($visionMission->image_path) {
            Storage::disk('public')->delete($visionMission->image_path);
        }

        $visionMission->delete();

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data visi misi berhasil dihapus.');
    }

    /**
     * Get data by type for API or AJAX calls
     */
    public function getByType($type)
    {
        $data = VisionMission::byType($type)->get();
        
        if ($type === 'mission') {
            $data = $data->sortBy('order');
        }

        return response()->json($data);
    }

    /**
     * Reorder missions
     */
    public function reorderMissions(Request $request)
    {
        $request->validate([
            'missions' => 'required|array',
            'missions.*.id' => 'required|exists:vision_mission,id',
            'missions.*.order' => 'required|integer|min:1'
        ]);

        foreach ($request->missions as $mission) {
            VisionMission::where('id', $mission['id'])
                ->where('type', 'mission')
                ->update(['order' => $mission['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan misi berhasil diperbarui.']);
    }
}
