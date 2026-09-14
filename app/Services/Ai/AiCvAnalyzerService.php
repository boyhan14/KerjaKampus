<?php

namespace App\Services\Ai;

use App\Contracts\AiProviderInterface;

class AiCvAnalyzerService
{
    public function __construct(protected AiProviderInterface $provider)
    {
    }

    public function analyzeText(string $cvText): array
    {
        return $this->provider->analyze($cvText, 'cv_analysis');
    }
}
