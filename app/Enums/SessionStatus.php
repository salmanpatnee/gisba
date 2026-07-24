<?php

namespace App\Enums;

enum SessionStatus: string
{
    case Active = 'Active';
    case Ended = 'Ended';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Ended => 'Ended',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Active => 'bg-green-100 text-green-800',
            self::Ended => 'bg-gray-100 text-gray-600',
        };
    }
}
