<?php
// database/migrations/2026_01_01_000011_create_problem_skills_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('problem_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('problem_id')->constrained('problems')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['problem_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('problem_skills');
    }
};