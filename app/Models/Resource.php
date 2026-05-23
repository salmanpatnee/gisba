<?php

namespace App\Models;

use App\Enums\ResourceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'resource_type',
        'resourceable_type',
        'resourceable_id',
    ];

    protected $casts = [
        'resource_type' => ResourceType::class,
    ];

    public function resourceable(): MorphTo
    {
        return $this->morphTo();
    }
}
