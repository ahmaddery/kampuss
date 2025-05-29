<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountViewsTagsToBeritaTable extends Migration
{
    /**
     * Jalankan migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            // Menambahkan kolom count_views
            $table->unsignedInteger('count_views')->default(0)->after('slug');

            // Menambahkan kolom tags sebagai text (dapat menyimpan tag dalam format koma atau JSON)
            $table->text('tags')->nullable()->after('author');
            
            // Menambahkan index pada kolom 'slug' untuk pencarian cepat berdasarkan slug
            $table->index('slug');
            
            // Menambahkan index pada kolom 'tags' untuk pencarian cepat pada tag
            $table->index(['tags']);
        });
    }

    /**
     * Membalikkan perubahan (rollback) migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            // Menghapus kolom
            $table->dropColumn('count_views');
            $table->dropColumn('tags');

            // Menghapus index
            $table->dropIndex(['slug']);
            $table->dropIndex(['tags']);
        });
    }
}
