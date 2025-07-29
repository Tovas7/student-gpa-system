<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->integer('score')->nullable(); // Score from 0-100
            $table->timestamps();

            $table->unique(['student_id', 'course_id']); // A student can only have one score per course
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_course');
    }
};