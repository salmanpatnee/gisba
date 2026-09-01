<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'consent',
        'pmp_discount_percentage',
        'crisc_discount_percentage',
        'prince2_discount_percentage',
    ];

    protected $casts = [
        'consent' => 'boolean',
        'pmp_discount_percentage' => 'integer',
        'crisc_discount_percentage' => 'integer',
        'prince2_discount_percentage' => 'integer',
    ];
}
