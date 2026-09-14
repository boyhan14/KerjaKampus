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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // The client
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->foreignId('category_id')->nullable()->constrained('skill_categories')->nullOnDelete();
            $table->decimal('budget_min', 10, 2)->nullable();
            $table->decimal('budget_max', 10, 2)->nullable();
            $table->date('deadline')->nullable();
            $table->string('job_type');
            $table->string('work_mode');
            $table->string('location')->nullable();
            $table->string('experience_level');
            $table->string('status')->default('draft');
            $table->integer('applicant_count')->default(0);
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('slug');
            $table->index('status');
            $table->index('category_id');
            $table->index('job_type');
            $table->index('work_mode');
            $table->index('experience_level');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
