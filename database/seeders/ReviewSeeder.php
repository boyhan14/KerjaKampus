<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $completedProjects = Project::where('status', 'completed')->get();

        if ($completedProjects->isEmpty()) {
            return;
        }

        foreach ($completedProjects as $project) {
            // Client to Talent
            Review::create([
                'project_id' => $project->id,
                'reviewer_id' => $project->client_id,
                'reviewee_id' => $project->talent_id,
                'rating' => rand(4, 5),
                'comment' => 'Kerja yang sangat bagus, komunikasi lancar dan hasil sesuai ekspektasi. Terima kasih!',
            ]);

            // Talent to Client
            Review::create([
                'project_id' => $project->id,
                'reviewer_id' => $project->talent_id,
                'reviewee_id' => $project->client_id,
                'rating' => rand(4, 5),
                'comment' => 'Klien sangat responsif dan memberikan brief yang jelas. Senang bisa bekerja sama!',
            ]);
        }
    }
}
