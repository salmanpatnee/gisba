<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\ResetMemberPasswordMail;
use Database\Factories\UserFactory;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

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

    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }

    /**
     * The moment the member finished the last chapter resource, or null if the
     * training (all currently existing chapter resources) is not yet 100% watched.
     */
    public function completedTrainingAt(): ?Carbon
    {
        $total = Resource::where('resourceable_type', Chapter::class)->count();

        if ($total === 0) {
            return null;
        }

        $watched = $this->watchedResources()
            ->where('resourceable_type', Chapter::class)
            ->get();

        if ($watched->count() < $total) {
            return null;
        }

        $latest = $watched
            ->map(fn (Resource $resource) => $resource->pivot->completed_at)
            ->filter()
            ->max();

        return $latest ? Carbon::parse($latest) : $this->freshTimestamp();
    }

    public function hasCompletedTraining(): bool
    {
        return $this->completedTrainingAt() !== null;
    }

    /**
     * Issue (or fetch the existing) certificate once the training is complete.
     * Returns null when the member has not finished the training.
     */
    public function issueCertificate(): ?Certificate
    {
        $completedAt = $this->completedTrainingAt();

        if ($completedAt === null) {
            return null;
        }

        return $this->certificate()->firstOrCreate(
            ['user_id' => $this->id],
            ['completed_at' => $completedAt],
        );
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

    public function sendPasswordResetNotification($token): void
    {
        if (! $this->is_member) {
            $this->notify(new ResetPassword($token));

            return;
        }

        $resetUrl = route('members.password.reset', ['token' => $token, 'email' => $this->email]);

        Mail::to($this->email)->send(new ResetMemberPasswordMail($resetUrl));
    }
}
