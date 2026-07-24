<?php

namespace App\Models;

use App\Enums\SessionStatus;
use Carbon\Carbon;
use Database\Factories\UserSessionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserSession extends Model
{
    /** @use HasFactory<UserSessionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_token',
        'login_at',
        'logout_at',
        'last_activity_at',
        'duration_seconds',
        'status',
        'login_method',
        'ip_address',
        'browser',
        'platform',
        'device_type',
        'user_agent',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'status' => SessionStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(SessionActivity::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', SessionStatus::Active);
    }

    public function scopeForDateRange(Builder $query, Carbon $from, Carbon $to): Builder
    {
        return $query->whereBetween('login_at', [$from, $to]);
    }

    public function scopeStale(Builder $query, Carbon $cutoff): Builder
    {
        return $query->active()->where('last_activity_at', '<', $cutoff);
    }

    public function isCurrentlyOnline(): bool
    {
        return $this->status === SessionStatus::Active
            && $this->last_activity_at !== null
            && $this->last_activity_at->gte(self::onlineCutoff());
    }

    public function liveDurationSeconds(): int
    {
        if ($this->status === SessionStatus::Active) {
            return now()->diffInSeconds($this->login_at);
        }

        return $this->duration_seconds ?? 0;
    }

    public function durationForHumans(): string
    {
        return self::formatDuration($this->liveDurationSeconds());
    }

    public static function formatDuration(?int $seconds): string
    {
        $seconds ??= 0;

        if ($seconds < 60) {
            return '<1m';
        }

        $days = intdiv($seconds, 86400);
        $hours = intdiv($seconds % 86400, 3600);
        $minutes = intdiv($seconds % 3600, 60);

        if ($days > 0) {
            return "{$days}d {$hours}h";
        }

        if ($hours > 0) {
            return "{$hours}h {$minutes}m";
        }

        return "{$minutes}m";
    }

    public static function onlineCutoff(): Carbon
    {
        return now()->subMinutes((int) config('user-activity.online_threshold_minutes'));
    }
}
