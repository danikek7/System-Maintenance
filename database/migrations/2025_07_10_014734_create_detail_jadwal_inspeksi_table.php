<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_jadwal_inspeksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detail_jadwal');
            $table->unsignedBigInteger('id_detail_type_inspeksi');
            $table->text('notes')->nullable();
            $table->text('hasil_indikator')->nullable();
            $table->timestamps();

            // FK
            $table->foreign('id_detail_jadwal')->references('id')->on('detail_jadwals')->cascadeOnDelete();
            $table->foreign('id_detail_type_inspeksi')->references('id')->on('detail_type_inspeksis')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('detail_jadwal_inspeksis');
    }
};
