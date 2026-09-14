<?php

namespace App\Services;

use App\Enums\ProjectStatus;
use App\Models\Application;
use App\Models\Project;
use Exception;

class ProjectService
{
    public function __construct(
        protected NotificationService $notificationService
    ) {}

    public function createFromApplication(Application $application): Project
    {
        $job = $application->jobListing;

        $project = Project::create([
            'job_listing_id' => $job->id,
            'application_id' => $application->id,
            'client_id' => $job->user_id,
            'talent_id' => $application->user_id,
            'title' => 'Proyek: ' . $job->title,
            'description' => $job->description,
            'budget' => $application->proposed_price ?? $job->budget_min,
            'deadline' => $job->deadline,
            'status' => ProjectStatus::ACTIVE,
            'started_at' => now(),
        ]);

        if ($project->talent) {
            $this->notificationService->send(
                $project->talent,
                'project_created',
                'Proyek Baru Dimulai',
                "Proyek '{$project->title}' telah aktif. Selamat bekerja!",
                ['project_id' => $project->id]
            );
        }

        return $project;
    }

    public function complete(Project $project): void
    {
        if ($project->status !== ProjectStatus::ACTIVE) {
            throw new Exception("Hanya proyek yang aktif yang dapat diselesaikan.");
        }

        $project->update([
            'status' => ProjectStatus::COMPLETED,
            'completed_at' => now(),
        ]);

        if ($project->talent) {
            $this->notificationService->send(
                $project->talent,
                'project_completed',
                'Proyek Berhasil Diselesaikan',
                "Proyek '{$project->title}' telah selesai! Jangan lupa berikan ulasan kepada klien.",
                ['project_id' => $project->id]
            );
        }

        if ($project->client) {
            $this->notificationService->send(
                $project->client,
                'project_completed',
                'Proyek Selesai',
                "Proyek '{$project->title}' telah ditandai selesai. Berikan rating & ulasan untuk talenta.",
                ['project_id' => $project->id]
            );
        }
    }

    public function cancel(Project $project): void
    {
        if ($project->status !== ProjectStatus::ACTIVE) {
            throw new Exception("Hanya proyek aktif yang dapat dibatalkan.");
        }

        $project->update([
            'status' => ProjectStatus::CANCELLED,
            'cancelled_at' => now(),
        ]);

        if ($project->talent) {
            $this->notificationService->send(
                $project->talent,
                'project_cancelled',
                'Proyek Dibatalkan',
                "Proyek '{$project->title}' telah dibatalkan.",
                ['project_id' => $project->id]
            );
        }
    }
}
