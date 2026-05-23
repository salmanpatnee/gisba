<?php

namespace App\Enums;

enum ResourceType: string
{
    case Tutorial = 'tutorial';
    case Quizzes = 'quizzes';
    case Takeaway = 'takeaway';
    case DomainSummary = 'domain_summary';

    public function label(): string
    {
        return match ($this) {
            self::Tutorial => 'Tutorial',
            self::Quizzes => 'Quizzes',
            self::Takeaway => 'Takeaway',
            self::DomainSummary => 'Domain Summary in Poetry',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Tutorial => 'bg-blue-100 text-blue-700',
            self::Quizzes => 'bg-orange-100 text-orange-700',
            self::Takeaway => 'bg-green-100 text-green-700',
            self::DomainSummary => 'bg-purple-100 text-purple-700',
        };
    }
}
