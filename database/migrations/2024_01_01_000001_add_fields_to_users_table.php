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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable();
            $table->string('role')->default('talent');
            $table->json('roles')->nullable();
            $table->string('status')->default('active');
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_description')->nullable();
            $table->string('education')->nullable();
            $table->integer('experience_years')->default(0);
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamp('profile_completed_at')->nullable();

            $table->index('username');
            $table->index('role');
            $table->index('status');
            $table->index('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['username']);
            $table->dropIndex(['role']);
            $table->dropIndex(['status']);
            $table->dropIndex(['location']);
            
            $table->dropColumn([
                'username',
                'role',
                'roles',
                'status',
                'avatar',
                'bio',
                'location',
                'phone',
                'website',
                'company_name',
                'company_description',
                'education',
                'experience_years',
                'github_url',
                'linkedin_url',
                'twitter_url',
                'instagram_url',
                'is_available',
                'profile_completed_at',
            ]);
        });
    }
};
