<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenance_schedule', function (Blueprint $table) {
            $table->string('nama_jadwal')->after('id'); // Tambahkan kolom di posisi setelah id
        });
    }

    public function down(): void
    {
        Schema::table('maintenance_schedule', function (Blueprint $table) {
            $table->dropColumn('nama_jadwal');
        });
    }
};
