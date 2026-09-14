<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Enums\JobStatus;
use App\Enums\UserRole;
use App\Models\Application;
use App\Models\JobListing;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class ApplicationService
{
    public function __construct(
        protected NotificationService $notificationService,
        protected ProjectService $projectService
    ) {}

    public function apply(User $talent, JobListing $job, array $data): Application
    {
        if (!$talent->isTalent() && !$talent->hasRole(UserRole::TALENT)) {
            throw new Exception("Hanya talenta yang dapat melamar pekerjaan.");
        }

        if ($job->status !== JobStatus::OPEN) {
            throw new Exception("Lowongan ini sudah ditutup atau tidak menerima lamaran baru.");
        }

        $existing = Application::where('job_listing_id', $job->id)
            ->where('user_id', $talent->id)
            ->exists();

        if ($existing) {
            throw new Exception("Anda sudah pernah melamar pekerjaan ini.");
        }

        return DB::transaction(function () use ($talent, $job, $data) {
            $application = Application::create([
                'job_listing_id' => $job->id,
                'user_id' => $talent->id,
                'cover_letter' => $data['cover_letter'],
                'proposed_price' => $data['proposed_price'] ?? null,
                'estimated_duration' => $data['estimated_duration'] ?? null,
                'status' => ApplicationStatus::PENDING,
            ]);

            $job->increment('applicant_count');

            if ($job->client) {
                $this->notificationService->send(
                    $job->client,
                    'application_received',
                    'Lamaran Baru Diterima',
                    "{$talent->name} telah melamar untuk pekerjaan: {$job->title}",
                    ['job_id' => $job->id, 'application_id' => $application->id]
                );
            }

            return $application;
        });
    }

    public function withdraw(Application $application): void
    {
        if (!in_array($application->status, [ApplicationStatus::PENDING, ApplicationStatus::SHORTLISTED])) {
            throw new Exception("Lamaran tidak dapat ditarik kembali pada status ini.");
        }

        DB::transaction(function () use ($application) {
            $application->update(['status' => ApplicationStatus::WITHDRAWN]);
            $application->jobListing?->decrement('applicant_count');
        });
    }

    public function shortlist(Application $application): void
    {
        $application->update(['status' => ApplicationStatus::SHORTLISTED]);

        if ($application->talent) {
            $this->notificationService->send(
                $application->talent,
                'shortlisted',
                'Lamaran Masuk Daftar Pendek',
                "Selamat! Lamaran Anda untuk {$application->jobListing->title} telah terpilih masuk shortlist.",
                ['job_id' => $application->job_listing_id, 'application_id' => $application->id]
            );
        }
    }

    public function accept(Application $application): Project
    {
        return DB::transaction(function () use ($application) {
            $application->update(['status' => ApplicationStatus::ACCEPTED]);

            $project = $this->projectService->createFromApplication($application);

            if ($application->talent) {
                $this->notificationService->send(
                    $application->talent,
                    'application_accepted',
                    'Lamaran Diterima!',
                    "Selamat! Lamaran Anda untuk {$application->jobListing->title} telah diterima. Proyek baru telah aktif.",
                    ['project_id' => $project->id]
                );
            }

            return $project;
        });
    }

    public function reject(Application $application): void
    {
        $application->update(['status' => ApplicationStatus::REJECTED]);

        if ($application->talent) {
            $this->notificationService->send(
                $application->talent,
                'application_rejected',
                'Pembaruan Status Lamaran',
                "Terima kasih atas minat Anda pada pekerjaan {$application->jobListing->title}. Saat ini klien memilih kandidat lain.",
                ['job_id' => $application->job_listing_id]
            );
        }
    }
}
