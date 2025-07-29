<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationStructure;

class OrganizationStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        OrganizationStructure::truncate();

        // Create the organization structure data
        $structures = [
            [
                'id' => 1,
                'parent_id' => null,
                'unit_name' => 'Pimpinan Universitas',
                'position_title' => null,
                'person_name' => null,
                'image_path' => 'uploads/univ.png',
                'order_position' => 0,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'unit_name' => 'Universitas',
                'position_title' => 'Rektor',
                'person_name' => 'Dr. Agus Slamet, S.TP., M.P., MCE',
                'image_path' => null,
                'order_position' => 0,
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'unit_name' => 'Universitas',
                'position_title' => 'Wakil Rektor I',
                'person_name' => 'Ir. Wafit Dinarto, M.Si., MCE',
                'image_path' => null,
                'order_position' => 1,
            ],
            [
                'id' => 4,
                'parent_id' => null,
                'unit_name' => 'Fakultas Agroindustri',
                'position_title' => null,
                'person_name' => null,
                'image_path' => 'uploads/agro.png',
                'order_position' => 1,
            ],
            [
                'id' => 5,
                'parent_id' => 4,
                'unit_name' => 'Fakultas Agroindustri',
                'position_title' => 'Dekan',
                'person_name' => 'Prof. Dr. Chatarina Lilis Suryani, S.TP., M.P',
                'image_path' => null,
                'order_position' => 0,
            ],
            [
                'id' => 6,
                'parent_id' => 4,
                'unit_name' => 'Prodi Agroteknologi',
                'position_title' => 'Ketua Prodi',
                'person_name' => 'Dr. Ir. Dian Astriani, SP, M.P.',
                'image_path' => null,
                'order_position' => 1,
            ],
            [
                'id' => 7,
                'parent_id' => null,
                'unit_name' => 'Program Pascasarjana',
                'position_title' => null,
                'person_name' => null,
                'image_path' => 'uploads/pasca.png',
                'order_position' => 2,
            ],
            [
                'id' => 8,
                'parent_id' => 7,
                'unit_name' => 'Magister Ilmu Pangan',
                'position_title' => 'Ketua Program',
                'person_name' => 'Prof. Dr. Ir. Siti Tamaroh CM, M.P.',
                'image_path' => null,
                'order_position' => 0,
            ],
        ];

        foreach ($structures as $structure) {
            OrganizationStructure::create($structure);
        }

        $this->command->info('Organization structure data seeded successfully!');
    }
}
