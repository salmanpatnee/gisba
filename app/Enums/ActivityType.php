<?php

namespace App\Enums;

enum ActivityType: string
{
    case PageVisit = 'page_visit';

    public function label(): string
    {
        return match ($this) {
            self::PageVisit => 'Page Visit',
        };
    }
}
