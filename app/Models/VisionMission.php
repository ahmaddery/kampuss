<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    protected $table = 'vision_mission';

    protected $fillable = [
        'type',
        'title',
        'description',
        'order',
        'year_target',
        'image_path'
    ];

    protected $casts = [
        'year_target' => 'integer'
    ];

    // Scope untuk mendapatkan data berdasarkan type
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope untuk mendapatkan intro
    public function scopeIntro($query)
    {
        return $query->where('type', 'intro');
    }

    // Scope untuk mendapatkan vision
    public function scopeVision($query)
    {
        return $query->where('type', 'vision');
    }

    // Scope untuk mendapatkan mission dengan urutan
    public function scopeMission($query)
    {
        return $query->where('type', 'mission')->orderBy('order');
    }

    // Accessor untuk image URL
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }
}
