<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('detail_jadwal_inspeksis', function (Blueprint $table) {
            // Ubah hasil_indikator jadi boolean
            $table->boolean('hasil_indikator')->nullable()->change();
        });
    }

    public function down(): void {
        Schema::table('detail_jadwal_inspeksis', function (Blueprint $table) {
            // Balik lagi jadi text kalau di-rollback
            $table->text('hasil_indikator')->nullable()->change();
        });
    }
};
