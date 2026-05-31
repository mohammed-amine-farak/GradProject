<?php
// database/migrations/2026_01_01_000007_create_applications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('problem_id')->constrained('problems')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->text('proposal')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed', 'withdrawn'])->default('pending');
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->unique(['problem_id', 'student_id']);
            $table->index('problem_id');
            $table->index('student_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};