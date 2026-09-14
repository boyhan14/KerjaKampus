<?php

namespace App\Enums;

enum JobStatus: string
{
    case DRAFT = 'draft';
    case OPEN = 'open';
    case CLOSED = 'closed';
    case SUSPENDED = 'suspended';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::OPEN => 'Open',
            self::CLOSED => 'Closed',
            self::SUSPENDED => 'Suspended',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::OPEN => 'green',
            self::CLOSED => 'red',
            self::SUSPENDED => 'yellow',
        };
    }
}

