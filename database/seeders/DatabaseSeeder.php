<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SkillCategorySeeder::class,
            SkillSeeder::class,
            UserSeeder::class,
            PortfolioSeeder::class,
            JobListingSeeder::class,
            ApplicationSeeder::class,
            ProjectSeeder::class,
            ReviewSeeder::class,
            NotificationSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
