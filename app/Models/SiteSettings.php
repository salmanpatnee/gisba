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
        'crisc_end_date',
        'crisc_time_start',
        'crisc_time_end',
        'crisc_timezone',
        'crisc_capacity',
        'cissp_price',
        'cissp_currency',
        'cissp_date',
        'cissp_end_date',
        'cissp_time_start',
        'cissp_time_end',
        'cissp_timezone',
        'cissp_capacity',
        'prince2_price',
        'prince2_currency',
        'prince2_date',
        'prince2_end_date',
        'prince2_time_start',
        'prince2_time_end',
        'prince2_timezone',
        'prince2_capacity',
    ];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'membership_price' => 'decimal:2',
        'membership_regular_price' => 'decimal:2',
        'crisc_price' => 'decimal:2',
        'crisc_date' => 'date',
        'crisc_end_date' => 'date',
        'crisc_capacity' => 'integer',
        'cissp_price' => 'decimal:2',
        'cissp_date' => 'date',
        'cissp_end_date' => 'date',
        'cissp_capacity' => 'integer',
        'prince2_price' => 'decimal:2',
        'prince2_date' => 'date',
        'prince2_end_date' => 'date',
        'prince2_capacity' => 'integer',
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
            'crisc_timezone' => 'Saudi Arabia Standard Time',
            'crisc_capacity' => 12,
            'cissp_price' => 999.99,
            'cissp_currency' => 'USD',
            'cissp_time_start' => '7:00 AM',
            'cissp_time_end' => '1:00 PM',
            'cissp_timezone' => 'Saudi Arabia Standard Time',
            'cissp_capacity' => 15,
            'prince2_price' => 999.99,
            'prince2_currency' => 'USD',
            'prince2_time_start' => '7:00 AM',
            'prince2_time_end' => '1:00 PM',
            'prince2_timezone' => 'Saudi Arabia Standard Time',
            'prince2_capacity' => 15,
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
        return $this->seatsRemainingFor('crisc', $this->crisc_capacity);
    }

    /**
     * Remaining CISSP course seats, never negative.
     */
    public function getCisspSeatsRemainingAttribute(): int
    {
        return $this->seatsRemainingFor('cissp', $this->cissp_capacity);
    }

    /**
     * Remaining PRINCE2 course seats, never negative.
     */
    public function getPrince2SeatsRemainingAttribute(): int
    {
        return $this->seatsRemainingFor('prince2', $this->prince2_capacity);
    }

    private function seatsRemainingFor(string $course, int $capacity): int
    {
        $taken = CourseEnrollment::query()->forCourse($course)->count();

        return max(0, $capacity - $taken);
    }

    /**
     * Human-readable date (or date range) for the given course, e.g. "October 12th, 2026"
     * or "October 12th – 15th, 2026" when an end date is set. Null when no start date is configured.
     */
    public function dateRangeFor(string $course): ?string
    {
        $start = $this->{"{$course}_date"};
        $end = $this->{"{$course}_end_date"};

        if (! $start) {
            return null;
        }

        if (! $end || $end->isSameDay($start)) {
            return $start->format('F jS, Y');
        }

        if ($end->isSameMonth($start) && $end->isSameYear($start)) {
            return $start->format('F jS').' – '.$end->format('jS, Y');
        }

        return $start->format('F jS, Y').' – '.$end->format('F jS, Y');
    }
}
