<?php

namespace App\Services;

use App\Enums\JobStatus;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Support\Collection;

class JobMatchingService
{
    public function getMatchScore(User $talent, JobListing $job): int
    {
        $score = 0;

        $talentSkillIds = $talent->skills->pluck('id')->toArray();
        $jobSkillIds = $job->skills->pluck('id')->toArray();

        // 1. Skill match: up to 50%
        if (!empty($jobSkillIds)) {
            $matchedSkills = array_intersect($talentSkillIds, $jobSkillIds);
            $matchRatio = count($matchedSkills) / count($jobSkillIds);
            $score += $matchRatio * 50;
        } else {
            $score += 30; // Default if job has no specific skills
        }

        // 2. Category match: up to 20%
        // Check if any talent skill belongs to the job's category
        if ($job->category_id) {
            $talentCategoryIds = $talent->skills->pluck('skill_category_id')->unique()->toArray();
            if (in_array($job->category_id, $talentCategoryIds)) {
                $score += 20;
            }
        } else {
            $score += 10;
        }

        // 3. Experience match: up to 15%
        $expYears = (int) $talent->experience_years;
        $jobExp = $job->experience_level?->value ?? 'beginner';
        if ($jobExp === 'beginner' && $expYears <= 2) {
            $score += 15;
        } elseif ($jobExp === 'intermediate' && $expYears >= 2 && $expYears <= 4) {
            $score += 15;
        } elseif ($jobExp === 'expert' && $expYears >= 4) {
            $score += 15;
        } else {
            $score += 8;
        }

        // 4. Work preference / location: up to 10%
        if ($job->work_mode?->value === 'remote') {
            $score += 10;
        } elseif ($talent->location && $job->location && str_contains(strtolower($talent->location), strtolower($job->location))) {
            $score += 10;
        } else {
            $score += 5;
        }

        // 5. Profile completeness: up to 5%
        $completion = $talent->profileCompletionPercentage();
        $score += (int) round(($completion / 100) * 5);

        return (int) min(100, max(15, round($score)));
    }

    public function getRecommendedJobs(User $talent, int $limit = 6): Collection
    {
        // Eager load skills for talent to avoid N+1
        $talent->loadMissing('skills');

        $openJobs = JobListing::where('status', JobStatus::OPEN)
            ->with(['skills', 'category', 'client'])
            ->latest()
            ->take(30)
            ->get();

        $scoredJobs = $openJobs->map(function ($job) use ($talent) {
            $job->match_score = $this->getMatchScore($talent, $job);
            return $job;
        });

        return $scoredJobs->sortByDesc('match_score')->take($limit)->values();
    }
}
