<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes trait

    // Define the table associated with the model (optional, as it's inferred by Laravel)
    protected $table = 'berita';

    // Define the fillable columns (what can be mass-assigned)
    protected $fillable = [
        'title', 'description', 'image_path', 'publish_date', 'author'
    ];

    // If you want to allow mass assignment of all attributes, you can use:
    // protected $guarded = [];

    // Define the date format for the deleted_at column (optional)
    protected $dates = ['deleted_at'];
}
