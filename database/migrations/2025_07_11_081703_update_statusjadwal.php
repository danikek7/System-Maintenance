<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->renameColumn('status_id', 'status_jadwal');
        });
    }

    public function down(): void {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->renameColumn('status_jadwal', 'status_id');
        });
    }
};
