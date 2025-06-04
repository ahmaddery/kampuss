<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambutanRektor extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'sambutan_rektor';

    // Tentukan kolom mana yang boleh diisi massal
    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
    ];
}
