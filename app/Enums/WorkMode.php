<?php

namespace App\Enums;

enum WorkMode: string
{
    case REMOTE = 'remote';
    case ONSITE = 'onsite';
    case HYBRID = 'hybrid';

    public function label(): string
    {
        return match ($this) {
            self::REMOTE => 'Remote',
            self::ONSITE => 'Onsite',
            self::HYBRID => 'Hybrid',
        };
    }
}

