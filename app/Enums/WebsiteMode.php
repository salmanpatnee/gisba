<?php

namespace App\Enums;

enum WebsiteMode: string
{
    case B2B = 'b2b';
    case B2PMP = 'b2pmp';

    public function label(): string
    {
        return match ($this) {
            self::B2B => 'B2B',
            self::B2PMP => 'B2PMP',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::B2B => 'Home page is the site root (/). PMP page and its nav link are hidden from the public site.',
            self::B2PMP => 'PMP page is the site root (/). PMP nav link is visible. Home page remains available at /home.',
        };
    }
}
