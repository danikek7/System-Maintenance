<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Ubah dulu menjadi integer jika sebelumnya string
            $table->unsignedBigInteger('rtd_location')->nullable()->change();

            // Tambahkan foreign key jika belum ada
            $table->foreign('rtd_location')->references('id')->on('locations')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign(['rtd_location']);
            $table->string('rtd_location')->nullable()->change();
        });
    }
};
