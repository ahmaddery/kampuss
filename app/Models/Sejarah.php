<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;

    // Tentukan nama tabel (jika berbeda dengan nama model yang sudah otomatis plural)
    protected $table = 'sejarah';

    // Tentukan kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
    ];

    // Tentukan kolom yang tidak bisa diisi (bisa digunakan jika ada kolom yang perlu dilindungi)
    // protected $guarded = ['id'];

    // Tentukan tipe data untuk kolom yang ada
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
