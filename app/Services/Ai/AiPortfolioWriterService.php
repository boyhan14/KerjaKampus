<?php

namespace App\Services\Ai;

use App\Contracts\AiProviderInterface;

class AiPortfolioWriterService
{
    public function __construct(protected AiProviderInterface $provider)
    {
    }

    public function generateDescription(string $title, string $technologies, string $rawNotes): string
    {
        $prompt = "Title: {$title}\nTechnologies: {$technologies}\nNotes: {$rawNotes}\nGenerate a professional portfolio project description.";
        return $this->provider->generateText($prompt);
    }
}

