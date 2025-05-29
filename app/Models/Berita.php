<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;  // Import Str facade untuk generate slug

class Berita extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes trait

    protected $table = 'berita';

    protected $fillable = [
        'title', 'description', 'image_path', 'publish_date', 'author', 'slug', 'count_views', 'tags'
    ];

    protected $dates = ['deleted_at'];

    // Boot method to generate slug automatically when creating a new berita
    protected static function booted()
    {
        static::creating(function ($berita) {
            // If slug is not manually provided, generate it from title
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->title);
            }

            // Ensure the slug is unique
            $originalSlug = $berita->slug;
            $counter = 1;
            while (Berita::where('slug', $berita->slug)->exists()) {
                $berita->slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Set default count_views if not provided
            if (empty($berita->count_views)) {
                $berita->count_views = 0;  // Set default to 0
            }

            // Ensure tags are set if not provided
            if (empty($berita->tags)) {
                $berita->tags = '';  // Set default to empty string or you can set it as a JSON array if preferred
            }
        });

        static::updating(function ($berita) {
            // Ensure the slug is unique when updating
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->title);
            }

            // Ensure the slug is unique
            $originalSlug = $berita->slug;
            $counter = 1;
            while (Berita::where('slug', $berita->slug)->exists()) {
                $berita->slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Ensure count_views and tags are not empty
            if (empty($berita->count_views)) {
                $berita->count_views = 0;  // Set default to 0
            }

            if (empty($berita->tags)) {
                $berita->tags = '';  // Set default to empty string or you can set it as a JSON array if preferred
            }
        });
    }
}
