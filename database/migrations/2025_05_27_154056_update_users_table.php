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
            $table->string('major')->nullable(); // Add new column
            $table->renameColumn('nisn', 'nis'); // Rename column
            $table->renameColumn('university_nim', 'insta'); // Rename column
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('major');
            $table->renameColumn('nis', 'nisn');
            $table->renameColumn('insta', 'university_nim');
        });
    }
};
