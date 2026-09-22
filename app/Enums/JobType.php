<?php

namespace App\Enums;

enum JobType: string
{
    case FREELANCE = 'freelance';
    case GIG = 'gig';
    case INTERNSHIP = 'internship';
    case PART_TIME = 'part_time';
    case CONTRACT = 'contract';

    public function label(): string
    {
        return match ($this) {
            self::FREELANCE => 'Freelance',
            self::GIG => 'Gig',
            self::INTERNSHIP => 'Internship',
            self::PART_TIME => 'Part Time',
            self::CONTRACT => 'Contract',
        };
    }
}
