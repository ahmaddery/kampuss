<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak menggunakan konvensi Laravel
    protected $table = 'settings'; // Gunakan tabel 'settings'

    // Tentukan kolom yang boleh diisi menggunakan mass assignment
    protected $fillable = ['page_name', 'page_title', 'description', 'is_active']; // Kolom yang bisa diisi

    // Tentukan kolom-kolom yang tidak bisa diubah
    protected $guarded = [];

    // Tentukan kolom yang ingin di-cast ke tipe data tertentu
    protected $casts = [
        'is_active' => 'boolean', // Kolom is_active diset sebagai boolean
    ];

    /**
     * Scope untuk mendapatkan setting berdasarkan nama halaman
     */
    public function scopeByPageName($query, $pageName)
    {
        return $query->where('page_name', $pageName);
    }

    /**
     * Helper method untuk check apakah halaman aktif
     */
    public static function isPageActive($pageName)
    {
        $setting = self::where('page_name', $pageName)->first();
        return $setting ? $setting->is_active : true; // Default true jika tidak ada setting
    }

    /**
     * Helper method untuk toggle status halaman
     */
    public static function togglePageStatus($pageName)
    {
        $setting = self::where('page_name', $pageName)->first();
        if ($setting) {
            $setting->is_active = !$setting->is_active;
            $setting->save();
            return $setting;
        }
        return null;
    }
}
