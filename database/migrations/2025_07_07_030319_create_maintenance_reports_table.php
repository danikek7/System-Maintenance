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
        Schema::create('maintenance_reports', function (Blueprint $table) {
            $table->id('id_reports'); // Primary key
            $table->unsignedBigInteger('schedule_id'); // FK ke maintenance_schedule
            $table->date('report_date');
            $table->unsignedBigInteger('created_by')->nullable(); // FK ke users
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('parameter_id')->nullable(); // FK opsional ke tabel lain (belum disebutkan)
            $table->unsignedBigInteger('status')->nullable(); // FK ke status_labels
            $table->timestamps();

            // Relasi
            $table->foreign('schedule_id')->references('id')->on('maintenance_schedule')->cascadeOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('status')->references('id')->on('status_labels')->nullOnDelete();

            // Kalau nanti parameter_id ada tabel tujuan, bisa disesuaikan:
            // $table->foreign('parameter_id')->references('id')->on('nama_tabel_parameter')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_reports');
    }
};
