<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Application;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $acceptedApplications = Application::where('status', 'accepted')->with('jobListing')->get();

        if ($acceptedApplications->isEmpty()) {
            return;
        }

        foreach ($acceptedApplications as $index => $application) {
            $status = $index < 2 ? 'completed' : 'active';

            Project::create([
                'job_listing_id' => $application->job_listing_id,
                'application_id' => $application->id,
                'client_id' => $application->jobListing->user_id,
                'talent_id' => $application->user_id,
                'title' => $application->jobListing->title,
                'description' => 'Pelaksanaan proyek ' . $application->jobListing->title,
                'budget' => $application->proposed_price ?? $application->jobListing->budget_min,
                'deadline' => $application->jobListing->deadline ?? now()->addDays(30),
                'status' => $status,
                'started_at' => now()->subDays(rand(10, 30)),
                'completed_at' => $status === 'completed' ? now()->subDays(rand(1, 5)) : null,
            ]);
        }
    }
}
