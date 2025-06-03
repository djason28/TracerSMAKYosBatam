<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::table('users', function (Blueprint $table) {
        $table->string('nisn', 20)->nullable();
        $table->date('birth_date')->nullable();
        $table->string('university_nim', 50)->nullable();
        $table->string('university_name', 255)->nullable();
        $table->string('job_title', 100)->nullable();
        $table->string('work_place', 100)->nullable();
        $table->integer('graduation_year')->nullable();
        $table->string('phone', 20)->nullable();
    });
    }

    
    public function down(): void
    {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'nisn',
            'birth_date',
            'university_nim',
            'university_name',
            'job_title',
            'work_place',
            'graduation_year',
            'phone',
        ]);
    });
    }
};
