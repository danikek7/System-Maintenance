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
        Schema::create('inspeksis', function (Blueprint $table) {
    $table->id('id_inspeksi');
    $table->unsignedBigInteger('status')->nullable();
    $table->unsignedBigInteger('id_pic');
    $table->unsignedBigInteger('id_manager');
    $table->timestamps();
    $table->unsignedBigInteger('created_by');
    $table->timestamp('approve_at')->nullable();

    $table->foreign('status')->references('id_status')->on('statuses');
    $table->foreign('id_pic')->references('id')->on('users');
    $table->foreign('id_manager')->references('id')->on('users');
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
