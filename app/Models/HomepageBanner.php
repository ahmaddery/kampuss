<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageBanner extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'homepage_banner';

    // Menentukan kolom yang boleh diisi (mass assignment)
    protected $fillable = ['title', 'description', 'image_path'];

    // Menentukan kolom yang akan diperlakukan soft delete
    protected $dates = ['deleted_at'];
}
