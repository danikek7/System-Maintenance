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
        Schema::table('users', function (Blueprint $table) {
            // Rename kolom id ke id_user
            $table->renameColumn('id', 'id_user');

            // Tambahkan kolom baru
            $table->string('nama_user')->after('id_user');
            $table->string('username')->unique()->after('nama_user');
            $table->string('role')->after('password');

            // Hapus kolom default yang tidak dipakai
            $table->dropColumn(['name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Balik nama kolom id_user ke id
            $table->renameColumn('id_user', 'id');

            // Hapus kolom tambahan
            $table->dropColumn(['nama_user', 'username', 'role']);

            // Tambahkan kembali kolom default Laravel
            $table->string('name');
            $table->string('email')->unique();
        });
    }
};
