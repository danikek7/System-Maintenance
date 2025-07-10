<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable()->after('model_id');
            $table->unsignedBigInteger('produsen_id')->nullable()->after('kategori_id');
        });
    }

    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['kategori_id', 'produsen_id']);
        });
    }
};
