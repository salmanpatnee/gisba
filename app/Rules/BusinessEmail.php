<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class BusinessEmail implements ValidationRule
{
    /** @var array<string> */
    private array $blockedDomains = [
        'gmail.com',
        'yahoo.com',
        'outlook.com',
        'hotmail.com',
        'live.com',
        'aol.com',
        'icloud.com',
        'mail.com',
        'protonmail.com',
        'zoho.com',
    ];

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = strtolower(substr(strrchr((string) $value, '@'), 1));

        if (in_array($domain, $this->blockedDomains, strict: true)) {
            $fail('Please use your business email address.');
        }
    }
}
