<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix phone column to string in students table
        Schema::table('students', function (Blueprint $table) {
            $table->string('phone', 20)->change();
        });

        // Fix phone column to string in teachers table
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('phone', 20)->change();
        });

        // Fix phone column to string in administrators table
        Schema::table('administrators', function (Blueprint $table) {
            $table->string('phone', 20)->change();
        });

        // Add grade to enrollments
        Schema::table('enrollments', function (Blueprint $table) {
            $table->decimal('grade', 5, 2)->nullable()->after('course_id');
            $table->string('grade_letter', 2)->nullable()->after('grade');
            $table->text('remarks')->nullable()->after('grade_letter');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('phone')->change();
        });
        Schema::table('teachers', function (Blueprint $table) {
            $table->integer('phone')->change();
        });
        Schema::table('administrators', function (Blueprint $table) {
            $table->integer('phone')->change();
        });
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['grade', 'grade_letter', 'remarks']);
        });
    }
};
