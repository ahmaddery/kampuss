<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimpleFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $fasilitas = [
            [
                'nama_fasilitas' => 'Perpustakaan Pusat',
                'slug' => 'perpustakaan-pusat',
                'jurusan_id' => null,
                'gambar' => null,
                'deskripsi' => 'Perpustakaan dengan koleksi buku dan jurnal terlengkap untuk mendukung proses pembelajaran.',
                'deskripsi_lengkap' => 'Perpustakaan Pusat dilengkapi dengan ruang baca yang nyaman, akses internet gratis, dan koleksi buku serta jurnal digital yang dapat diakses 24 jam.',
                'seo_title' => 'Perpustakaan Pusat - Fasilitas Kampus',
                'seo_description' => 'Perpustakaan Pusat dengan koleksi lengkap dan fasilitas modern',
                'lokasi' => 'Gedung Perpustakaan, Lantai 1-3',
                'jam_operasional' => '07:00 - 21:00',
                'kontak' => 'perpustakaan@kampus.ac.id',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Laboratorium Komputer',
                'slug' => 'laboratorium-komputer',
                'jurusan_id' => null,
                'gambar' => null,
                'deskripsi' => 'Laboratorium komputer dengan perangkat modern untuk praktikum IT.',
                'deskripsi_lengkap' => 'Laboratorium Komputer dilengkapi dengan PC dan software terbaru untuk mendukung praktikum mata kuliah teknologi informasi.',
                'seo_title' => 'Laboratorium Komputer - Fasilitas Kampus',
                'seo_description' => 'Laboratorium komputer modern dengan perangkat terbaru',
                'lokasi' => 'Gedung Teknik, Lantai 2',
                'jam_operasional' => '08:00 - 17:00',
                'kontak' => '021-12345678',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Auditorium',
                'slug' => 'auditorium',
                'jurusan_id' => null,
                'gambar' => null,
                'deskripsi' => 'Auditorium dengan kapasitas 500 orang untuk acara besar.',
                'deskripsi_lengkap' => 'Auditorium kampus dapat menampung hingga 500 orang dan dilengkapi dengan sistem audio visual modern.',
                'seo_title' => 'Auditorium - Fasilitas Kampus',
                'seo_description' => 'Auditorium berkapasitas 500 orang dengan fasilitas modern',
                'lokasi' => 'Gedung Utama, Lantai 1',
                'jam_operasional' => '08:00 - 22:00',
                'kontak' => 'events@kampus.ac.id',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($fasilitas as $item) {
            DB::table('fasilitas')->insert($item);
        }
    }
}
