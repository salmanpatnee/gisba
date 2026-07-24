<?php

namespace App\Models;

use App\Enums\ActivityType;
use Database\Factories\SessionActivityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionActivity extends Model
{
    /** @use HasFactory<SessionActivityFactory> */
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'user_session_id',
        'user_id',
        'type',
        'route_name',
        'url',
        'method',
        'label',
        'module',
        'meta',
        'occurred_at',
    ];

    protected $casts = [
        'type' => ActivityType::class,
        'meta' => 'array',
        'occurred_at' => 'datetime',
    ];

    public function userSession(): BelongsTo
    {
        return $this->belongsTo(UserSession::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
