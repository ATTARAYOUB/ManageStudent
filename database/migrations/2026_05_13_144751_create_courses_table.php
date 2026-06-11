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
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('name');           // Math, SVT, Physics...
        $table->string('description')->nullable();
        $table->string('schedule');       // Monday 8h-10h
        $table->string('room');           // Salle 12
        $table->unsignedBigInteger('teacher_id')->nullable();
        $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('courses');
}

};
