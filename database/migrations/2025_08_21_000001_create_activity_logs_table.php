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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_name')->nullable(); // kategori log (auth, news, user, etc)
            $table->text('description'); // deskripsi aktivitas
            $table->string('subject_type')->nullable(); // model yang terkait (App\Models\User, App\Models\Berita, etc)
            $table->unsignedBigInteger('subject_id')->nullable(); // ID dari model yang terkait
            $table->string('causer_type')->nullable(); // model user yang melakukan aktivitas
            $table->unsignedBigInteger('causer_id')->nullable(); // ID user yang melakukan aktivitas
            $table->json('properties')->nullable(); // data tambahan (old/new values, metadata)
            $table->string('batch_uuid')->nullable(); // untuk mengelompokkan aktivitas yang terkait
            $table->string('ip_address')->nullable(); // IP address user
            $table->string('user_agent')->nullable(); // user agent browser
            $table->string('url')->nullable(); // URL yang diakses
            $table->string('method')->nullable(); // HTTP method (GET, POST, PUT, DELETE)
            $table->string('status')->default('success'); // status aktivitas (success, failed, warning)
            $table->timestamps();

            $table->index(['subject_type', 'subject_id']);
            $table->index(['causer_type', 'causer_id']);
            $table->index('log_name');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
