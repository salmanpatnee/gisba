<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nis2Pricing extends Model
{
    protected $table = 'nis2_pricing';

    protected $fillable = ['regular_price', 'sale_price'];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public static function current(): self
    {
        return self::firstOrCreate([], [
            'regular_price' => 2495.00,
            'sale_price' => 1500.00,
        ]);
    }

    public function getSavingsAttribute(): float
    {
        return (float) $this->regular_price - (float) $this->sale_price;
    }
}
