<?php

namespace App\Enums;

enum Category: string
{
    case Compliance = 'Compliance';
    case Cybersecurity = 'Cybersecurity';
    case Governance = 'Governance';
    case RiskManagement = 'Risk Management';
    case Training = 'Training';
    case News = 'News';

    /** @return array<string, string> */
    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}
