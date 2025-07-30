<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('detail_jadwals', function (Blueprint $table) {
            // Inspektur / Pelaksana
            $table->unsignedBigInteger('inspeksi_by')->nullable()->after('inspeksi_at');
            $table->foreign('inspeksi_by')->references('id')->on('users')->nullOnDelete();

            // PIC Approval
            $table->unsignedBigInteger('pic_id')->nullable()->after('inspeksi_by');
            $table->timestamp('pic_approve_at')->nullable()->after('pic_id');
            $table->boolean('pic_status')->default(0)->after('pic_approve_at');
            $table->foreign('pic_id')->references('id')->on('users')->nullOnDelete();

            // Manager Approval
            $table->unsignedBigInteger('manager_id')->nullable()->after('pic_status');
            $table->timestamp('manager_approve_at')->nullable()->after('manager_id');
            $table->boolean('manager_status')->default(0)->after('manager_approve_at');
            $table->foreign('manager_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::table('detail_jadwals', function (Blueprint $table) {
            $table->dropForeign(['inspeksi_by']);
            $table->dropForeign(['pic_id']);
            $table->dropForeign(['manager_id']);

            $table->dropColumn([
                'inspeksi_by',
                'pic_id',
                'pic_approve_at',
                'pic_status',
                'manager_id',
                'manager_approve_at',
                'manager_status',
            ]);
        });
    }
};
