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
        Schema::create('informasi_program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jurusan_id');
            $table->string('jenjang', 10)->default('S1');
            $table->string('durasi', 50)->default('8 Semester');
            $table->string('sks', 50)->default('144 SKS');
            $table->string('akreditasi', 10)->nullable();
            $table->string('gelar', 50);
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('jurusan_id', 'fk_informasi_program_jurusan')
                  ->references('id')
                  ->on('jurusan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_program');
    }
};
