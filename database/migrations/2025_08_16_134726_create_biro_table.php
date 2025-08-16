<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biro', function (Blueprint $table) {
            $table->id();
            $table->string('nama_biro');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->json('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->longText('deskripsi_lengkap')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biro');
    }
};
