<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

#[Fillable(['name', 'email', 'password', 'is_member', 'member_since'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_member' => 'boolean',
            'member_since' => 'datetime',
        ];
    }

    public function watchedResources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class, 'resource_user')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    public function isMember(): bool
    {
        return (bool) $this->is_member
            && $this->member_since !== null
            && $this->member_since->addMonths(6)->isFuture();
    }

    public function memberExpiresAt(): ?Carbon
    {
        return $this->member_since?->addMonths(6);
    }

    public function isExpiringWithinDays(int $days): bool
    {
        return $this->isMember()
            && $this->member_since->addMonths(6)->diffInDays(now(), true) <= $days;
    }
}
