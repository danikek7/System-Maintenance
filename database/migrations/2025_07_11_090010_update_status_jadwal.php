<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('jadwals', function (Blueprint $table) {
            // ubah kolom status_jadwal jadi unsignedTinyInteger dengan default 0 dan comment
            $table->unsignedTinyInteger('status_jadwal')->default(0)
                ->comment('0=draf, 1=submit, 2=waiting, 3=active, 4=done')
                ->change();
        });
    }

    public function down(): void {
        Schema::table('jadwals', function (Blueprint $table) {
            // rollback, kembalikan ke tipe sebelumnya
            $table->unsignedBigInteger('status_jadwal')->nullable()->change();
        });
    }
};
