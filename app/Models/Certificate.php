<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'certificate_number',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::created(function (Certificate $certificate): void {
            if (empty($certificate->certificate_number)) {
                $certificate->certificate_number = sprintf(
                    'GISBA-%d-%s',
                    $certificate->created_at->year,
                    str_pad((string) $certificate->id, 6, '0', STR_PAD_LEFT),
                );
                $certificate->saveQuietly();
            }
        });
    }
}
