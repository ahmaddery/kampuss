<?php

namespace Database\Seeders;

use App\Models\VisionMission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisionMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        VisionMission::truncate();

        // Deskripsi pembuka
        VisionMission::create([
            'type' => 'intro',
            'title' => 'Visi Misi',
            'description' => 'Para pendiri Universitas Mercu Buana Yogyakarta memiliki visi dan misi yang kuat untuk menciptakan institusi pendidikan tinggi yang berkualitas. Dengan komitmen terhadap excellence in education, research, dan pengabdian pada masyarakat.',
            'image_path' => 'uploads/visi.jpg'
        ]);

        // Visi
        VisionMission::create([
            'type' => 'vision',
            'title' => 'Visi Universitas Mercu Buana Yogyakarta',
            'description' => 'Menjadi Universitas Unggul yang menghasilkan lulusan berkualitas, berkarakter, dan berdaya saing global pada tahun 2029',
            'year_target' => 2029
        ]);

        // Misi-misi
        $missions = [
            'Menyelenggarakan pendidikan tinggi, penelitian dan pengabdian masyarakat yang berkualitas untuk menghasilkan lulusan yang kompeten dan berkarakter.',
            'Menerapkan sistem pembelajaran yang inovatif dan adaptif sesuai perkembangan teknologi dan kebutuhan industri.',
            'Melakukan kerja sama dengan lembaga pendidikan, industri, dan masyarakat untuk meningkatkan kualitas pendidikan dan pengabdian kepada masyarakat luas.',
            'Mengembangkan penelitian yang relevan dan bermanfaat untuk kemajuan ilmu pengetahuan dan teknologi.',
            'Menciptakan lingkungan akademik yang kondusif untuk pengembangan potensi mahasiswa dan civitas akademika.'
        ];

        foreach ($missions as $index => $mission) {
            VisionMission::create([
                'type' => 'mission',
                'description' => $mission,
                'order' => $index + 1
            ]);
        }
    }
}
