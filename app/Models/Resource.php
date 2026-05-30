<?php

namespace App\Models;

use App\Enums\ResourceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function watchers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'resource_user')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    public function isWatchedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        if ($this->relationLoaded('watchers')) {
            return $this->watchers->contains('id', $user->id);
        }

        return $this->watchers()->where('users.id', $user->id)->exists();
    }
}
