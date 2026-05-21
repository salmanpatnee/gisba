<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MemberAccessToken extends Model
{
    protected $fillable = [
        'email',
        'token',
        'paypal_order_id',
        'amount_paid',
        'used_at',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'used_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public static function generate(string $email, ?string $paypalOrderId = null): self
    {
        return self::create([
            'email' => $email,
            'token' => Str::random(64),
            'paypal_order_id' => $paypalOrderId,
            'expires_at' => now()->addHours(48),
        ]);
    }

    public function isValid(): bool
    {
        return $this->used_at === null && $this->expires_at > now();
    }
}
