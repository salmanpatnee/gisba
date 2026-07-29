<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'success_stories_region',
        'website_mode',
        'regular_price',
        'sale_price',
        'toolkit_zip_path',
        'membership_price',
        'membership_regular_price',
        'membership_currency',
    ];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'membership_price' => 'decimal:2',
        'membership_regular_price' => 'decimal:2',
    ];

    public static function current(): self
    {
        return self::firstOrCreate([], [
            'success_stories_region' => 'eu',
            'website_mode' => 'b2b',
            'regular_price' => 2495.00,
            'sale_price' => 1500.00,
            'membership_price' => 30.00,
            'membership_regular_price' => 59.00,
            'membership_currency' => 'USD',
        ]);
    }

    public function getSavingsAttribute(): float
    {
        return max(0, $this->regular_price - $this->sale_price);
    }

    /**
     * Symbol for the configured membership currency, falling back to the code itself.
     */
    public function getMembershipCurrencySymbolAttribute(): string
    {
        return match ($this->membership_currency) {
            'USD' => '$',
            'GBP' => '£',
            'EUR' => '€',
            default => $this->membership_currency.' ',
        };
    }

    /**
     * Whole-percent discount off the regular membership price, for the paywall badge.
     */
    public function getMembershipDiscountPercentAttribute(): int
    {
        if ($this->membership_regular_price <= 0 || $this->membership_price >= $this->membership_regular_price) {
            return 0;
        }

        return (int) round(
            ($this->membership_regular_price - $this->membership_price) / $this->membership_regular_price * 100
        );
    }
}
