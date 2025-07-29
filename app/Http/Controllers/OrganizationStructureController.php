<?php

namespace App\Http\Controllers;

use App\Models\OrganizationStructure;
use Illuminate\Http\Request;

class OrganizationStructureController extends Controller
{
    public function index()
    {
        $structures = OrganizationStructure::roots()
            ->with(['children' => function ($query) {
                $query->orderBy('order_position');
            }])
            ->get();

        return view('organization-structure', compact('structures'));
    }

    public function show($id)
    {
        $structure = OrganizationStructure::with(['parent', 'children' => function ($query) {
            $query->orderBy('order_position');
        }])->findOrFail($id);

        return view('organization-structure-detail', compact('structure'));
    }

    public function tree()
    {
        $structures = OrganizationStructure::roots()
            ->with(['children' => function ($query) {
                $query->orderBy('order_position')->with(['children' => function ($subQuery) {
                    $subQuery->orderBy('order_position');
                }]);
            }])
            ->get();

        return response()->json($this->buildTreeData($structures));
    }

    private function buildTreeData($structures)
    {
        return $structures->map(function ($structure) {
            $node = [
                'id' => $structure->id,
                'text' => $structure->unit_name,
                'position_title' => $structure->position_title,
                'person_name' => $structure->person_name,
                'image_path' => $structure->image_path,
            ];

            if ($structure->children->isNotEmpty()) {
                $node['children'] = $this->buildTreeData($structure->children);
            }

            return $node;
        });
    }
}
