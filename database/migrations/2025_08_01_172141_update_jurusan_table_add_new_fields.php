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
        Schema::table('jurusan', function (Blueprint $table) {
            // Make icon nullable
            $table->string('icon')->nullable()->change();
            
            // Add new fields without unique constraint first
            $table->string('slug')->nullable()->after('jurusan');
            $table->longText('deskripsi_lengkap')->nullable()->after('deskripsi');
            $table->string('seo_title')->nullable()->after('deskripsi_lengkap');
            $table->text('seo_description')->nullable()->after('seo_title');
        });

        // Update existing records to generate slugs
        $jurusans = \App\Models\Jurusan::all();
        foreach ($jurusans as $jurusan) {
            $slug = \Illuminate\Support\Str::slug($jurusan->jurusan);
            
            // Ensure unique slug
            $originalSlug = $slug;
            $counter = 1;
            while (\App\Models\Jurusan::where('slug', $slug)->where('id', '!=', $jurusan->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            $jurusan->update(['slug' => $slug]);
        }

        // Now add unique constraint
        Schema::table('jurusan', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            // Remove unique constraint first
            $table->dropUnique(['slug']);
            
            // Remove added fields
            $table->dropColumn(['slug', 'deskripsi_lengkap', 'seo_title', 'seo_description']);
            
            // Revert icon to not nullable (if needed)
            $table->string('icon')->nullable(false)->change();
        });
    }
};
