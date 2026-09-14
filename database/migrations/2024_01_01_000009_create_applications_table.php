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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained('job_listings')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // The talent
            $table->text('cover_letter');
            $table->decimal('proposed_price', 10, 2)->nullable();
            $table->string('estimated_duration')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            
            $table->unique(['job_listing_id', 'user_id']);
            $table->index('job_listing_id');
            $table->index('user_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
