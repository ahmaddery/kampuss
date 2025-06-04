<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel `settings`.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true); // Kolom is_active
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi dengan menghapus tabel `settings`.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

