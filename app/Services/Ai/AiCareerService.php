<?php

namespace App\Services\Ai;

use App\Contracts\AiProviderInterface;
use App\Models\User;

class AiCareerService
{
    public function __construct(protected AiProviderInterface $provider)
    {
    }

    public function analyzeCareerPath(User $user, ?string $careerGoal = null): array
    {
        $skills = $user->skills->pluck('name')->implode(', ');
        $input = "Education: {$user->education}; Skills: {$skills}; Experience: {$user->experience_years} years; Goal: {$careerGoal}";

        return $this->provider->analyze($input, 'career_guidance');
    }
}

