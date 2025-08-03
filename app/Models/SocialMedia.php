<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';

    protected $fillable = [
        'platform',
        'name',
        'url',
        'icon_class',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Scope untuk mendapatkan media sosial yang aktif saja
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mengurutkan berdasarkan sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Toggle status aktif/non-aktif
     */
    public static function toggleStatus($platform)
    {
        $social = self::where('platform', $platform)->first();
        if ($social) {
            $social->is_active = !$social->is_active;
            $social->save();
            return $social;
        }
        return null;
    }
}
