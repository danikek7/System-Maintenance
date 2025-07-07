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
        Schema::create('maintenance_schedule', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('asset_id'); // FK ke tabel assets
            $table->date('schedule_date');
            $table->unsignedBigInteger('created_by')->nullable(); // FK ke users
            $table->unsignedBigInteger('status')->nullable(); // FK ke status_labels
            $table->unsignedBigInteger('model_id')->nullable(); // FK ke models
            $table->unsignedBigInteger('location_id')->nullable(); // FK ke locations
            $table->timestamps();

            // Relasi
            $table->foreign('asset_id')->references('id')->on('assets')->cascadeOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('status')->references('id')->on('status_labels')->nullOnDelete();
            $table->foreign('model_id')->references('id')->on('models')->nullOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_schedule');
    }
};
