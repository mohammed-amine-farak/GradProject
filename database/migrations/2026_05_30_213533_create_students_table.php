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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
                        $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Academic information
            $table->string('university')->nullable();
            $table->string('master_program')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->foreignId('academic_supervisor_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            
            // Availability
            $table->integer('available_hours_per_week')->default(10);
            
            // Statistics and reputation
            $table->integer('completed_problems')->default(0);
            $table->integer('trust_points')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0.00);
            
            // Professional portfolio links
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('personal_website')->nullable();
            $table->string('cv_url')->nullable();
            
            // Preferences (JSON for flexibility)
            $table->json('preferred_categories')->nullable();
            $table->boolean('notification_enabled')->default(true);
            
            // Timestamps
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('user_id');
            $table->index('academic_supervisor_id');
            $table->index('university');
            $table->index('master_program');
            $table->index('graduation_year');
            $table->index('trust_points');
            $table->index('average_rating');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
