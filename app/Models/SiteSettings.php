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
        'crisc_price',
        'crisc_currency',
        'crisc_date',
        'crisc_time_start',
        'crisc_time_end',
        'crisc_timezone',
        'crisc_capacity',
    ];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'membership_price' => 'decimal:2',
        'membership_regular_price' => 'decimal:2',
        'crisc_price' => 'decimal:2',
        'crisc_date' => 'date',
        'crisc_capacity' => 'integer',
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
            'crisc_price' => 9.99,
            'crisc_currency' => 'USD',
            'crisc_date' => '2026-09-21',
            'crisc_time_start' => '7:00 AM',
            'crisc_time_end' => '1:00 PM',
            'crisc_timezone' => 'GMT+3',
            'crisc_capacity' => 12,
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

    /**
     * Remaining CRISC course seats, never negative.
     */
    public function getCriscSeatsRemainingAttribute(): int
    {
        $taken = CourseEnrollment::query()->forCourse('crisc')->count();

        return max(0, $this->crisc_capacity - $taken);
    }
}
