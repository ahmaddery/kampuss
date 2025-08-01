<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\InformasiProgram;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only add informasi_program data for existing jurusan records
        $jurusanProgramData = [
            'Teknik Informatika' => [
                'jenjang' => 'S1',
                'durasi' => '8 Semester',
                'sks' => '144 SKS',
                'akreditasi' => 'B',
                'gelar' => 'S.Kom'
            ],
            'Sistem Informasi' => [
                'jenjang' => 'S1',
                'durasi' => '8 Semester',
                'sks' => '144 SKS',
                'akreditasi' => 'B',
                'gelar' => 'S.Kom'
            ],
            'Manajemen' => [
                'jenjang' => 'S1',
                'durasi' => '8 Semester',
                'sks' => '144 SKS',
                'akreditasi' => 'B',
                'gelar' => 'S.E.'
            ],
            'Akuntansi' => [
                'jenjang' => 'S1',
                'durasi' => '8 Semester',
                'sks' => '144 SKS',
                'akreditasi' => 'B',
                'gelar' => 'S.Ak.'
            ],
        ];

        foreach ($jurusanProgramData as $namaJurusan => $programData) {
            // Find existing jurusan by name
            $jurusan = Jurusan::where('jurusan', $namaJurusan)->first();
            
            if ($jurusan) {
                // Create or update informasi_program
                InformasiProgram::updateOrCreate(
                    ['jurusan_id' => $jurusan->id],
                    $programData
                );
            }
        }
    }
}
