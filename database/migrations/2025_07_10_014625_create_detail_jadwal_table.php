<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('asset_id');
            $table->string('nama_asset')->nullable();
            $table->unsignedBigInteger('location_id');
            $table->string('nama_location')->nullable();
            $table->timestamp('inspeksi_at')->nullable();
            $table->timestamps();

            // FK
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->cascadeOnDelete();
            $table->foreign('asset_id')->references('id')->on('assets')->cascadeOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('detail_jadwals');
    }
};
