<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample fasilitas
        Fasilitas::factory(10)->create();
        
        // Create some specific important facilities
        $importantFacilities = [
            [
                'nama_fasilitas' => 'Perpustakaan Pusat',
                'slug' => 'perpustakaan-pusat',
                'jurusan_id' => null,
                'deskripsi' => 'Perpustakaan utama kampus dengan koleksi buku dan jurnal lengkap',
                'deskripsi_lengkap' => 'Perpustakaan Pusat adalah fasilitas utama untuk kegiatan belajar dan penelitian mahasiswa. Dilengkapi dengan koleksi buku fisik dan digital, ruang baca yang nyaman, dan akses internet untuk mendukung aktivitas akademik.',
                'seo_title' => 'Perpustakaan Pusat - Fasilitas Kampus',
                'seo_description' => 'Perpustakaan Pusat dengan koleksi lengkap dan fasilitas modern untuk mendukung kegiatan belajar mahasiswa',
                'lokasi' => 'Gedung Perpustakaan, Lantai 1-3',
                'jam_operasional' => '07:00 - 21:00',
                'kontak' => 'perpustakaan@kampus.ac.id',
                'status' => 'aktif'
            ],
            [
                'nama_fasilitas' => 'Laboratorium Komputer',
                'slug' => 'laboratorium-komputer',
                'jurusan_id' => null,
                'deskripsi' => 'Laboratorium komputer dengan perangkat modern untuk praktikum IT',
                'deskripsi_lengkap' => 'Laboratorium Komputer dilengkapi dengan PC dan software terbaru untuk mendukung praktikum mata kuliah teknologi informasi. Tersedia akses internet berkecepatan tinggi dan proyektor untuk presentasi.',
                'seo_title' => 'Laboratorium Komputer - Fasilitas Kampus',
                'seo_description' => 'Laboratorium komputer modern dengan perangkat terbaru untuk praktikum mahasiswa',
                'lokasi' => 'Gedung Teknik, Lantai 2',
                'jam_operasional' => '08:00 - 17:00',
                'kontak' => '021-12345678',
                'status' => 'aktif'
            ],
            [
                'nama_fasilitas' => 'Auditorium',
                'slug' => 'auditorium',
                'jurusan_id' => null,
                'deskripsi' => 'Auditorium dengan kapasitas 500 orang untuk acara besar',
                'deskripsi_lengkap' => 'Auditorium kampus dapat menampung hingga 500 orang dan dilengkapi dengan sistem audio visual modern, AC central, dan pencahayaan yang memadai untuk berbagai kegiatan seperti seminar, konferensi, dan wisuda.',
                'seo_title' => 'Auditorium - Fasilitas Kampus',
                'seo_description' => 'Auditorium berkapasitas 500 orang dengan fasilitas modern untuk berbagai acara kampus',
                'lokasi' => 'Gedung Utama, Lantai 1',
                'jam_operasional' => '08:00 - 22:00',
                'kontak' => 'events@kampus.ac.id',
                'status' => 'aktif'
            ]
        ];

        foreach ($importantFacilities as $facility) {
            Fasilitas::create($facility);
        }
    }
}
