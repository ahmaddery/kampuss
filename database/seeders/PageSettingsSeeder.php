<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class PageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_name' => 'sambutan-rektor',
                'page_title' => 'Sambutan Rektor',
                'description' => 'Halaman sambutan dari Rektor universitas',
                'is_active' => true
            ],
            [
                'page_name' => 'sejarah',
                'page_title' => 'Sejarah',
                'description' => 'Halaman sejarah universitas',
                'is_active' => true
            ],
            [
                'page_name' => 'visi-misi',
                'page_title' => 'Visi & Misi',
                'description' => 'Halaman visi dan misi universitas',
                'is_active' => true
            ],
            [
                'page_name' => 'struktur-organisasi',
                'page_title' => 'Struktur Organisasi',
                'description' => 'Halaman struktur organisasi universitas',
                'is_active' => true
            ],
            [
                'page_name' => 'berita',
                'page_title' => 'Berita',
                'description' => 'Halaman berita dan informasi terkini',
                'is_active' => true
            ],
            [
                'page_name' => 'pengumuman',
                'page_title' => 'Pengumuman',
                'description' => 'Halaman pengumuman resmi universitas',
                'is_active' => true
            ],
            [
                'page_name' => 'jurusan',
                'page_title' => 'Program Studi',
                'description' => 'Halaman informasi program studi yang tersedia',
                'is_active' => true
            ]
        ];

        foreach ($pages as $page) {
            Setting::updateOrCreate(
                ['page_name' => $page['page_name']],
                $page
            );
        }
    }
}
