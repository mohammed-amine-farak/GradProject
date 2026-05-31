<?php
// database/migrations/2026_01_01_000003_create_entities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('entity_name');
            $table->enum('entity_type', [
                'clinic', 'store', 'farm', 'school', 
                'association', 'hotel', 'restaurant', 'other'
            ])->default('other');
            $table->string('registration_number')->nullable();
            $table->text('address')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('logo_url')->nullable();
            $table->integer('problems_posted')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0.00);
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('entity_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};