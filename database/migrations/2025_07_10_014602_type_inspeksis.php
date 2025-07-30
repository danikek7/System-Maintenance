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
        Schema::create('type_inspeksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_type_inspeksi');
            //$table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
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
