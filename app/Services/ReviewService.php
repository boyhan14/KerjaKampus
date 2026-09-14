<?php

namespace App\Services;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\Review;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class ReviewService
{
    public function __construct(
        protected NotificationService $notificationService
    ) {}

    public function create(User $reviewer, Project $project, array $data): Review
    {
        if ($project->status !== ProjectStatus::COMPLETED) {
            throw new Exception("Ulasan hanya dapat diberikan untuk proyek yang sudah selesai.");
        }

        if ($reviewer->id !== $project->client_id && $reviewer->id !== $project->talent_id) {
            throw new Exception("Hanya pihak yang terlibat dalam proyek yang dapat memberikan ulasan.");
        }

        if (!$this->canReview($reviewer, $project)) {
            throw new Exception("Anda sudah memberikan ulasan untuk proyek ini.");
        }

        $revieweeId = $reviewer->id === $project->client_id ? $project->talent_id : $project->client_id;

        return DB::transaction(function () use ($reviewer, $revieweeId, $project, $data) {
            $review = Review::create([
                'project_id' => $project->id,
                'reviewer_id' => $reviewer->id,
                'reviewee_id' => $revieweeId,
                'rating' => (int) $data['rating'],
                'comment' => $data['comment'] ?? null,
            ]);

            $reviewee = User::find($revieweeId);
            if ($reviewee) {
                $this->notificationService->send(
                    $reviewee,
                    'review_received',
                    'Ulasan Baru Diterima',
                    "Anda telah menerima ulasan baru dari {$reviewer->name} dengan rating {$review->rating}/5 untuk proyek: {$project->title}",
                    ['project_id' => $project->id, 'review_id' => $review->id]
                );
            }

            return $review;
        });
    }

    public function canReview(User $user, Project $project): bool
    {
        if ($project->status !== ProjectStatus::COMPLETED) {
            return false;
        }

        if ($user->id !== $project->client_id && $user->id !== $project->talent_id) {
            return false;
        }

        return !Review::where('project_id', $project->id)
            ->where('reviewer_id', $user->id)
            ->exists();
    }
}
