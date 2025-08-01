<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiProgram extends Model
{
    use HasFactory;

    protected $table = 'informasi_program';

    protected $fillable = [
        'jurusan_id',
        'jenjang',
        'durasi',
        'sks',
        'akreditasi',
        'gelar',
    ];

    /**
     * Relationship with Jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
