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
        schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jadwal');
    $table->string('bulan');
    $table->unsignedBigInteger('status')->nullable();
    $table->unsignedBigInteger('manager_id');
    $table->timestamps();
    $table->unsignedBigInteger('created_by');
    $table->unsignedBigInteger('updated_by');

    $table->foreign('status')->references('id_status')->on('statuses');
    $table->foreign('manager_id')->references('id')->on('users');
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
