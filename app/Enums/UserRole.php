<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case TALENT = 'talent';
    case CLIENT = 'client';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::TALENT => 'Talent',
            self::CLIENT => 'Client',
        };
    }
}

