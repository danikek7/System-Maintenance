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
    Schema::table('users', function (Blueprint $table) {
        $table->text('permissions')->nullable()->after('password');
        $table->string('persist_code')->nullable()->after('last_login');
        $table->string('gravatar')->nullable()->after('username');
        $table->unsignedBigInteger('location_id')->nullable()->after('gravatar');
        $table->string('jobtitle')->nullable()->after('location_id');
        $table->unsignedBigInteger('manager_id')->nullable()->after('jobtitle');
        //$table->text('employee_num')->nullable()->after('manager_id');
        $table->unsignedBigInteger('company_id')->nullable()->after('employee_num');
        $table->boolean('ldap_import')->default(false)->after('remember_token');
        $table->string('image')->nullable()->after('ldap_import');

        // Optional foreign keys
        $table->foreign('location_id')->references('id')->on('locations')->nullOnDelete();
        $table->foreign('manager_id')->references('id')->on('users')->nullOnDelete();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
