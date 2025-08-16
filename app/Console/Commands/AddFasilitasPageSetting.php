<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddFasilitasPageSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setting:add-fasilitas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add fasilitas page setting to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if fasilitas setting already exists
        $exists = DB::table('settings')->where('page_name', 'fasilitas')->exists();
        
        if ($exists) {
            $this->info('Fasilitas page setting already exists.');
            return;
        }

        // Insert fasilitas page setting
        DB::table('settings')->insert([
            'page_name' => 'fasilitas',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->info('Fasilitas page setting added successfully.');
    }
}
