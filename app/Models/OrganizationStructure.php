<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'unit_name',
        'position_title',
        'person_name',
        'image_path',
        'order_position'
    ];

    protected $casts = [
        'order_position' => 'integer'
    ];

    // Relasi ke parent (induk unit)
    public function parent()
    {
        return $this->belongsTo(OrganizationStructure::class, 'parent_id');
    }

    // Relasi ke children (unit di bawahnya)
    public function children()
    {
        return $this->hasMany(OrganizationStructure::class, 'parent_id')->orderBy('order_position');
    }

    // Scope untuk mendapatkan unit root (tanpa parent)
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id')->orderBy('order_position');
    }

    // Scope untuk mendapatkan unit dengan jabatan (bukan unit kosong)
    public function scopeWithPosition($query)
    {
        return $query->whereNotNull('position_title')->whereNotNull('person_name');
    }

    // Method untuk mendapatkan struktur lengkap dengan children
    public function getStructureWithChildren()
    {
        return $this->with(['children' => function ($query) {
            $query->orderBy('order_position');
        }]);
    }

    // Method untuk mendapatkan path lengkap unit
    public function getFullPath()
    {
        $path = collect([$this->unit_name]);
        $parent = $this->parent;
        
        while ($parent) {
            $path->prepend($parent->unit_name);
            $parent = $parent->parent;
        }
        
        return $path->implode(' > ');
    }

    // Method untuk mendapatkan semua descendants
    public function getAllDescendants()
    {
        $descendants = collect();
        
        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->getAllDescendants());
        }
        
        return $descendants;
    }
}
