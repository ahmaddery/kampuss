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
    protected $fillable = ['is_active']; // Hanya kolom is_active yang bisa diisi

    // Tentukan kolom-kolom yang tidak bisa diubah
    protected $guarded = [];

    // Tentukan kolom yang ingin di-cast ke tipe data tertentu
    protected $casts = [
        'is_active' => 'boolean', // Kolom is_active diset sebagai boolean
    ];
}
