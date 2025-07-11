<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('jadwals', function (Blueprint $table) {
            // Hapus foreign key lama untuk kolom 'status'
            $table->dropForeign(['status']);

            // Rename kolom status ke status_id
            $table->renameColumn('status', 'status_id');

            // Tambah foreign key baru untuk status_id -> statuses
            //$table->foreign('status_id')->references('id')->on('statuses')->nullOnDelete();

            // Tambah kolom status_inspeksi
            $table->unsignedTinyInteger('status_inspeksi')->default(0)->comment('0=belum approve, 1=pic approve, 2=manager approve');
        });
    }

    public function down(): void {
        Schema::table('jadwals', function (Blueprint $table) {
            // Drop foreign key status_id
            $table->dropForeign(['status_id']);

            // Rename kembali status_id ke status
            $table->renameColumn('status_id', 'status');

            // Foreign key lama ke status_labels
            $table->foreign('status')->references('id')->on('status_labels')->nullOnDelete();

            // Hapus kolom status_inspeksi
            $table->dropColumn('status_inspeksi');
        });
    }
};
