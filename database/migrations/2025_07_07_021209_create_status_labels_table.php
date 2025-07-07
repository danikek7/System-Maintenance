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
        Schema::create('status_labels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('deployable')->default(false);
            $table->boolean('pending')->default(false);
            $table->boolean('archived')->default(false);
            $table->text('notes')->nullable();
            $table->string('color')->nullable();
            $table->boolean('show_in_nav')->default(false);
            $table->boolean('default_label')->default(false);

            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_labels');
    }
};
