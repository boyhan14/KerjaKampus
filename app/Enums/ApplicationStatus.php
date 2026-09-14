<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case PENDING = 'pending';
    case SHORTLISTED = 'shortlisted';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case WITHDRAWN = 'withdrawn';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::SHORTLISTED => 'Shortlisted',
            self::ACCEPTED => 'Accepted',
            self::REJECTED => 'Rejected',
            self::WITHDRAWN => 'Withdrawn',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'yellow',
            self::SHORTLISTED => 'blue',
            self::ACCEPTED => 'green',
            self::REJECTED => 'red',
            self::WITHDRAWN => 'gray',
        };
    }
}

