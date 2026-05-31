<?php
// database/migrations/2026_01_01_000010_create_student_skills_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            $table->enum('proficiency_level', ['learner', 'practitioner', 'proficient', 'expert'])->default('learner');
            $table->timestamps();
            
            $table->unique(['student_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_skills');
    }
};