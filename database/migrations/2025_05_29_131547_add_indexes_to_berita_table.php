<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            // Add indexes for search optimization
            $table->index('title', 'idx_berita_title');
            $table->index('author', 'idx_berita_author');
            $table->index('publish_date', 'idx_berita_publish_date');
            $table->index('slug', 'idx_berita_slug');
            
            // Add fulltext index for better text search performance
            $table->fullText(['title', 'description'], 'idx_berita_fulltext');
            
            // Add composite index for common queries
            $table->index(['publish_date', 'deleted_at'], 'idx_berita_publish_deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            // Drop the indexes
            $table->dropIndex('idx_berita_title');
            $table->dropIndex('idx_berita_author');
            $table->dropIndex('idx_berita_publish_date');
            $table->dropIndex('idx_berita_slug');
            $table->dropIndex('idx_berita_fulltext');
            $table->dropIndex('idx_berita_publish_deleted');
        });
    }
};