<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'value',
        'expires_at',
    ];

    protected $casts = [
        'value' => 'integer',
        'expires_at' => 'datetime',
    ];

    /** @param Builder<Coupon> $query */
    public function scopeActive(Builder $query): void
    {
        $query->where(function (Builder $query) {
            $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
        });
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    /**
     * Discount multiplier to apply to a base price, e.g. 0.50 for 50% off.
     */
    public function discountedAmount(float $basePrice): float
    {
        return round($basePrice * (1 - $this->value / 100), 2);
    }
}
