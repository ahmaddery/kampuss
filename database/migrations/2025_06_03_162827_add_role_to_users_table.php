<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsersTable extends Migration
{
    /**
     * Menjalankan migrasi untuk menambahkan kolom `role` pada tabel `users`.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom 'role' dengan tipe string, nilai default 'admin'
            $table->enum('role', ['superadmin', 'admin'])->default('admin'); // Role dengan pilihan 'superadmin' atau 'admin'
        });
    }

    /**
     * Membatalkan migrasi dengan menghapus kolom `role`.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'role' jika migrasi dibatalkan
            $table->dropColumn('role');
        });
    }
}
