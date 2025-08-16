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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->json('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->longText('deskripsi_lengkap')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('jam_operasional', 100)->nullable();
            $table->string('kontak', 100)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('set null');
            $table->index(['slug', 'status']);
            $table->index(['jurusan_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
