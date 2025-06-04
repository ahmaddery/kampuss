<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSambutanRektorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sambutan_rektor', function (Blueprint $table) {
            $table->id(); // kolom primary key
            $table->string('judul'); // kolom judul
            $table->text('deskripsi'); // kolom deskripsi untuk sambutan
            $table->string('foto'); // kolom untuk menyimpan nama file foto
            $table->timestamps(); // kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sambutan_rektor');
    }
}
