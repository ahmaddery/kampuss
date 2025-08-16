<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';

    protected $fillable = [
        'nama_fasilitas',
        'slug',
        'jurusan_id',
        'gambar',
        'deskripsi',
        'deskripsi_lengkap',
        'seo_title',
        'seo_description',
        'lokasi',
        'jam_operasional',
        'kontak',
        'status'
    ];

    protected $casts = [
        'gambar' => 'array',
    ];

    // Relationship ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($fasilitas) {
            if (empty($fasilitas->slug)) {
                $fasilitas->slug = Str::slug($fasilitas->nama_fasilitas);
            }
        });

        static::updating(function ($fasilitas) {
            if ($fasilitas->isDirty('nama_fasilitas')) {
                $fasilitas->slug = Str::slug($fasilitas->nama_fasilitas);
            }
        });
    }

    // Scope untuk fasilitas aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Getter untuk gambar utama
    public function getGambarUtamaAttribute()
    {
        if ($this->gambar && is_array($this->gambar) && count($this->gambar) > 0) {
            return $this->gambar[0];
        }
        return null;
    }

    // Getter untuk URL gambar utama
    public function getGambarUtamaUrlAttribute()
    {
        if ($this->gambar_utama) {
            return asset('storage/' . $this->gambar_utama);
        }
        return asset('images/default-facility.jpg');
    }
}