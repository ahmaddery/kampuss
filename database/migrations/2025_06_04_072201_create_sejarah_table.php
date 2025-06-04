<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSejarahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sejarah', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->string('judul');  // Kolom judul (varchar)
            $table->text('deskripsi');  // Kolom deskripsi (text)
            $table->string('foto')->nullable();  // Kolom foto (varchar) dengan nilai nullable
            $table->timestamps();  // Menyimpan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sejarah');
    }
}
