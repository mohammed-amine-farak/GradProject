<?php
// database/migrations/2026_01_01_000008_create_solutions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->text('solution_text')->nullable();
            $table->string('file_url')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
            
            // تقييم الجهة فقط (لا يوجد تقييم أكاديمي في البداية)
            $table->decimal('entity_rating', 2, 1)->nullable();
            $table->text('entity_review')->nullable();
            
            $table->enum('final_status', ['pending', 'approved', 'rejected', 'needs_revision'])->default('pending');
            $table->json('badges')->nullable();
            $table->timestamps();
            
            $table->index('application_id');
            $table->index('final_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};