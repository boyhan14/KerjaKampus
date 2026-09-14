<?php

namespace App\Enums;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case FLAGGED = 'flagged';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::SUSPENDED => 'Suspended',
            self::PENDING => 'Pending',
            self::REJECTED => 'Rejected',
            self::FLAGGED => 'Flagged',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'green',
            self::SUSPENDED => 'red',
            self::PENDING => 'yellow',
            self::REJECTED => 'red',
            self::FLAGGED => 'orange',
        };
    }
}

