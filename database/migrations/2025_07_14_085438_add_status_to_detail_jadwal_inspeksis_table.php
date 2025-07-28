<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDetailJadwalInspeksisTable extends Migration
{
    public function up()
    {
        Schema::table('detail_jadwal_inspeksis', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('hasil_indikator'); 
            // Ganti 'nama_column_terakhir' dengan nama kolom yang ada terakhir di tabel kamu
        });
    }

    public function down()
    {
        Schema::table('detail_jadwal_inspeksis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
