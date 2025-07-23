<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengumuman';

    protected $fillable = [
        'title', 'description', 'image_path', 'publish_date', 'author', 'slug', 'count_views', 'tags'
    ];

    protected $dates = ['deleted_at'];

    protected static function booted()
    {
        static::creating(function ($pengumuman) {
            if (empty($pengumuman->slug)) {
                $pengumuman->slug = Str::slug($pengumuman->title);
            }

            $originalSlug = $pengumuman->slug;
            $counter = 1;
            while (Pengumuman::where('slug', $pengumuman->slug)->exists()) {
                $pengumuman->slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            if (empty($pengumuman->count_views)) {
                $pengumuman->count_views = 0;
            }

            if (empty($pengumuman->tags)) {
                $pengumuman->tags = '';
            }
        });

        static::updating(function ($pengumuman) {
            if (empty($pengumuman->slug)) {
                $pengumuman->slug = Str::slug($pengumuman->title);
            }

            $originalSlug = $pengumuman->slug;
            $counter = 1;
            while (Pengumuman::where('slug', $pengumuman->slug)->exists()) {
                $pengumuman->slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            if (empty($pengumuman->count_views)) {
                $pengumuman->count_views = 0;
            }

            if (empty($pengumuman->tags)) {
                $pengumuman->tags = '';
            }
        });
    }
}