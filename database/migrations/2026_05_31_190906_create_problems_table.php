<?php
// database/migrations/2026_01_01_000006_create_problems_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained('entities')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->onDelete('set null');
            
            $table->string('title');
            $table->text('description');
            $table->text('problematic_question')->nullable();
            
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced'])->default('intermediate');
            $table->string('estimated_duration')->nullable();
            $table->enum('project_type', ['portfolio', 'pfe'])->default('portfolio');
            $table->string('output_type')->nullable();
            
            $table->enum('status', ['open', 'assigned', 'in_progress', 'resolved', 'closed', 'cancelled'])->default('open');
            
            $table->text('data_availability')->nullable();
            $table->text('expected_outcome')->nullable();
            
            $table->string('contact_person_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            
            $table->integer('views_count')->default(0);
            $table->integer('applications_count')->default(0);
            
            $table->date('deadline')->nullable();
            $table->timestamps();
            
            $table->index('entity_id');
            $table->index('category_id');
            $table->index('status');
            $table->index('difficulty_level');
            $table->index('project_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('problems');
    }
};