<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    // Kolom-kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'icon',
        'jurusan',
        'slug',
        'deskripsi',
        'deskripsi_lengkap',
        'seo_title',
        'seo_description',
    ];

    /**
     * Boot the model to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($jurusan) {
            if (empty($jurusan->slug)) {
                $jurusan->slug = Str::slug($jurusan->jurusan);
            }
        });

        static::updating(function ($jurusan) {
            if ($jurusan->isDirty('jurusan') && empty($jurusan->slug)) {
                $jurusan->slug = Str::slug($jurusan->jurusan);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relationship with InformasiProgram
     */
    public function informasiProgram()
    {
        return $this->hasOne(InformasiProgram::class);
    }
}
