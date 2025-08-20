<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Berita;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $users = User::all();
        $beritas = Berita::all();
        
        if ($users->isEmpty()) {
            $this->command->info('No users found. Creating sample user...');
            $users = collect([User::create([
                'name' => 'Admin Sample',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ])]);
        }
        
        $activities = [
            // Auth activities
            ['log_name' => 'auth', 'description' => 'Login berhasil', 'status' => 'success'],
            ['log_name' => 'auth', 'description' => 'Logout dari sistem', 'status' => 'success'],
            ['log_name' => 'auth', 'description' => 'Percobaan login gagal', 'status' => 'failed'],
            
            // Berita activities
            ['log_name' => 'berita', 'description' => 'Membuat berita baru: Pengumuman Penting', 'status' => 'success'],
            ['log_name' => 'berita', 'description' => 'Mengupdate berita: Berita Terbaru', 'status' => 'success'],
            ['log_name' => 'berita', 'description' => 'Menghapus berita: Berita Lama', 'status' => 'success'],
            
            // User activities
            ['log_name' => 'user', 'description' => 'Membuat pengguna baru', 'status' => 'success'],
            ['log_name' => 'user', 'description' => 'Mengupdate profil pengguna', 'status' => 'success'],
            ['log_name' => 'user', 'description' => 'Menonaktifkan pengguna', 'status' => 'warning'],
            
            // Admin activities
            ['log_name' => 'admin', 'description' => 'Mengakses halaman admin dashboard', 'status' => 'success'],
            ['log_name' => 'admin', 'description' => 'Mengakses halaman admin pengaturan', 'status' => 'success'],
            ['log_name' => 'admin', 'description' => 'Mengupdate pengaturan sistem', 'status' => 'success'],
            
            // Pengumuman activities
            ['log_name' => 'pengumuman', 'description' => 'Membuat pengumuman baru: Info Penting', 'status' => 'success'],
            ['log_name' => 'pengumuman', 'description' => 'Mengupdate pengumuman', 'status' => 'success'],
            
            // Settings activities
            ['log_name' => 'settings', 'description' => 'Mengubah pengaturan umum', 'status' => 'success'],
            ['log_name' => 'settings', 'description' => 'Mengupdate konfigurasi email', 'status' => 'success'],
            
            // Contact activities
            ['log_name' => 'contact', 'description' => 'Membalas pesan kontak', 'status' => 'success'],
            ['log_name' => 'contact', 'description' => 'Menandai pesan sebagai dibaca', 'status' => 'success'],
            
            // Fasilitas activities
            ['log_name' => 'fasilitas', 'description' => 'Menambah fasilitas baru: Laboratorium', 'status' => 'success'],
            ['log_name' => 'fasilitas', 'description' => 'Mengupdate fasilitas: Perpustakaan', 'status' => 'success'],
            
            // Error activities
            ['log_name' => 'error', 'description' => 'Gagal mengupload gambar: file terlalu besar', 'status' => 'failed'],
            ['log_name' => 'error', 'description' => 'Koneksi database terputus', 'status' => 'failed'],
        ];
        
        // Generate logs for the last 30 days
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $logsPerDay = $faker->numberBetween(5, 25); // 5-25 logs per day
            
            for ($j = 0; $j < $logsPerDay; $j++) {
                $activity = $faker->randomElement($activities);
                $user = $faker->randomElement($users);
                $subject = null;
                $subjectType = null;
                $subjectId = null;
                
                // Randomly assign subject for some activities
                if (in_array($activity['log_name'], ['berita']) && $beritas->isNotEmpty()) {
                    $subject = $faker->randomElement($beritas);
                    $subjectType = get_class($subject);
                    $subjectId = $subject->id;
                }
                
                $properties = [
                    'user_agent' => $faker->userAgent(),
                    'referer' => $faker->url(),
                ];
                
                // Add specific properties based on activity
                if ($activity['log_name'] === 'berita') {
                    $properties['title'] = $faker->sentence();
                    $properties['author'] = $user->name;
                }
                
                ActivityLog::create([
                    'log_name' => $activity['log_name'],
                    'description' => $activity['description'],
                    'subject_type' => $subjectType,
                    'subject_id' => $subjectId,
                    'causer_type' => get_class($user),
                    'causer_id' => $user->id,
                    'properties' => $properties,
                    'batch_uuid' => $faker->uuid(),
                    'ip_address' => $faker->ipv4(),
                    'user_agent' => $faker->userAgent(),
                    'url' => 'https://localhost' . $faker->randomElement([
                        '/admin/dashboard',
                        '/admin/berita',
                        '/admin/pengumuman',
                        '/admin/users',
                        '/admin/settings',
                        '/admin/fasilitas',
                        '/admin/contact-messages',
                    ]),
                    'method' => $faker->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
                    'status' => $activity['status'],
                    'created_at' => $date->addMinutes($faker->numberBetween(0, 1439)), // Random time during the day
                    'updated_at' => $date,
                ]);
            }
        }
        
        $this->command->info('Activity logs seeded successfully!');
    }
}
