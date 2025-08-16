<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Biro extends Model
{
    protected $table = 'biro';
    
    protected $fillable = [
        'nama_biro',
        'slug',
        'logo',
        'gambar',
        'deskripsi',
        'deskripsi_lengkap',
        'seo_title',
        'seo_description',
        'status'
    ];

    protected $casts = [
        'gambar' => 'array',
    ];

    // Automatically generate slug when creating/updating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($biro) {
            if (empty($biro->slug)) {
                $biro->slug = static::generateUniqueSlug($biro->nama_biro);
            }
        });

        static::updating(function ($biro) {
            if ($biro->isDirty('nama_biro') && empty($biro->slug)) {
                $biro->slug = static::generateUniqueSlug($biro->nama_biro);
            }
        });
    }

    public static function generateUniqueSlug($nama_biro)
    {
        $slug = Str::slug($nama_biro);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Scope for active biro
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Get route key name for route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
