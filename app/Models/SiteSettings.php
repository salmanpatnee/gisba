<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $table = 'site_settings';

    protected $fillable = ['success_stories_region', 'regular_price', 'sale_price', 'toolkit_zip_path'];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public static function current(): self
    {
        return self::firstOrCreate([], [
            'success_stories_region' => 'eu',
            'regular_price' => 2495.00,
            'sale_price' => 1500.00,
        ]);
    }

    public function getSavingsAttribute(): float
    {
        return max(0, $this->regular_price - $this->sale_price);
    }
}
