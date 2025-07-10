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
        Schema::create('detail_type_inspeksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_inspeksi_id');
            $table->string('nama_detail_type_inspeksi');
            //$table->timestamps();
            //$table->softDeletes();

            $table->foreign('type_inspeksi_id')->references('id')->on('type_inspeksis')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
