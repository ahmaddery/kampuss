<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageBannerTable extends Migration
{
    public function up()
    {
        Schema::create('homepage_banner', function (Blueprint $table) {
            $table->id();  // ID sebagai primary key
            $table->string('title');  // Judul
            $table->text('description');  // Deskripsi
            $table->string('image_path');  // Menyimpan path gambar yang di-upload
            $table->timestamps();  // Menyimpan waktu dibuat dan diubah
            $table->softDeletes();  // Menambahkan kolom soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('homepage_banner');
    }
}
