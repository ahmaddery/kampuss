<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrganizationStructureController extends Controller
{
    public function index()
    {
        $structures = OrganizationStructure::roots()
            ->with(['children' => function ($query) {
                $query->orderBy('order_position');
            }])
            ->get();

        return view('admin.organization-structure.index', compact('structures'));
    }

    public function create()
    {
        $parentOptions = OrganizationStructure::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->getFullPath()
            ];
        })->sortBy('name');

        return view('admin.organization-structure.create', compact('parentOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:organization_structures,id',
            'unit_name' => 'required|string|max:255',
            'position_title' => 'nullable|string|max:255',
            'person_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order_position' => 'integer|min:0'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['unit_name']) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/organization', $filename, 'public');
            $validated['image_path'] = $path;
        }

        OrganizationStructure::create($validated);

        return redirect()->route('admin.organization-structure.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function show(OrganizationStructure $organizationStructure)
    {
        $organizationStructure->load(['parent', 'children']);
        return view('admin.organization-structure.show', compact('organizationStructure'));
    }

    public function edit(OrganizationStructure $organizationStructure)
    {
        $parentOptions = OrganizationStructure::where('id', '!=', $organizationStructure->id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->getFullPath()
                ];
            })
            ->sortBy('name');

        return view('admin.organization-structure.edit', compact('organizationStructure', 'parentOptions'));
    }

    public function update(Request $request, OrganizationStructure $organizationStructure)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:organization_structures,id',
            'unit_name' => 'required|string|max:255',
            'position_title' => 'nullable|string|max:255',
            'person_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order_position' => 'integer|min:0'
        ]);

        // Check if parent_id would create circular reference
        if ($validated['parent_id']) {
            $parent = OrganizationStructure::find($validated['parent_id']);
            $descendants = $organizationStructure->getAllDescendants();
            
            if ($descendants->contains('id', $validated['parent_id'])) {
                return back()->withErrors(['parent_id' => 'Tidak dapat memilih unit yang merupakan anak dari unit ini sebagai parent.']);
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($organizationStructure->image_path) {
                Storage::disk('public')->delete($organizationStructure->image_path);
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['unit_name']) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/organization', $filename, 'public');
            $validated['image_path'] = $path;
        }

        $organizationStructure->update($validated);

        return redirect()->route('admin.organization-structure.index')
            ->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    public function destroy(OrganizationStructure $organizationStructure)
    {
        // Delete image if exists
        if ($organizationStructure->image_path) {
            Storage::disk('public')->delete($organizationStructure->image_path);
        }

        $organizationStructure->delete();

        return redirect()->route('admin.organization-structure.index')
            ->with('success', 'Struktur organisasi berhasil dihapus.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:organization_structures,id',
            'items.*.order_position' => 'required|integer|min:0'
        ]);

        foreach ($request->items as $item) {
            OrganizationStructure::where('id', $item['id'])
                ->update(['order_position' => $item['order_position']]);
        }

        return response()->json(['success' => true]);
    }
}
