<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Test logging dengan timezone WIB
        \App\Services\ActivityLogger::logAuth('Test login ke sistem', \App\Models\User::first(), 'success');
        \App\Services\ActivityLogger::logSystem('Test sistem activity dengan timezone WIB', ['test' => 'timezone']);
        \App\Services\ActivityLogger::logCrud('created', \App\Models\User::first(), ['action' => 'test_create']);
        \App\Services\ActivityLogger::logCrud('updated', \App\Models\User::first(), ['action' => 'test_update']);
        \App\Services\ActivityLogger::logError('Test error activity', ['error' => 'test_error']);
    }
}
