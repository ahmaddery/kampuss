<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create default settings if they don't exist
        if (Setting::count() === 0) {
            Setting::create([
                'is_active' => true
            ]);
        }
    }
}
