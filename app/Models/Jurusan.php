<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    // Kolom-kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'icon',
        'jurusan',
        'deskripsi',
    ];
}
