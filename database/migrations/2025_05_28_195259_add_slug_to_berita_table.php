<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('berita', function (Blueprint $table) {
        $table->string('slug')->unique()->nullable();  // Menambahkan kolom slug
    });
}

public function down()
{
    Schema::table('berita', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
}

};
