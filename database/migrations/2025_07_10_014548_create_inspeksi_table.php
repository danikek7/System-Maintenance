<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inspeksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status')->nullable();
            $table->unsignedBigInteger('pic_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->timestamp('create_at')->nullable();
            $table->timestamp('update_at')->nullable();
            $table->unsignedBigInteger('create_by')->nullable();
            $table->timestamp('approve_at')->nullable();

            // FK
            $table->foreign('status')->references('id')->on('statuses')->nullOnDelete();
            $table->foreign('pic_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('manager_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('create_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('inspeksis');
    }
};
