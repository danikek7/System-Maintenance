<?php

// database/migrations/xxxx_xx_xx_create_schedule_statuses_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleStatusesTable extends Migration
{
    public function up(): void
    {
        Schema::create('schedule_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable(); // warna label bg/teks
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_statuses');
    }
}
