<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('detail_jadwal_inspeksis', function (Blueprint $table) {
            $table->unsignedBigInteger('create_by')->nullable()->after('hasil_indikator');

            // FK ke users
            $table->foreign('create_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::table('detail_jadwal_inspeksis', function (Blueprint $table) {
            $table->dropForeign(['create_by']);
            $table->dropColumn('create_by');
        });
    }
};
