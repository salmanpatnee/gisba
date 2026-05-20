<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class PmpPostAttachment extends Model
{
    protected $fillable = [
        'pmp_post_id',
        'filename',
        'path',
        'mime_type',
        'size',
    ];

    public function pmpPost(): BelongsTo
    {
        return $this->belongsTo(PmpPost::class);
    }

    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    public function getReadableSizeAttribute(): string
    {
        return Number::fileSize($this->size, precision: 1);
    }

    public function getFileIconAttribute(): string
    {
        return match (true) {
            str_contains($this->mime_type, 'pdf') => 'bi-file-earmark-pdf',
            in_array($this->mime_type, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']) => 'bi-file-earmark-word',
            in_array($this->mime_type, ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']) => 'bi-file-earmark-slides',
            str_starts_with($this->mime_type, 'image/') => 'bi-file-earmark-image',
            default => 'bi-file-earmark',
        };
    }

    public function getFileTypeLabelAttribute(): string
    {
        return match (true) {
            str_contains($this->mime_type, 'pdf') => 'PDF',
            in_array($this->mime_type, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']) => 'Word',
            in_array($this->mime_type, ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']) => 'PowerPoint',
            str_starts_with($this->mime_type, 'image/') => 'Image',
            default => 'File',
        };
    }

    public function getFileTypeColorAttribute(): string
    {
        return match ($this->file_type_label) {
            'PDF' => '#e53935',
            'Word' => '#1e88e5',
            'PowerPoint' => '#f4511e',
            'Image' => '#43a047',
            default => '#757575',
        };
    }
}
