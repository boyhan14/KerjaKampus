<?php

namespace App\Contracts;

interface AiProviderInterface
{
    public function generateText(string $prompt, array $options = []): string;
    public function analyze(string $input, string $task): array;
}
