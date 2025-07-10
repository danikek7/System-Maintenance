<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_type_inspeksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_type_inspeksi');
            $table->string('nama');
            $table->timestamps();

            // FK
            $table->foreign('id_type_inspeksi')->references('id')->on('type_inspeksis')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('detail_type_inspeksis');
    }
};
