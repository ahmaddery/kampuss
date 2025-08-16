<?php

namespace Database\Factories;

use App\Models\Fasilitas;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fasilitas>
 */
class FasilitasFactory extends Factory
{
    protected $model = Fasilitas::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaFasilitas = $this->faker->randomElement([
            'Perpustakaan Pusat',
            'Laboratorium Komputer',
            'Laboratorium Bahasa',
            'Ruang Kuliah Bersama',
            'Auditorium',
            'Laboratorium Fisika',
            'Laboratorium Kimia',
            'Laboratorium Biologi',
            'Gedung Olahraga',
            'Kantin Mahasiswa',
            'Masjid Kampus',
            'Klinik Kesehatan',
            'Studio Musik',
            'Ruang Seminar',
            'Laboratorium Elektronika'
        ]);

        return [
            'nama_fasilitas' => $namaFasilitas,
            'slug' => Str::slug($namaFasilitas),
            'jurusan_id' => $this->faker->boolean(70) ? Jurusan::inRandomOrder()->first()?->id : null,
            'gambar' => null, // Will be handled separately if needed
            'deskripsi' => $this->faker->sentence(15, 25),
            'deskripsi_lengkap' => $this->faker->paragraphs(3, true),
            'seo_title' => $namaFasilitas,
            'seo_description' => $this->faker->sentence(20),
            'lokasi' => $this->faker->randomElement([
                'Gedung A, Lantai 1',
                'Gedung B, Lantai 2',
                'Gedung C, Lantai 3',
                'Kompleks Laboratorium',
                'Gedung Rektorat',
                'Kampus Pusat',
                'Gedung D, Lantai 1',
                'Area Outdoor'
            ]),
            'jam_operasional' => $this->faker->randomElement([
                '08:00 - 17:00',
                '07:00 - 21:00',
                '24 Jam',
                '08:00 - 16:00',
                '09:00 - 15:00',
                'Senin-Jumat 08:00-17:00'
            ]),
            'kontak' => $this->faker->randomElement([
                $this->faker->phoneNumber,
                $this->faker->email,
                '0812345678',
                'info@kampus.ac.id'
            ]),
            'status' => $this->faker->randomElement(['aktif', 'aktif', 'aktif', 'nonaktif']), // 75% aktif
        ];
    }
}
